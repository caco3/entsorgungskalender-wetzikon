#!/usr/bin/python

import logging
from pprint import *
import requests
import json
from bs4 import BeautifulSoup



domain = "https://m.wetzikon.ch"
pathAndQuery = "index.php?apid="

importFile = "data/apids.json"
exportFile = "data/database.json"



logging.basicConfig(format='%(asctime)s [%(levelname)s] %(message)s', datefmt='%d-%b-%y %H:%M:%S', level=logging.INFO)


logging.info("imported apids from %r" % importFile)
f = open(importFile)
database = json.load(f)


for district in database:
    logging.info("Fetching events in district %r..." % district)
    for category in database[district]["categories"]:
        logging.info("  Category: %r..." % category)
        apid = database[district]["categories"][category]["apid"]
        page = requests.get(domain + "/" + pathAndQuery + str(apid)).text
        soup = BeautifulSoup(page, 'html.parser')

        # get events
        database[district]["categories"][category]["events"] = []
        for link in soup.find_all('a'):
            if "/appl/ics.php?apid=" in str(link.get('href')) and "icalLink" in str(link):
                urlIcs = link.get('href')
                date = link.string.strip()
                logging.debug("Event in %r/%r: %r" % (district, category, date))

                ics = requests.get(domain + "/" + urlIcs).text
                vevent = "BEGIN:VEVENT" + ics.split("BEGIN:VEVENT")[1].split("END:VEVENT")[0] + "END:VEVENT" # Drop the VCALENDAR header/footer, it is only used per file and not per VEVENT
                database[district]["categories"][category]["events"].append({ "date": date, "vevent": vevent})
            # break # Testing
        # break # Testing
    # break # Testing

# pprint(database)

with open(exportFile, mode='w') as f:
    json.dump(database, f, indent=4, sort_keys=True)

logging.info("Exported database to %r" % exportFile)
