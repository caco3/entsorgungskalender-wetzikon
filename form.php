<h1>Smarter Entsorgungskalender f&uuml;r Wetzikon</h1> 
<p>Sie k&ouml;nnen sich ihren pers&ouml;nlichen Entsorgungskalender generieren lassen.<br>
W&auml;hlen Sie daf&uuml;r im untenstehenden Formular den gew&uuml;nschten Kreis und Kategorien:</p>

<?php
    // TODO centralize
    $max_district_id = 4; 
    $available_categories = ["Abfall", "Biogene Abfälle", "Christbäume", "Grubengut", "Häckseldienst", "Karton", "Metall", "Papiersammlung", "Sonderabfall"];
?>


<form  action="generate.php">
    <h2>Kreis</h2>
<!--     <p>Ihren kreis finden sie mit https://www.wetzikon.ch/verwaltung/entsorgung</p> -->


    <?php for ($i = 1; $i <= 4; $i++) { ?>
        <input type="radio" id="<?php echo($i); ?>" name="district" value="<?php echo($i); ?>"><label for="<?php echo($i); ?>">Kreis <?php echo($i); ?></label><br>
    <?php } ?>

    
    <h2>Kategorien</h2>
    <?php foreach($available_categories as $c) { ?>
        <input type="checkbox" id="<?php echo($c); ?>" name="<?php echo($c); ?>" value="1"><label for="<?php echo($c); ?>"><?php echo($c); ?></label><br>
    <?php } ?>
    

    <p><br></p>
  <input type="submit" value="Weiter">
    
</form>
