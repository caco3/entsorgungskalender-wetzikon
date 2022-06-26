<head>
    <title>Smarter Entsorgungskalender f&uuml;r Wetzikon</title>
    <link type="image/x-icon" rel="shortcut icon" href="https://www.wetzikon.ch/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <h1>Smarter Entsorgungskalender f&uuml;r Wetzikon</h1> 
    <p>Sie k&ouml;nnen sich ihren pers&ouml;nlichen Entsorgungskalender generieren lassen.<br>
    W&auml;hlen Sie daf&uuml;r im untenstehenden Formular den gew&uuml;nschten Kreis und Kategorien:</p>

    <?php
        include("common.php");
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
        

        <p></p>
    <input type="submit" value="Weiter" class="button">
        
    </form>
    <hr>
    <p>Copyright &copy; 2022 by <a href=mailto:george@ruinelli.ch?subject=Entsorgungskalender>George Ruinelli</a></p>
</body>
