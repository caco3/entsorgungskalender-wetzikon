# Smarter Entsorgungskalender für Wetzikon
This tool got created on the first [Smart City-Hackathon of Wetzikon, Switzerland](https://smart-city-wetzikon.ch/hackathon-2/).

Public Data: https://wetzikon.ch/verwaltung/entsorgung resp. https://m.wetzikon.ch/index.php?apid=7215088

A nice events overview is available on https://wetzikon.ch/verwaltung/entsorgung/02_GzD_Entsorgungskalender_2022_A3_Stadt_Wetzikon.pdf/at_download/file

provided tools:
 * `get-apids.py`: This tool fetches the districts (Kreis) and the categories. The fetched data gets stored in `data/apids.json`.
 * `get-events.py`: This tool fetches all events based on `data/apids.json` and stores the evenets in `data/database.json`.

The categories 'Sonderabfall', 'Papier' and 'Schleifservice' are common to all districts. However the website lists them again (with different apids) on all districts. For simplicity we keep it that way, meaning one always has to select a district.

Example data is provides in [data](data). This data got grabbed on 11.06.2022.
