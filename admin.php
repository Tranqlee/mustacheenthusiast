<?php
require_once('comm.php');
session_start();
$link = getDatabase();

$stmt = $link->prepare("SELECT * FROM klant WHERE Gebruikersnaam = :username");
$stmt->bindParam(':username', $_SESSION['user']);
$stmt->execute();
$result = $stmt->fetch();





if (!isset($_SESSION['user'])) { #if statement to check if the user is logged in
    header('Location: loginSHOP.php');
}
if ($result['isAdmin'] != 1) {
    header('Location: loginSHOP.php');
}





if(isset($_POST['directorname']))
{
    $stmt = $link->prepare("INSERT INTO regisseuren (Naam) VALUES (:directorname)");
    $stmt->bindParam(':directorname', $_POST['directorname']);
    $stmt->execute();
    $_SESSION['alert'] = "Regisseur is toegevoegd";
}





if(isset($_POST['productname']))
{
    $stmt = $link->prepare("INSERT INTO product (Afbeelding, Naam, GenreID, Prijs, Beschrijving, RegisseurID, Leeftijd, Aantal) VALUES (:productimage, :productname, :productgenre, :productprice, :productdescription, :productdirector, :productage, :productamount)");
    $stmt->bindParam(':productimage', $_POST['productimage']);
    $stmt->bindParam(':productname', $_POST['productname']);
    $stmt->bindParam(':productgenre', $_POST['productgenre']);
    $stmt->bindParam(':productprice', $_POST['productprice']);
    $stmt->bindParam(':productdescription', $_POST['productdescription']);
    $stmt->bindParam(':productdirector', $_POST['productdirector']);
    $stmt->bindParam(':productage', $_POST['productage']);
    $stmt->bindParam(':productamount', $_POST['productamount']);
    $stmt->execute();
}
if(isset($_POST['productnamewijzigen']))
{
    $stmt = $link->prepare("UPDATE product SET Afbeelding = :productimagewijzigen, Naam = :productnamewijzigen, GenreID = :productgenrewijzigen, Prijs = :productpricewijzigen, Leeftijd = :productagewijzigen, Beschrijving = :productdescriptionwijzigen, RegisseurID = :productdirectorsidwijzigen, Aantal = :productamountwijzigen WHERE ProductID = :productidwijzigen");
    $stmt->bindParam(':productimagewijzigen', $_POST['productimagewijzigen']);
    $stmt->bindParam(':productnamewijzigen', $_POST['productnamewijzigen']);
    $stmt->bindParam(':productgenrewijzigen', $_POST['productgenrewijzigen']);
    $stmt->bindParam(':productpricewijzigen', $_POST['productpricewijzigen']);
    $stmt->bindParam(':productagewijzigen', $_POST['productagewijzigen']);
    $stmt->bindParam(':productdescriptionwijzigen', $_POST['productdescriptionwijzigen']);
    $stmt->bindParam(':productdirectorsidwijzigen', $_POST['productdirectorwijzigen']);
    $stmt->bindParam(':productamountwijzigen', $_POST['productamountwijzigen']);
    $stmt->bindParam(':productidwijzigen', $_POST['productidwijzigen']);
    $stmt->execute();
}

$alert = $_SESSION['alert'];
if($alert == "Gebruiker is verwijderd")
{
    echo "<script>alert('Gebruiker is verwijderd');</script>";
    $alert = "";
}
elseif($alert == "Product is toegevoegd")
{
    echo "<script>alert('Product is toegevoegd');</script>";
    $alert = "";
}
elseif($alert == "Product is verwijderd")
{
    echo "<script>alert('Product is verwijderd');</script>";
    $alert = "";
}
elseif($alert == "Product is aangepast")
{
    echo "<script>alert('Product is aangepast');</script>";
    $alert = "";
}
elseif($alert == "Regisseur is toegevoegd")
{
    echo "<script>alert('Regisseur is toegevoegd');</script>";
    $alert = "";
}
elseif($alert == "Regisseur is verwijderd")
{
    echo "<script>alert('Regisseur is verwijderd');</script>";
    $alert = "";
}
?>





<!-- Website Template by freewebsitetemplates.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webtoepassing Admin Paneel</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
    <link rel="stylesheet" type="text/css" href="css/NewStyle.css">
    <script type="text/javascript" src="js/mobile.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
