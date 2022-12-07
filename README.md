# Smarter Abfallkalender für Wetzikon

Dieses Tool wurde im Rahmen des [Smart City Hackathon Wetzikon]([b](https://hack.smart-city-wetzikon.ch/project/16)) entwickelt.

Die Daten wurden mittels eines Webseiten-Grabbers zusammengetragen. Siehe [data-grabber](data-grabber).

Demo: https://smarter-entsorgungskalender-wetzikon.ruinelli.ch/


# Data Grabbing
Once a year, after https://www.wetzikon.ch/verwaltung/entsorgung contains the new data (usually mid of Dezember), you need to update the database:
```bash
python data-grabber/grab-apids.py
python data-grabber/grab-events.py
```

Then you should manually validate your changes.
