<head>
    <link type="image/x-icon" rel="shortcut icon" href="https://www.wetzikon.ch/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <h1>Smarter Entsorgungskalender f&uuml;r Wetzikon</h1> 

    <?php
 
    include("common.php");
    
    
    function parse_input() {
        global $max_district_id, $available_categories;
        $district = null;
        $categories = [];
    
        
        /* Parse District */
        if (isset($_GET["district"])) {
            if (is_numeric($_GET["district"]) and $_GET["district"] <= $max_district_id) {
                $district = $_GET["district"];
            }
            else {
                throw new Exception('Ung&uuml;ltiger Kreis ausgew&auml;hlt!');
            }
        }
        else {
            throw new Exception('Kein Kreis ausgewählt!');
        }
        
        if ($district == null) {
            throw new Exception('Ung&uuml;ltiger Kreis ausgew&auml;hlt!');
        }

        
        /* Parse categories */
        foreach($available_categories as $category) {
//             echo($_GET["$category"] . "<br>\n");
            if (isset($_GET["$category"])) {
//                 echo("$category<br>\n");
                array_push($categories, $category);
            }
        }
            
        if (count($categories) == 0) {
            throw new Exception('Keine Kategorie ausgewählt!');
        }

        return ["district" => $district, "categories" => $categories];
    }



    function get_ics_url($input) {
        // TODO move
        $base_url = "calendar.php";
        
        
        
        $url = $base_url . "?district=" . $input["district"] . "&categories=";
        foreach ($input["categories"] as $category) {
            $url .= $category . ",";
        }
        
        $url = substr($url, 0, -1);
        
        return $url;
    }
    
    
    
    
    function get_preview_url($ics_url) {
    
    //     $ics_url = str_replace(":", "%3A", $ics_url);
    //     $ics_url = str_replace("/", "", $ics_url);
    
        // TODO generate url
        $encoded_ics_url = urlencode("https://smarter-entsorgungskalender-wetzikon.ruinelli.ch/" . $ics_url);
    
    //     return "https://open-web-calendar.herokuapp.com/calendar.html?language=de&url=$ics_url";
        return $encoded_ics_url;
    }


    
    
    
    
    try {
        $input = parse_input();
    }
    catch (Exception $e) {
        echo("<p>Es ist ein Problem aufgetreten: <b>" . $e->getMessage() . "</b></p>");
        exit();
    }
    ?>


    <p>Sie haben den Kreis <?php echo($input["district"]) ?> mit den folgenden Kategorien gewählt:</p>
    <ul>
        <?php foreach ($input["categories"] as $category) { ?>
            <li><p><?php echo($category); ?></p></li>
        <?php } ?>
    </ul>


    <p>Laden Sie sich ihren pers&ouml;nlichen Entsorgungskalender &uuml;ber den nachfolgenden Link herunter oder abonnieren Sie ihn: 
    <a href="<?php echo(get_ics_url($input)); ?>" target=_blank>Pers&ouml;nlicher Entsorgungskalender</a>.</p>




    <h2>Anleitung zum abonnieren des pers&ouml;nlichen Entsorgungskalender</h2>
    <p>xxx</p>



    <h2>Vorschau</h2>
    <iframe id="open-web-calendar" 
        style="background:url('https://raw.githubusercontent.com/niccokunzmann/open-web-calendar/master/static/img/loaders/circular-loader.gif') center center no-repeat;"
        src="https://open-web-calendar.herokuapp.com/calendar.html?language=de&tabs=month&tabs=agenda&url=<?php echo(get_preview_url(get_ics_url($input))); ?>"
        sandbox="allow-scripts allow-same-origin allow-top-navigation"
        allowTransparency="true" scrolling="no" 
        frameborder="0" height="400px" width="800px"></iframe>
</body>