</head>
<body>
    <style>
        body {
            width: 100%;
            height: 100%;
            background-color: rgb(75, 75, 75);
            overflow-y: scroll;
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
                            <td>
                                <div class="button">
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
    <p>
        <br><br><br>
    </p>
    <div style="margin: auto;">
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
            </style>
            <div class="userlist">
                <h1>Gebruikers</h1>
                <table>
                    <style>
                        .userlist {
                            margin: auto;
                            justify-content: center;
                            width: fit-content;
                            height: 100%;
                            background-color: rgb(35, 35, 35);
                            padding: 0.5cm;
                            margin: auto;
                            border-radius: 1cm;
                        }
                        .userlist h1 {
                            text-align: center;
                            color: white;
                            width: fit-content;
                            margin-left: auto;
                            margin-right: auto;
                        }

                        .userlist table {
                            color: white;
                            margin: auto;
                            width: 100%;
                        }
                        .userlist th {
                            border-right: 2px solid gray;
                            border-bottom: 2px solid gray;
                            padding: 0.15cm 0.15cm 0.15cm 0.15cm;
                            width: auto;
                            font-size: small;
                        }
                        .userlist th:last-child {
                            border-right: none;
                        }
                        .userlist td {
                            border-right: 2px solid gray;
                            padding: 0.15cm 0.15cm 0.25cm 0.15cm;
                            width: auto;
                            font-size: small;
                        }
                        .userlist td:last-child {
                            border-right: none;
                        }
                        .delete1 a {
                            margin: auto;
                            padding-right: 0.40cm;
                        }
                        .delete1 img {
                            width: 40%;
                            height: 40%;
                        }
                        .delete1 img:hover {
                            transition: 0.1s;
                            filter: invert(45%);
                        }
                    </style>
                    <?php
                    $query = $link->query("SELECT * FROM klant");
                    $klanten = $query->fetchAll();
                    ?>
                    <tr>
                        <th style="width: auto;">Klanten ID</th>
                        <th style="width: auto;">Gebruikersnaam</th>
                        <th style="width: auto;">E-mail</th>
                        <th style="width: auto;">Telefoonnummer</th>
                        <th style="width: auto;">Straatnaam</th>
                        <th style="width: auto;">Huisnummer</th>
                        <th style="width: auto;">Postcode</th>
                        <th style="width: auto;">Gemeente</th>
                        <th style="width: auto;">Geboortedatum</th>
                        <th style="width: 2cm;">Verwijderen</th>
                    </tr>
                    <?php 
                    foreach($klanten as $klant):
                    ?>
                    <tr>
                        <td style="text-align: right;"><?php echo $klant['KlantenID']; ?></td>
                        <td style="text-align: right;"><?php echo $klant['Gebruikersnaam']; ?></td>
                        <td style="text-align: right;"><?php echo $klant['Email']; ?></td>
                        <td style="text-align: right;"><?php echo $klant['Telefoonnummer']; ?></td>
                        <td style="text-align: right;"><?php echo $klant['Straatnaam']; ?></td>  
                        <td style="text-align: right;"><?php echo $klant['Huisnummer']; ?></td>
                        <td style="text-align: right;"><?php echo $klant['Postcode']; ?></td>
                        <td style="text-align: right;"><?php echo $klant['Gemeente']; ?></td>
                        <td style="text-align: right;"><?php echo $klant['GeboorteDatum']; ?></td>
                        <?php
                        $userid = $klant['KlantenID'];
                        echo "<td style='text-align: right;' class='delete1'><a href='deleteUser.php?nr=$userid'><img src='images/garbageTRANS.png' alt='Verwijderen'/></a></td>";
                        ?>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </table>
            </div>
            <br>
            <div class="extralist">
                <style>
                    .extralist {
                        margin: auto;
                        justify-content: center;
                        background-color: rgb(35, 35, 35);
                        border-radius: 1cm;
                    }
                    .extralist table {
                        width: 95%;
                        margin: auto;
                    }
                    .extralist tr {
                        width: 100%;
                    }
                    .extralist td {
                        width: 50%;
                        vertical-align: top;
                    }
                </style>
                <table>
                    <tr>
                        <td>
                            <div class="directorlist">
                                <div>
                                    <h1>Regisseurs</h1>
                                    <table>
                                        <style>
                                            .directorlist {
                                                justify-content: center;
                                                width: fit-content;
                                                height: 100%;
                                                background-color: transparent;
                                                padding: 0.5cm;
                                                border-radius: 1cm;
                                            }
                                            .directorlist h1 {
                                                text-align: center;
                                                color: white;
                                                width: fit-content;
                                                margin-left: auto;
                                                margin-right: auto;
                                            }
                                            .directorlist h2 {
                                                text-align: left;
                                                color: white;
                                                width: fit-content;
                                            }
                                            .directorlist table {
                                                color: white;
                                                width: fit-content;
                                            }
                                            .directorlist th {
                                                border-right: 2px solid gray;
                                                border-bottom: 2px solid gray;
                                                padding: 0.25cm 0.5cm 0.25cm 0.5cm;
                                                width: fit-content;
                                                font-size: small;
                                            }
                                            .directorlist th:last-child {
                                                border-right: none;
                                            }
                                            .directorlist td {
                                                border-right: 2px solid gray;
                                                padding: 0.25cm 0.5cm 0.25cm 0.5cm;
                                                width: fit-content;
                                                font-size: small;
                                            }
                                            .directorlist td:last-child {
                                                border-right: none;
                                            }
                                            .directorlist p {
                                                width: fit-content;
                                            }
                                        </style>
                                        <?php
                                        $query = $link->query("SELECT * FROM regisseuren");
                                        $regisseurs = $query->fetchAll();
                                        ?>
                                        <tr>
                                            <th style="width: 2cm;">Regisseur ID</th>
                                            <th style="width: max-content;">Regisseur namen</th>
                                            <th style="width: fit-content;">Verwijderen</th>
                                        </tr>
                                        <?php 
                                        foreach($regisseurs as $regisseur):
                                        ?>
                                        <tr class="regisseur1">
                                            <style>
                                                .delete1 img {
                                                    width: 0.875cm;
                                                    height: auto;
                                                }
                                                .delete1 img:hover {
                                                    transition: 0.1s;
                                                    filter: invert(45%);
                                                }
                                                .regisseur1 td {
                                                    text-align: right;
                                                    vertical-align: middle;
                                                    display: table-cell;
                                                }
                                            </style>
                                            <td style="text-align: right;"><?php echo $regisseur['RegisseurID']; ?></td>
                                            <td style="text-align: right;"><?php echo $regisseur['Naam']; ?></td>
                                            <?php
                                            $directorid = $regisseur['RegisseurID'];
                                            echo "<td style='text-align: right;' class='delete1'><a href='deleteDirector.php?nr=$directorid'><img src='images/garbageTRANS.png' alt='Regisseur verwijderen'/></a></td>";
                                            ?>
                                        </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                    </table>
                                    <div>
                                        <style>
                                            .regisseurtoevoegen {
                                                color: white;
                                                width: fit-content;
                                                margin-left: auto;
                                                margin-right: auto;
                                            }
                                            .regisseurtoevoegen label {
                                                width: fit-content;
                                                margin-left: auto;
                                                margin-right: auto;
                                                display: block;
                                            }
                                            .nameregisseur {
                                                padding: 0.25cm;
                                                border: none;
                                                border-radius: 0.25cm;
                                            }
                                            .submitregisseur {
                                                margin: 0.25cm;
                                                padding: 0.25cm;
                                                margin-left: auto;
                                                margin-right: auto;
                                                display: block;
                                                border: none;
                                                border-radius: 0.25cm;
                                            }
                                            .submitregisseur:hover {
                                                transition: 0.1s;
                                                filter: invert(25%);
                                                color: black;
                                            }
                                        </style>
                                        <br><br><br>
                                        <form action="" method="post" class="regisseurtoevoegen">
                                            <label for="director">Regisseur toevoegen:</label>
                                            <br>
                                            <input type="text" name="directorname" placeholder="" class="nameregisseur" required>
                                            <br>
                                            <input type="submit" value="Toevoegen" class="submitregisseur">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td style="width: max-content;">
                            <div class="agelist">
                                <div>
                                    <h1>Leeftijden</h1>
                                    <table>
                                        <style>
                                            .agelist {
                                                justify-content: center;
                                                width: fit-content;
                                                height: 100%;
                                                background-color: rgb(35, 35, 35);
                                                padding: 0.5cm;
                                                border-radius: 1cm;
                                            }
                                            .agelist div {
                                                width: fit-content;
                                            }
                                            .agelist h1 {
                                                text-align: center;
                                                color: white;
                                                width: fit-content;
                                                margin-left: auto;
                                                margin-right: auto;
                                            }
                                            .agelist h2 {
                                                text-align: left;
                                                color: white;
                                            }
                                            .agelist table {
                                                color: white;
                                                width: fit-content;
                                            }
                                            .agelist th {
                                                border-right: 2px solid gray;
                                                border-bottom: 2px solid gray;
                                                padding: 0.25cm 0.5cm 0.25cm 0.5cm;
                                                width: fit-content;
                                                font-size: small;
                                            }
                                            .agelist th:last-child {
                                                border-right: none;
                                            }
                                            .agelist td {
                                                border-right: 2px solid gray;
                                                padding: 0.25cm 0.5cm 0.25cm 0.5cm;
                                                width: fit-content;
                                                font-size: small;
                                            }
                                            .agelist td:last-child {
                                                border-right: none;
                                            }
                                            .agelist p {
                                                width: fit-content;
                                            }
                                        </style>
                                        <?php
                                        $query = $link->query("SELECT * FROM leeftijden");
                                        $leeftijden = $query->fetchAll();
                                        ?>
                                        <tr>
                                            <th style="width: fit-content;">Leeftijd ID</th>
                                            <th style="width: fit-content;">Leeftijd namen</th>
                                        </tr>
                                        <?php 
                                        foreach($leeftijden as $leeftijd):
                                        ?>
                                        <tr>
                                            <td style="text-align: right;"><?php echo $leeftijd['LeeftijdID']; ?></td>
                                            <td style="text-align: right;"><?php echo $leeftijd['Naam']; ?></td>
                                        </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="genrelist">
                                <div>
                                    <h1>Genres</h1>
                                    <table>
                                        <style>
                                            .genrelist {
                                                justify-content: center;
                                                width: 85%;
                                                height: 100%;
                                                background-color: rgb(35, 35, 35);
                                                padding: 0.5cm;
                                                border-radius: 1cm;
                                            }
                                            .genrelist h1 {
                                                text-align: center;
                                                color: white;
                                            }
                                            .genrelist h2 {
                                                text-align: left;
                                                color: white;
                                            }
                                            .genrelist table {
                                                color: white;
                                            }
                                            .genrelist th {
                                                border-right: 2px solid gray;
                                                border-bottom: 2px solid gray;
                                                padding: 0.25cm 0.5cm 0.25cm 0.5cm;
                                                font-size: small;
                                            }
                                            .genrelist th:last-child {
                                                border-right: none;
                                            }
                                            .genrelist td {
                                                border-right: 2px solid gray;
                                                padding: 0.25cm 0.5cm 0.25cm 0.5cm;
                                                font-size: small;
                                            }
                                            .genrelist td:last-child {
                                                border-right: none;
                                            }
                                        </style>
                                        <?php
                                        $query = $link->query("SELECT * FROM Genres");
                                        $genres = $query->fetchAll();
                                        ?>
                                        <tr>
                                            <th style="width: 2cm;">Genre ID</th>
                                            <th style="width: 7.5cm;">Genre namen</th>
                                        </tr>
                                        <?php 
                                        foreach($genres as $genre):
                                        ?>
                                        <tr>
                                            <td style="text-align: right;"><?php echo $genre['GenreID']; ?></td>
                                            <td style="text-align: right;"><?php echo $genre['Naam']; ?></td>
                                        </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="productlist">
                <h1>Producten</h1>
                <table>
                    <style>
                        .productlist {
                            margin: auto;
                            justify-content: center;
                            width: fit-content;
                            height: 100%;
                            background-color: rgb(35, 35, 35);
                            padding: 0.5cm;
                            margin: auto;
                            margin-bottom: 1cm;
                            border-radius: 1cm;
                        }
                        .productlist h1 {
                            text-align: center;
                            color: white;
                        }
                        .productlist table {
                            color: white;
                            margin: auto;
                        }
                        .productlist th {
                            border-right: 2px solid gray;
                            border-bottom: 2px solid gray;
                            padding: 0.25cm 0.15cm 0.25cm 0.15cm;
                            font-size: small;
                        }
                        .productlist th:last-child {
                            border-right: none;
                        }
                        .productlist td {
                            border-right: 2px solid gray;
                            padding: 0.25cm 0.15cm 0.25cm 0.15cm;
                            font-size: small;
                        }
                        .productlist td:last-child {
                            border-right: none;
                        }
                        .edit img {
                            width: 75%;
                            height: 75%;
                            filter: invert(100%);
                        }
                        .edit img:hover {
                            transition: 0.1s;
                            filter: invert(55%);
                        }
                        .delete a {
                            margin: auto;
                            padding-right: 0.40cm;
                        }
                        .delete img {
                            width: 40%;
                            height: 40%;
                        }
                        .delete img:hover {
                            transition: 0.1s;
                            filter: invert(45%);
                        }
                    </style>
                    <?php
                    $query = $link->query("SELECT * FROM product");
                    $producten = $query->fetchAll();
                    ?>
                    <tr>
                        <th style="width: 2cm;">ProductID</th>
                        <th style="width: 5cm;">Naam</th>
                        <th style="width: 2cm;">Genre + ID</th>
                        <th style="width: 2cm;">Leeftijdsrestrictie + ID</th>
                        <th style="width: 2cm;">Regisseur + ID</th>
                        <th style="width: 7.5cm;">Beschrijving</th>
                        <th style="width: 2cm;">Aantal</th>
                        <th style="width: 2cm;">Prijs</th>
                        <th style="width: 2cm;">Aanpassen</th>
                        <th style="width: 2cm;">Verwijderen</th>
                    </tr>
                    <?php 
                    foreach($producten as $product):
                        $stmt = $link->prepare("SELECT * FROM Genres WHERE GenreID = :genreid");
                        $stmt->bindParam(':genreid', $product['GenreID']);
                        $stmt->execute();
                        $genre = $stmt->fetch();

                        $stmt = $link->prepare("SELECT * FROM leeftijden WHERE LeeftijdID = :leeftijdid");
                        $stmt->bindParam(':leeftijdid', $product['Leeftijd']);
                        $stmt->execute();
                        $leeftijdsrestrictie = $stmt->fetch();

                        $stmt = $link->prepare("SELECT * FROM regisseuren WHERE RegisseurID = :regisseurid");
                        $stmt->bindParam(':regisseurid', $product['RegisseurID']);
                        $stmt->execute();
                        $regisseur = $stmt->fetch();

                        ?>
                        <tr>
                            <td style="text-align: right;"><?php echo $product['ProductID']; ?></td>
                            <td style="text-align: right;"><?php echo $product['Naam']; ?></td>
                            <td style="text-align: right;"><?php echo $genre['Naam'] . " | " . $product['GenreID']; ?></td>
                            <td style="text-align: right;"><?php echo $leeftijdsrestrictie['Naam'] . " | " . $product['Leeftijd']; ?></td>
                            <td style="text-align: right;"><?php echo $regisseur['Naam'] . " | " . $product['RegisseurID']; ?></td>
                            <td style="text-align: left;"><?php echo $product['Beschrijving']; ?></td>  
                            <td style="text-align: right;"><?php echo $product['Aantal']; ?></td>
                            <td style="text-align: right;"><?php echo $product['Prijs']; ?></td>
                            <?php
                            $productid = $product['ProductID'];
                            echo "<td style='text-align: right;' class='edit'><a href='productwijzigen.php?nr=$productid'><img src='images/editTRANS.png' alt='Aanpassen'/></a></td>";
                            echo "<td style='text-align: right;' class='delete'><a href='deleteProduct.php?nr=$productid'><img src='images/garbageTRANS.png' alt='Verwijderen'/></a></td>";
                            ?>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </table>
                <div class="add">
                    <style>
                        .add {
                            width: 1.5cm;
                            height: 1.5cm;
                            float: right;
                        }
                        .add td {
                            width: fit-content;
                            height: fit-content;
                        }
                        .add a {
                            text-decoration: none;
                        }
                        .add img {
                            width: 100%;
                            height: 100%;
                        }
                        .add img:hover {
                            transition: 0.1s;
                            filter: invert(45%);
                        }
                    </style>
                    <td>
                        <a href='producttoevoegen.php'><img src="images/Addtocart.png" alt="toevoegen"/></a>
                    </td>
                </div>
            </div>
        </div>
    </div>
</body>
</html>