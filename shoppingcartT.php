<?php
require_once('comm.php');
session_start();
$link = getDatabase();

if (!isset($_SESSION['user'])) { #if statement to check if the user is logged in
    header('Location: loginSHOP.php');
}

$stmt = $link->prepare("SELECT * FROM klant WHERE Gebruikersnaam = :username");
$stmt->bindParam(':username', $_SESSION['user']);
$stmt->execute();
$result = $stmt->fetch();

if(!isset($_SESSION['editamount']))
{
    $_SESSION['editamount'] = 0;
}

if(isset($_POST['action']))
{
    unset($_SESSION['WINKELKAR']);
    header('Location: shoppingcartT.php');
}



date_default_timezone_set('Europe/Brussels');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['bestellen']))
    {

        //haalt de huidige datum en tijd op
        $huidigeDatum = new DateTime();

        $jaar = $huidigeDatum->format('Y');
        $maand = $huidigeDatum->format('m');
        $dag = $huidigeDatum->format('d');
        $uur = $huidigeDatum->format('H');
        $minuten = $huidigeDatum->format('i');
        $seconden = $huidigeDatum->format('s');

        $datumTijd = $jaar . '-' . $maand . '-' . $dag . ' ' . $uur . ':' . $minuten . ':' . $seconden;

        $_SESSION['DATE'] = $datumTijd;
        $_SESSION['TOTALORDERPRICE'] = $totaaltotaalprijs;

        header("location: bestellen.php");
    }
}


$gevonden = false;
if(isset($_SESSION['WINKELKAR']))
{
    $winkelkar = $_SESSION['WINKELKAR'];

    for( $i=0; $i<count($winkelkar) and !$gevonden; $i++ )
    {
        if( $winkelkar[$i]['ProductID']==$_POST['ProductID'] )
        {
            $gevonden = true;
            $winkelkar[$i]['AANTAL']++;
        }
    }
}
?>





<!-- Website Template by freewebsitetemplates.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webtoepassing Winkelkar</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
    <link rel="stylesheet" type="text/css" href="css/NewStyle.css">
    <script type="text/javascript" src="js/mobile.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script>
    function sendDate() {
        // Stuur de datum naar hetzelfde PHP-bestand
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
            console.log('Datum is succesvol naar PHP gestuurd');
            document.getElementById('currentDateTime').textContent = this.responseText;
            }
        };
        xhttp.open('POST', '', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('bestellen=1');
    }
  </script>
