#!/usr/bin/python

import logging
from pprint import *
import requests
import json
from bs4 import BeautifulSoup




baseUrl = "https://m.wetzikon.ch/index.php?apid="


f = open("apids.json")
database = json.load(f)




logging.basicConfig(format='%(asctime)s [%(levelname)s] %(message)s', datefmt='%d-%b-%y %H:%M:%S', level=logging.DEBUG)


for district in database:
    logging.info("Fetching events in district %r..." % district)
    for category in database[district]["categories"]:
        apid = database[district]["categories"][category]["apid"]
        # print(baseUrl + str(apid))
        page = requests.get(baseUrl + str(apid)).text
        # print(page)
        # break
        soup = BeautifulSoup(page, 'html.parser')

        # get events
        database[district]["categories"][category]["events"] = []
        for link in soup.find_all('a'):
            if "/appl/ics.php?apid=" in str(link.get('href')) and "icalLink" in str(link):
                date = link.string.strip()
                logging.debug("Event in %r/%r: %r" % (district, category, date))

                database[district]["categories"][category]["events"].append(date)



pprint(database)

with open("database.json", mode='w') as f:
    json.dump(database, f)