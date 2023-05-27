<?php
session_start();

if (!isset($_SESSION['user'])) { #if statement to check if the user is logged in
    header('Location: login.php');
}
?>


    <!doctype html>
    <!-- Website Template by freewebsitetemplates.com -->
<html lang="en">
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
    <ul id="navigation" class="Navigatie"
        style="position: fixed; padding-right: 1cm; padding-left: 1cm; margin: 0 auto 0 auto; padding-bottom: 0.5cm; z-index: 1; background-image: linear-gradient(to bottom right, #636B7C, #323C54); border-radius: 0.25cm; box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);">
        <li class="selected">
            <a href="http://gip.epizy.com/index.php">| Home |</a>
        </li>
        <li>
            <a href="http://gip.epizy.com/about.html">| About |</a>
        </li>
        <?php
        if($isAdmin['isAdmin'] == 1)
        {
        ?>
        <li>
            <a href="http://gip.epizy.com/adminPanel.php">| Admin panel |</a>
        </li>
        <?php
        }
        else
        {
        ?>
        <li>
            <a href="http://gip.epizy.com/gallery.php">| Gallery |</a>
        </li>
        <?php
        }
        ?>
        <li>
            <a href="http://gip.epizy.com/gallery.php">| Gallery |</a>
        </li>
    </ul>
    <ul id="navigation" class="Navigatie"
        style="position:absolute; top: 0; right: 0; padding: 0.25cm 1cm 0.25cm 0cm; z-index: 1; background-image: linear-gradient(to top right, #323C54, #636B7C);border-radius: 0cm 0cm 0cm 0.25cm;box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);">
        <li style="align-items: right;">
            <?php
            echo "Ingelogd als: " . $_SESSION['user'];
            echo "<br><br>";
            echo "<a href='loginSHOP.php'>Uitloggen</a>";
            ?>
        </li>
    </ul>
</div>
<div>
    <div>
        <table>
            <tr>
                <td>
                    <a href="http://gip.epizy.com/gallery.php">
                        <img src="images/Shop.png" alt="Shopping image"
                             style="width: 2cm; height: 2cm; margin-left: 1cm; margin-top: 1cm;">
                    </a>
                </td>
                <td>
                    <a href="http://gip.epizy.com/shoppingcart.php">
                        <img src="images/Cart.png" alt="Cart image"
                             style="width: 2cm; height: 2cm; margin-left: 1cm; margin-top: 1cm;">
                    </a>
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
<?php
