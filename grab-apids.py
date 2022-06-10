#!/usr/bin/python

import logging
from pprint import *
import requests
import json
from bs4 import BeautifulSoup




baseUrl = "https://m.wetzikon.ch/index.php?apid="
baseApid = 7215088

districts = ["Kreis 1", "Kreis 2", "Kreis 3", "Kreis 4"]
categories = ["Abfall", "Biogene Abfälle", "Karton", "Häckseldienst", "Grubengut", "Metall", "Papiersammlung", "Sonderabfall", "Christbäume"]



logging.basicConfig(format='%(asctime)s [%(levelname)s] %(message)s', datefmt='%d-%b-%y %H:%M:%S', level=logging.DEBUG)




database = {}



# get districts
logging.info("Fetching districts")
startPage = requests.get(baseUrl + str(baseApid)).text
soup = BeautifulSoup(startPage, 'html.parser')
for link in soup.find_all('a'):
    if "/index.php?apid=" in str(link.get('href')):
        for district in districts:
            if district in str(link):
                # <a href="/index.php?apid=15371233&amp;apparentid=7215088" [..] ><div class="title">Kreis 1</div>
                apid = str(link).split("apid=")[1].split("&")[0]
                logging.info("District %r has apid %r" % (district, apid))
                database[district] = {}
                database[district]["apid"] = int(apid)



# get category apids per district
for district in database:
    logging.info("Fetching district %r..." % district)
    url = baseUrl + str(database[district]["apid"])
    print(url)
    page = requests.get(url).text
    soup = BeautifulSoup(page, 'html.parser')
    for link in soup.find_all('a'):
        if "/index.php?apid=" in str(link.get('href')):
            for category in categories:
                if category in str(link):
                    # <a href="/index.php?apid=15371233&amp;apparentid=7215088" [..] ><div class="title">Kreis 1</div>
                    apid = str(link).split("apid=")[1].split("&")[0]
                    logging.info("category %r in district %r has apid %r" % (category, district, apid))
                    if "categories" not in database[district]:
                        database[district]["categories"] = {}
                    database[district]["categories"][category] = {}
                    database[district]["categories"][category]["apid"] = int(apid)



pprint(database)

with open("apids.json", mode='w') as f:
    json.dump(database, f)