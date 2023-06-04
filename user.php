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
$user = $stmt->fetch();

//telt alle orders van de klant waarbij isBesteld = 1
$sql = $link->prepare("SELECT COUNT(*) FROM `order` WHERE KlantenID = :KLANTENID AND isBesteld = 1");
$sql->bindValue(':KLANTENID', $user['KlantenID']);
$sql->execute();
$orders1count = $sql->fetchColumn();

$sql = $link->prepare("SELECT * FROM `order` WHERE KlantenID = :KLANTENID AND isBesteld = 0");
$sql->bindValue(':KLANTENID', $user['KlantenID']);
$sql->execute();
$orders0 = $sql->fetchAll(PDO::FETCH_ASSOC);

$sql = $link->prepare("SELECT * FROM `order` WHERE KlantenID = :KLANTENID AND isBesteld = 1");
$sql->bindValue(':KLANTENID', $user['KlantenID']);
$sql->execute();
$orders1 = $sql->fetchAll(PDO::FETCH_ASSOC);

$datum = $_SESSION['DATE'];

$winkelkar = $_SESSION['WINKELKAR'];
?>

<!-- Website Template by freewebsitetemplates.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webtoepassing Profiel</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
    <link rel="stylesheet" type="text/css" href="css/NewStyle.css">
    <script type="text/javascript" src="js/mobile.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                width: 25%;
                height: 100%;
                border: none;
            }
            .navbar td {
                width: 50%;
                height: 100%;
                border: none;
            }
            .navbar td:last-child {
                width: 25%;
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
                    <a href="index.php">
                        <img src="images/homeTRANSblue.png" alt="User Profile">
                    </a>
                </div>
            </td>
            <td style="padding-top: -50%;">
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
                            .button h3 {
                                color: lightgray;
                                width: fit-content;
                                height: fit-content;
                                margin: auto;
                            }
                        </style>
                        <tr>
                            <td>
                                <div class="button">
                                    <a>
                                        <h3>Gebruiker: <?php echo $_SESSION['user'] . " ||| " . $orders1count; ?></h3>
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
            div.center {
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;
                margin-top: 1cm;
                position: absolute;
                width: 100%;
            }
            .center h2 {
                color: white;
            }
        </style>
        <h2>Gebruikersinformatie</h2>
        <table class="centertable">
            <style>
                .centertable {
                    background-color: rgb(35, 35, 35);
                    color: white;
                    border-radius: 0.5cm;
                    width: fit-content;
                    padding: 0.5cm;
                    box-shadow: 0px 0px 10px 1px black;
                }
                .centertable tr {
                    width: fit-content;
                }
                .centertable th {
                    height: 1cm;
                    border: none;
                    text-align: right;
                    padding: 0.25cm;
                    padding-right: 0.50cm;
                    color: cornflowerblue;
                    width: fit-content;
                }
                .centertable td {
                    height: 1cm;
                    border: none;
                    text-align: left;
                    padding: 0.25cm;
                    padding-left: 0.5cm;
                    width: fit-content;
                }
            </style>
            <tr>
                <td>
                    Gebruikersnaam:
                </td>
                <th>
                    <?php echo $user['Gebruikersnaam']; ?>
                </th>
                <td>
                    Wachtwoord:
                </td>
                <th>
                    <a href="resetPassword.php" style="color: dodgerblue;">Verander je wachtwoord</a>
                </th>
            </tr>
            <tr>
                <td>
                    E-mail:
                </td>
                <th>
                    <?php echo $user['Email']; ?>
                </th>
                <td>
                    Telefoonnummer:
                </td>
                <th>
                    <?php echo $user['Telefoonnummer']; ?>
                </th>
            </tr>
            <tr>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    Straatnaam:
                </td>
                <th>
                    <?php echo $user['Straatnaam']; ?> 
                </th>
                <td>
                    Huisnummer:
                </td>
                <th>
                    <?php echo $user['Huisnummer']; ?>
                </th>
            </tr>
            <tr>
                <td>
                    Postcode:
                </td>
                <th>
                    <?php echo $user['Postcode']; ?>
                </th>
                <td>
                    Gemeente:
                </td>
                <th>
                    <?php echo $user['Gemeente']; ?>
                </th>
            </tr>
            <tr>
                <td>
                    Geboortedatum:
                </td>
                <th>
                    <?php echo $user['GeboorteDatum']; ?> 
                </th>
                <td>
                </td>
                <td>
                </td>
            </tr>
        </table>
        <br>
        <div class="allebestellingen">
            <style>
                .allebestellingen {
                    width: fit-content;
                    background-color: transparent;
                }
                .allebestellingen table {
                    width: 100%;
                }
                .allebestellingen table tr td h2 {
                    color: white;
                    padding: 0.25cm;
                    text-align: center;
                    width: 50%;
                    margin: auto;
                }
                .allebestellingen table tr td {
                    padding: 0.25cm;
                    width: 100%;
                    margin: auto;
                    vertical-align: top;
                    white-space: nowrap;
                }
            </style>
            <table>
                <tr>
                    <td>
                        <h2>Bestellingen</h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="bestellingen">
                            <style>
                                .bestellingen {
                                    width: 100%;
                                }
                            </style>
                            <table>
                                <tr>
                                    <td>
                                        <?php
                                        foreach ($orders0 as $order0) {
                                            $stmt = $link->prepare("SELECT * FROM orderproduct WHERE OrderID = :ORDERID");
                                            $stmt->bindValue(':ORDERID', $order0['OrderID']);
                                            $stmt->execute();
                                            $orderproducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                            ?>
                                            <div class="inhoud">
                                                <style>
                                                    .inhoud {
                                                        background-color: rgb(35, 35, 35);
                                                        color: white;
                                                        border-radius: 0.5cm;
                                                        width: 100%;
                                                        padding: 0.5cm 0.5cm 0.15cm 0.5cm;
                                                        box-shadow: 0px 0px 10px 1px black;
                                                    }
                                                    .inhoud td {
                                                        color: white;
                                                        padding: 0.05cm 0.15cm;
                                                        white-space: nowrap;
                                                    }
                                                    .inhoud th {
                                                        color: cornflowerblue;
                                                        padding: 0.05cm 0.15cm;
                                                        white-space: nowrap;
                                                    }
                                                </style>
                                                <table class="B1">
                                                    <style>
                                                        .B1 {
                                                            padding-bottom: 0.25cm;
                                                            width: 100%;
                                                        }
                                                        .B1, .B1 tr {
                                                            width: fit-content;
                                                        }
                                                        .B1 td {
                                                            width: 25%;
                                                        }
                                                        .B1 th {
                                                            width: 75%;
                                                            text-align: left;
                                                        }
                                                    </style>
                                                    <tr>
                                                        <td>
                                                            Aanmaakdatum:
                                                        </td>
                                                        <th>
                                                            <?php echo $order0['BestelDatum']; ?>
                                                        </th>
                                                    </tr>
                                                </table>
                                                <div class="B2">
                                                    <table>
                                                        <style>
                                                            .B2 {
                                                                width: 100%;
                                                            }
                                                            .B2 table {
                                                                width: 100%;
                                                                border-top: 2px solid rgb(75, 75, 75);
                                                            }




                                                            .product {
                                                                width: auto;
                                                                text-align: left;
                                                            }
                                                            .aantal {
                                                                width: 2cm;
                                                                text-align: right;
                                                            }
                                                            .prijs {
                                                                width: 2cm;
                                                                text-align: right;
                                                                white-space: nowrap;
                                                            }
                                                            .totaal {
                                                                width: 2cm;
                                                                text-align: right;
                                                                white-space: nowrap;
                                                            }
                                                        </style>
                                                        <tr>
                                                            <td class="product">
                                                                Product
                                                            </td>
                                                            <td class="aantal">
                                                                Aantal
                                                            </td>
                                                            <td class="prijs">
                                                                Prijs
                                                            </td>
                                                            <td class="totaal">
                                                                Subtotaal
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        foreach ($orderproducts as $orderproduct) {
                                                            $stmt = $link->prepare("SELECT * FROM product WHERE ProductID = :PRODUCTID");
                                                            $stmt->bindValue(':PRODUCTID', $orderproduct['ProductID']);
                                                            $stmt->execute();
                                                            $product = $stmt->fetch(PDO::FETCH_ASSOC);

                                                            ?>
                                                            <tr>
                                                                <th class="product">
                                                                    <?php echo $product['Naam']; ?>
                                                                </th>
                                                                <th class="aantal">
                                                                    <?php echo $orderproduct['Aantal']; ?>
                                                                </th>
                                                                <th class="prijs">
                                                                    <?php echo "€ " . $product['Prijs']; ?>
                                                                </th>
                                                                <th class="totaal">
                                                                    <?php echo "€ " . $product['Prijs'] * $orderproduct['Aantal']; ?>
                                                                </th>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </table>
                                                </div>
                                                <div class="B3">
                                                    <style>
                                                        .B3 {
                                                            width: 100%;
                                                        }
                                                        .B3 table.maintable {
                                                            width: 100%;
                                                            border-top: 2px solid rgb(75, 75, 75);
                                                            padding-top: 0.25cm;
                                                        }
                                                        .maintable tr td {
                                                            width: 50%;
                                                        }
                                                    </style>
                                                    <table class="maintable">
                                                        <tr>
                                                            <td>
                                                                <table class="table1">
                                                                    <style>
                                                                        .table1 {
                                                                            width: 100%;

                                                                        }
                                                                        .table1 td {
                                                                            text-align: left;
                                                                        }
                                                                    </style>
                                                                    <tr>
                                                                        <td class="A1">
                                                                            <div>
                                                                                <style>
                                                                                    .A1 {
                                                                                        width: fit-content;
                                                                                        text-align: left;
                                                                                    }
                                                                                    .A1 a img {
                                                                                        background-color: rgb(75, 75, 75);
                                                                                        padding: 0.41cm;
                                                                                        margin: -0.51cm 0 -0.5cm 0;
                                                                                        border-radius: 0.5cm;
                                                                                    }
                                                                                    .A1 a img:hover {
                                                                                        background-color: rgb(55, 55, 55);
                                                                                        border-radius: 0.5cm;
                                                                                        transition: 0.15s;
                                                                                    }
                                                                                    .A1 a img:active {
                                                                                        background-color: rgb(75, 75, 75);
                                                                                        border-radius: 0.5cm;
                                                                                        transition: 0s;
                                                                                    }
                                                                                </style>
                                                                                <?php
                                                                                $betaalid = $order0['OrderID'];
                                                                                echo "<a href='Bestellingverwijderen.php?nr=$betaalid'><img src='images/garbageTRANS.png' style='width: 0.75cm; height: auto;'/></a>";
                                                                                ?>
                                                                            </div>
                                                                        </td>
                                                                        <td class="A2">
                                                                            <div>
                                                                                <style>
                                                                                    .A2 {
                                                                                        width: auto;
                                                                                        text-align: left;
                                                                                    }
                                                                                    .A2 a img {
                                                                                        background-color: rgb(75, 75, 75);
                                                                                        padding: 0.25cm;
                                                                                        margin: -0.50cm;
                                                                                        border-radius: 0.5cm;
                                                                                    }
                                                                                    .A2 a img:hover {
                                                                                        background-color: rgb(55, 55, 55);
                                                                                        padding: 0.25cm;
                                                                                        margin: -0.50cm;
                                                                                        border-radius: 0.5cm;
                                                                                        transition: 0.15s;
                                                                                    }
                                                                                    .A2 a img:active {
                                                                                        background-color: rgb(75, 75, 75);
                                                                                        padding: 0.25cm;
                                                                                        margin: -0.50cm;
                                                                                        border-radius: 0.5cm;
                                                                                        transition: 0s;
                                                                                    }
                                                                                </style>
                                                                                <?php
                                                                                echo "<a href='Bestellingafronden.php?nr=$betaalid'><img src='images/cartTRANS.png' style='width: 1.2cm; height: auto;'/></a>";
                                                                                ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <table class="table2">
                                                                    <style>
                                                                        .table2 {
                                                                            width: 100%;
                                                                        }
                                                                        .table2 td {
                                                                            width: 85%;
                                                                            text-align: right;
                                                                        }
                                                                        .table2 th {
                                                                            width: 15%;
                                                                            text-align: right;
                                                                        }
                                                                    </style>
                                                                    <tr>
                                                                        <td>
                                                                            Totaalprijs:
                                                                        </td>
                                                                        <th>
                                                                            <?php echo "€ " . $order0['Totaalprijs']; ?>
                                                                        </th>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <br>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2>Afgeronde bestellingen</h2>
                    </td>
                </tr>
                <tr>
                    <?php
                    if($orders1count > 0)
                    {
                        ?>
                        <td>
                            <div class="bestellingen">
                                <style>
                                    .bestellingen {
                                        width: 93.5%;
                                    }
                                </style>
                                <table>
                                    <tr>
                                        <td>
                                            <?php
                                            foreach ($orders1 as $order1) {
                                                $stmt = $link->prepare("SELECT * FROM orderproduct WHERE OrderID = :ORDERID");
                                                $stmt->bindValue(':ORDERID', $order1['OrderID']);
                                                $stmt->execute();
                                                $orderproducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                ?>
                                                <div class="inhoud">
                                                    <style>
                                                        .inhoud {
                                                            background-color: rgb(35, 35, 35);
                                                            color: white;
                                                            border-radius: 0.5cm;
                                                            width: 100%;
                                                            padding: 0.5cm;
                                                            box-shadow: 0px 0px 10px 1px black;
                                                        }
                                                        .inhoud td {
                                                            color: white;
                                                            padding: 0.05cm 0.15cm;
                                                            white-space: nowrap;
                                                        }
                                                        .inhoud th {
                                                            color: cornflowerblue;
                                                            padding: 0.05cm 0.15cm;
                                                            white-space: nowrap;
                                                        }
                                                    </style>
                                                    <table class="B1">
                                                        <style>
                                                            .B1 {
                                                                padding-bottom: 0.25cm;
                                                                width: 100%;
                                                            }
                                                            .B1, .B1 tr {
                                                                width: fit-content;
                                                            }
                                                            .B1 td {
                                                                width: 25%;
                                                            }
                                                            .B1 th {
                                                                width: 75%;
                                                                text-align: left;
                                                            }
                                                        </style>
                                                        <tr>
                                                            <td>
                                                                Besteldatum:
                                                            </td>
                                                            <th>
                                                                <?php echo $order1['BestelDatum']; ?>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                    <div class="B2">
                                                        <table>
                                                            <style>
                                                                .B2 {
                                                                    width: 100%;
                                                                }
                                                                .B2 table {
                                                                    width: 100%;
                                                                    border-top: 2px solid rgb(75, 75, 75);
                                                                }




                                                                .product {
                                                                    width: auto;
                                                                    text-align: left;
                                                                }
                                                                .aantal {
                                                                    width: 2cm;
                                                                    text-align: right;
                                                                }
                                                                .prijs {
                                                                    width: 2cm;
                                                                    text-align: right;
                                                                    white-space: nowrap;
                                                                }
                                                                .totaal {
                                                                    width: 2cm;
                                                                    text-align: right;
                                                                    white-space: nowrap;
                                                                }
                                                            </style>
                                                            <tr>
                                                                <td class="product">
                                                                    Product
                                                                </td>
                                                                <td class="aantal">
                                                                    Aantal
                                                                </td>
                                                                <td class="prijs">
                                                                    Prijs
                                                                </td>
                                                                <td class="totaal">
                                                                    Totaal
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            foreach ($orderproducts as $orderproduct) {
                                                                $stmt = $link->prepare("SELECT * FROM product WHERE ProductID = :PRODUCTID");
                                                                $stmt->bindValue(':PRODUCTID', $orderproduct['ProductID']);
                                                                $stmt->execute();
                                                                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                                                                ?>
                                                                <tr>
                                                                    <th class="product">
                                                                        <?php echo $product['Naam']; ?>
                                                                    </th>
                                                                    <th class="aantal">
                                                                        <?php echo $orderproduct['Aantal']; ?>
                                                                    </th>
                                                                    <th class="prijs">
                                                                        <?php echo "€ " . $product['Prijs']; ?>
                                                                    </th>
                                                                    <th class="totaal">
                                                                        <?php echo "€ " . $product['Prijs'] * $orderproduct['Aantal']; ?>
                                                                    </th>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                        </table>
                                                    </div>
                                                    <div class="B3">
                                                        <style>
                                                            .B3 {
                                                                width: 100%;
                                                            }
                                                            .B3 table.maintable {
                                                                width: 100%;
                                                                border-top: 2px solid rgb(75, 75, 75);
                                                                padding-top: 0.25cm;
                                                            }
                                                            .maintable tr td {
                                                                width: 50%;
                                                            }
                                                        </style>
                                                        <table class="maintable">
                                                            <tr>
                                                                <td>
                                                                    <table class="table1">
                                                                        <style>
                                                                            .table1 {
                                                                                width: 100%;
                                                                            }
                                                                            .table1 td {
                                                                                width: 100%;
                                                                                text-align: left;
                                                                            }
                                                                        </style>
                                                                        <tr>
                                                                            <td>

                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td>
                                                                    <table class="table2">
                                                                        <style>
                                                                            .table2 {
                                                                                width: 100%;
                                                                            }
                                                                            .table2 td {
                                                                                width: 85%;
                                                                                text-align: right;
                                                                            }
                                                                            .table2 th {
                                                                                width: 15%;
                                                                                text-align: right;
                                                                            }
                                                                        </style>
                                                                        <tr>
                                                                            <td>
                                                                                Totaalprijs:
                                                                            </td>
                                                                            <th>
                                                                                <?php echo "€ " . $order1['Totaalprijs']; ?>
                                                                            </th>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <?php
                    }
                    ?>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>