</head>
<body style="overflow-y: scroll;">
    <style>
        body {
            width: 100%;
            background-color: rgb(75, 75, 75);
        }
    </style>
    <table class="navbar">
        <style>
            .navbar {
                background-color: rgb(35, 35, 35);
                box-shadow: 0px 0px 10px 2px black;
                color: white;
            }
            .navbar , .navbar tr {
                width: 100%;
                height: 1cm;
            }
            .navbar td:first-child {
                width: 33.333%;
                height: 100%;
                border: none;
            }
            .navbar td {
                width: 33.333%;
                height: 100%;
                border: none;
            }
            .navbar td:last-child {
                width: 33.333%;
                height: 100%;
                border: none;
                text-align: right;
            }
        </style>
        <tr>
            <td>
                <div class="leftnav">
                    <style>
                        .leftnav {
                            justify-content: left;
                            align: left;
                            float: left;
                            width: fit-content;
                        }
                        .leftnav a {
                            display: inline-block;
                            padding: 0.25cm;
                            margin-left: 0.25cm;
                            width: fit-content;
                            height: fit-content;
                            border: none;
                            border-radius: 0.5cm;
                            background-color: transparent;
                            transition: 0.05s;
                        }
                        .leftnav a:hover {
                            background-color: rgb(75, 75, 75);
                            transition: 0.25s;
                        }
                        .leftnav img {
                            width: 0.875cm;
                            height: auto;
                        }
                    </style>
                    <a href="user.php">
                        <img src="images/userTRANSblue.png" alt="User Profile">
                    </a>
                    <?php
                    if($result['isAdmin'] == 1)
                    {
                        ?>
                        <a href="admin.php" style="height: fit-content;">
                            <img src="images/adminTRANS.png" alt="Admin" style="height: 33.06px; width: auto;">
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </td>
            <td>
                <div class="middlenav">
                    <style>
                        .middlenav {
                            justify-content: center;
                            align: center;
                            float: center;
                            width: 100%;
                        }
                        .middlenav table {
                            width: 100%;
                            height: 100%;
                        }
                        .middlenav td {
                            width: 33.333%;
                            height: 100%;
                            text-align: center;
                            border-left: 5px solid rgb(75, 75, 75);
                            border-right: 5px solid rgb(75, 75, 75);
                        }
                    </style>
                    <table>
                        <style>
                            .button {
                                justify-content: center;
                                align: center;
                                float: center;
                                width: fit-content;
                                background-color: transparent;
                                margin: auto;
                            }
                            .button a {
                                width: fit-content;
                                height: fit-content;
                                border: none;
                                border-radius: 0.5cm;
                                color: lightgray;
                                transition: 0.05s;
                                box-shadow: 0px 0px 10px 2px black;
                                text-align: center;
                                text-decoration: none;
                            }
                            .button a:hover {
                                background-color: white;
                                width: fit-content;
                                transition: 0.05s;
                                box-shadow: 0px 0px 10px 2px black;
                                text-decoration: underline 1.5px solid white;
                            }
                            .button h3 {
                                color: lightgray;
                                width: fit-content;
                                height: fit-content;
                                margin: auto;
                            }
                            .selected a {
                                text-decoration: underline 1.5px solid white;
                            }
                        </style>
                        <tr>
                            <td>
                                <div class="button">
                                    <a href="index.php">
                                        <h3>Home</h3>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="button">
                                    <a href="galleryT.php">
                                        <h3>Producten</h3>
                                    </a>
                                </div>
                            </td>
                            <td style="background-color: rgb(50, 50, 50);">
                                <div class="button selected">
                                    <a href="shoppingcartT.php">
                                        <h3>Winkelkar</h3>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
            <td>
                <div class="rightnav">
                    <style>
                        .rightnav {
                            justify-content: center;
                            align: right;
                            float: right;
                            width: fit-content;
                            height: fit-content;
                            text-align: center;
                        }
                        .rightnav a {
                            display: inline-block;
                            padding: 0.25cm;
                            margin-right: 0.25cm;
                            width: fit-content;
                            height: fit-content;
                            border: none;
                            border-radius: 0.5cm;
                            background-color: transparent;
                            transition: 0.05s;
                        }
                        .rightnav a:hover {
                            background-color: rgb(75, 75, 75);
                            transition: 0.25s;
                        }
                        .rightnav img {
                            width: 0.875cm;
                            height: auto;
                        }

                    </style>
                    <a href="loginSHOP.php">
                        <img src="images/logoutTRANSred.png" alt="Logout">
                    </a>
                </div>
            </td>
        </tr>
    </table>
    <div class="center">
        <style>
            center {
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;
                margin: auto;
                position: absolute;
            }
        </style>
        <div class="content">
            <style>
                .content {
                    margin: auto;
                    justify-content: center;
                    width: fit-content;
                    height: fit-content;
                    background-color: transparent;
                    padding: 1cm;
                    border-radius: 1cm;
                }
                .content table {
                    width: 100%;
                    height: 100%;
                }
            </style>
            <div style="width: fit-content;">
                <style>
                    .item {
                        background-color: rgb(35, 35, 35);
                        border-radius: 0.5cm;
                        margin: -0.5cm;
                        margin-bottom: 0.5cm;
                        margin-top: 0.5cm;
                        padding: 0.5cm;
                        width: 100%;
                        box-shadow: 0px 0px 10px 2px black;
                    }
                   .item table, .item tr {
                        width: fit-content;
                        height: fit-content;
                    }
                    .item th, .item td {
                        width: fit-content;
                        height: fit-content;
                    }
                    .item img {
                        width: 3.2cm;
                        height: auto;
                    }
                    .item p {
                        color: white;
                    }



                    .info1 {
                        width: 100%;
                        height: 100%;
                        background-color: transparent;
                    }
                    .info1 tr {
                        padding: 0.15cm;
                    }
                    .info1 th {
                        width: fit-content;
                        height: min-content;
                        text-align: left;
                    }
                    .info1 th p {
                        color: white;
                        font-weight: bold;
                        width: max-content;
                        padding: 0.25cm
                    }
                    .info1 td {
                        width: max-content;
                        height: auto;
                        text-align: left;
                    }
                    .info1 td p {
                        color: cornflowerblue;
                        font-weight: bold;
                        width: 7.5cm;
                    }



                    .beschrijving {
                        width: 100%;
                    }
                    .beschrijving strong {
                        color: white;
                    }



                    .image {
                        width: fit-content;
                    }
                    .image div {
                        border: 5px solid black;
                        border-radius: 0.15cm;
                        background-color: black;
                        width: fit-content;
                        height: fit-content;
                    }
                    .image img {
                        width: 3.55cm;
                        height: auto;
                    }



                    .aantaledit td a img {
                        width: 1cm;
                        height: 1cm;
                        
                    }



                    .totalprice {
                        background-color: rgb(75, 75, 75);
                        padding: 0.10cm 0.25cm;
                        border-radius: 0.25cm;
                        float: right;
                        display: table-cell;
                        width: fit-content;
                        box-shadow: 0px 0px 10px 2px rgb(15, 15, 15);
                    }
                    .totalprice div p {
                        color: white;
                        text-align: right;
                        width: fit-content;
                    }
                    .totalprice p {
                        text-align: right;
                        width: fit-content;
                    }
                </style>
                <?php
                $winkelkar = $_SESSION['WINKELKAR'];
                for($i = 0; $i < count($winkelkar); $i++)
                {
                    if($i > 0)
                    {
                        $stmt = $link->prepare("SELECT * FROM product WHERE ProductID = :ProductID");
                        $stmt->bindParam(':ProductID', $winkelkar[$i]['ProductID']);
                        $stmt->execute();
                        $product = $stmt->fetch(PDO::FETCH_ASSOC);

                        $temporaryitemID = $product['ProductID'];

                        $totaalprijs = ($product['Prijs'] * $winkelkar[$i]['AANTAL']);
                        $winkelkar[$i]['TOTAALPRIJS'] = $totaalprijs;
                        $_SESSION['WINKELKAR'] = $winkelkar;

                        if($i == 1)
                        {
                            $totaaltotaalprijs = $winkelkar[$i]['TOTAALPRIJS'];
                            $_SESSION['TOTAALTOTAALPRIJS'] = $totaaltotaalprijs;
                        }
                        else
                        {
                            $totaaltotaalprijs = $totaaltotaalprijs + $winkelkar[$i]['TOTAALPRIJS'];
                            $_SESSION['TOTAALTOTAALPRIJS'] = $totaaltotaalprijs;
                        }

                        $_SESSION['TOTAALTOTAALPRIJS'] = 0;
                        ?>
                        <div class="item">
                            <table>
                                <tr>
                                    <td class="image">
                                        <div>
                                            <img src="<?php echo 'productimages/' . $product['Afbeelding']; ?>" alt="Product image">
                                        </div>
                                    </td>
                                    <td style="vertical-align: top;">
                                        <table class="info1">
                                            <tr>
                                                <th>
                                                    <p>Naam:</p>
                                                </th>
                                                <td>
                                                    <p><?php echo $product['Naam']; ?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <p>Prijs:</p>
                                                </th>
                                                <td>
                                                    <p>€ <?php echo $product['Prijs']; ?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <p>Aantal:</p>
                                                </th>
                                                <td>
                                                    <p><?php echo $winkelkar[$i]['AANTAL']; ?></p>
                                                </td>
                                            </tr>
                                            <tr class="aantaledit">
                                                <td>
                                                    <?php
                                                    $plus1ID = $winkelkar[$i]['ProductID'];
                                                    echo "<a href='PLUS1.php?nr=$plus1ID'><img src='images/mobile-collapse.png' alt='+1'></a>";
                                                    $minus1ID = $winkelkar[$i]['ProductID'];
                                                    echo "<a href='MINUS1.php?nr=$minus1ID'><img src='images/mobile-expand.png' alt='-1'></a>";
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="totalprice">
                                                        <div>
                                                            <p>Totaalprijs:</p>
                                                        </div>
                                                        <p style="width: fit-content;">€ <?php echo $winkelkar[$i]['TOTAALPRIJS']; ?></p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                }
                ?>
                <style>
                    .bestellen tr {
                        height: fit-content;
                    }
                    .bestellen tr td div form {
                        display: inline-block;
                        vertical-align: middle;
                        margin-bottom: 0cm;
                        height: 100%;
                    }
                    .bestellen input {
                        width: auto;
                        height: 1cm;
                        background-color: rgb(35, 35, 35);
                        border-radius: 0.35cm;
                        padding: 0.15cm;
                    }
                    .bestellen input:hover {
                        width: auto;
                        height: 1cm;
                        background-color: rgb(45, 45, 45);
                        border-radius: 0.35cm;
                        padding: 0.15cm;
                    }



                    .extra input {
                        width: auto;
                        height: 0.85cm;
                        padding: 0.225cm;
                    }
                    .extra input:hover {
                        width: auto;
                        height: 0.85cm;
                        padding: 0.225cm;
                    }



                    .animation:hover {
                        filter: invert(75%);
                        transition: 0.15s;
                    }
                    .animation:active {
                        filter: invert(0%);
                        transition: 0.0s;
                    }



                    .cartbuttons {
                        background-color: rgb(35, 35, 35);
                        padding: 0.15cm 0.15cm 0.15cm 0.15cm;
                        border-radius: 0.25cm;
                        float: left;
                        display: table-cell;
                        vertical-align: middle;
                        width: fit-content;
                        box-shadow: 0px 0px 10px 2px black;
                    }
                    .cartbuttons form {
                        display: inline-block;  
                        height: fit-content;                      
                    }



                    .totaltotalprice {
                        background-color: rgb(35, 35, 35);
                        padding: 0.15cm 0.25cm 0.15cm 0.15cm;
                        border-radius: 0.25cm;
                        float: right;
                        display: inline-block;
                        width: fit-content;
                        box-shadow: 0px 0px 10px 2px black;
                    }
                    .totaltotalprice div {
                        display: inline-block;
                        vertical-align: top;
                    }
                    .totaltotalprice div p {
                        color: cornflowerblue;
                        text-align: right;
                        width: fit-content;
                        font-weight: bold;
                    }
                    .totaltotalprice div div p {
                        color: white;
                    }
                    .totaltotalprice div, .totaltotalprice div form
                    {
                        margin-bottom: 0cm;
                        height: fit-content;
                    }
                </style>
                <table class="bestellen">
                    <tr>
                        <td>
                            <div class="cartbuttons">
                                <form action="" method="POST" class="extra">
                                    <input type="hidden" name="action" value="empty">
                                    <input class="animation" type="image" src="images/garbageTRANS.png" alt="Submit"/>
                                </form>
                            </div>
                        </td>
                        <td>
                            <div class="totaltotalprice">
                                <div>
                                    <form action="" method="POST">
                                        <input type="hidden" name="bestellen" value="empty">
                                        <input class="animation" type="image" src="images/cartTRANS.png" alt="Submit"/>
                                    </form>
                                </div>
                                <div>
                                    <div>
                                        <p>Totaalprijs:</p>
                                    </div>
                                    <p style="width: fit-content;">€ <?php echo $totaaltotaalprijs; $_SESSION['TOTALORDERPRICE'] = $totaaltotaalprijs; ?></p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>