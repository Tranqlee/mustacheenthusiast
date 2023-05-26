<?php
    session_start();
    if(isset($_SESSION['user'])) #if statement to check if the user is logged in
    {
        ?>
        <!doctype html>
        <!-- Website Template by freewebsitetemplates.com -->
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Webtoepassing</title>
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
            <link rel="stylesheet" type="text/css" href="css/NewStyle.css">
            <script type="text/javascript" src="js/mobile.js"></script>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body style="overflow:hidden;">
            <div id="header">
                <!--<a href="index.html">
                    <img src="images/NewLogo1.png" alt="" style="z-index: 0;margin-left: -17vw;margin-top: -2.5dvw;float: left;width: auto;height: 4.5cm;border-radius: 0.25cm;box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);">
                </a>-->
                <ul id="navigation" class="Navigatie" style="position: fixed; padding-right: 1cm; padding-left: 1cm; margin: -2cm auto 0 auto; padding-bottom: 0.5cm; z-index: 1; background-image: linear-gradient(to bottom right, #636B7C, #323C54); border-radius: 0.25cm; box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);">
                    <li class="selected">
                        <a href="http://gip.epizy.com/index.php">| Home |</a>
                    </li>
                    <li>
                        <a href="http://gip.epizy.com/gallery.php">| Products | </a>
                    </li>
                    <li>
                        <a href="http://gip.epizy.com/shoppingcart.php">| Cart |</a>
                    </li>
                    <li>
                        <a href="http://gip.epizy.com/about.html">| About |</a>
                    </li>
                </ul>
                <ul id="navigation" class="Navigatie" style="position:absolute; top: 0; right: 0; padding: 0.25cm 1cm 0.25cm 0cm; z-index: 1; background-image: linear-gradient(to top right, #323C54, #636B7C);border-radius: 0cm 0cm 0cm 0.25cm;box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);">
                    <li style="align-items: right;">
                        <?php
                            echo "Ingelogd als: " . $_SESSION['user'];
                            echo "<br><br>";
                            echo "<a href='loginSHOP.php'>Uitloggen</a>";
                        ?>
                    </li>
                </ul>
            </div>
            <div id="body">
                <div id="featured">
                    <img src="images/BackLogo.png " alt="" style="z-index: -1;position: absolute; margin-top: -4cm;">
                    <!--<div style="margin-top: 12cm; margin-left: -30.5cm; text-align: left;">
                        <h2>Dit is de webshop voor mijn GIP</h2>
                    </div>-->
                </div>
            </div>
        </body>
        </html>
        <?php
    }
    else
    {
        header("Location: loginSHOP.php");
    }
?>