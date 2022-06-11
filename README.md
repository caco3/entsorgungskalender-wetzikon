# Smarter Entsorgungskalender für Wetzikon
This tool got created on the first [Smart City-Hackathon of Wetzikon, Switzerland](https://smart-city-wetzikon.ch/hackathon-2/).

Public Data: https://wetzikon.ch/verwaltung/entsorgung resp. https://m.wetzikon.ch/index.php?apid=7215088

provided tools:
 * `get-apids.py`: This tool fetches the districts (Kreis) and the categories. The fetched data gets stored in `data/apids.json`.
 * `get-events.py`: This tool fetches all events based on `data/apids.json` and stores the evenets in `data/database.json`.

Example data is provides in `data/*-2022.json`. This data got grabbed on 11.06.2022.