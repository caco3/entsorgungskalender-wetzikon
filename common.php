<?php


    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    
    $max_district_id = 4; 
    //  $available_categories = ["Abfall", "Biogene Abfälle", "Christbäume", "Grubengut", "Häckseldienst", "Karton", "Metall", "Papiersammlung", "Sonderabfall"];
    $available_categories = ["Abfall", "Christbäume", "Grubengut", "Häckseldienst", "Karton", "Metall", "Papiersammlung", "Sonderabfall"];

    // TODO use server variable  
    $database_file = "data/database.json";


    $ics_header = <<<EOD
    BEGIN:VCALENDAR
    VERSION:2.0
    PRODID:-//hacksw/handcal//NONSGML v1.0//EN
    CALSCALE:GREGORIAN
    EOD;

    $ics_footer = <<<EOD
    END:VCALENDAR
    EOD;



?>
