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
}
if(isset($_POST['agename']))
{
    $stmt = $link->prepare("INSERT INTO leeftijden (Naam) VALUES (:agename)");
    $stmt->bindParam(':agename', $_POST['agename']);
    $stmt->execute();
}
if(isset($_POST['genrename']))
{
    $stmt = $link->prepare("INSERT INTO genres (Naam) VALUES (:genrename)");
    $stmt->bindParam(':genrename', $_POST['genrename']);
    $stmt->execute();
}





if(isset($_POST['productname']))
{
    $stmt = $link->prepare("INSERT INTO product (Naam, Prijs, Beschrijving, RegisseurID, Leeftijd, Aantal) VALUES (:productname, :productprice, :productdescription, :productdirector, :productage, :productamount)");
    $stmt->bindParam(':productname', $_POST['productname']);
    $stmt->bindParam(':productprice', $_POST['productprice']);
    $stmt->bindParam(':productdescription', $_POST['productdescription']);
    $stmt->bindParam(':productdirector', $_POST['productdirector']);
    $stmt->bindParam(':productage', $_POST['productage']);
    $stmt->bindParam(':productamount', $_POST['productamount']);
    $stmt->execute();
}
if(isset($_POST['productnamewijzigen']))
{
    $stmt = $link->prepare("UPDATE product SET Naam = :productnamewijzigen, Prijs = :productpricewijzigen, Leeftijd = :productagewijzigen, Beschrijving = :productdescriptionwijzigen, RegisseurID = :productdirectorsidwijzigen, Aantal = :productamountwijzigen WHERE ProductID = :productidwijzigen");
    $stmt->bindParam(':productnamewijzigen', $_POST['productnamewijzigen']);
    $stmt->bindParam(':productpricewijzigen', $_POST['productpricewijzigen']);
    $stmt->bindParam(':productagewijzigen', $_POST['productagewijzigen']);
    $stmt->bindParam(':productdescriptionwijzigen', $_POST['productdescriptionwijzigen']);
    $stmt->bindParam(':productdirectorsidwijzigen', $_POST['productdirectorwijzigen']);
    $stmt->bindParam(':productamountwijzigen', $_POST['productamountwijzigen']);
    $stmt->bindParam(':productidwijzigen', $_POST['productidwijzigen']);
    $stmt->execute();
}
?>





<!-- Website Template by freewebsitetemplates.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webtoepassing Admin panel</title>
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
                position: fixed;
                z-index: 2;
            }
            .navbar , .navbar tr {
                width: 100%;
                height: 2cm;
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
                            padding: 0.5cm;
                            margin-left: 0.25cm;
                            width: fit-content;
                            border: none;
                            border-radius: 0.5cm;
                            background-color: lightblue;
                            transition: 0.05s;
                        }
                        .leftnav a:hover {
                            background-color: cornflowerblue;
                            transition: 0.05s;
                        }
                        .leftnav button {
                            background-color: transparent;
                            border: none;
                        }
                        .leftnav h3 {
                            color: black;
                        }
                    </style>
                    <a href="user.php">
                        <button><h3>Logged in as: <?php echo $_SESSION['user']; ?></h3></button>
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
                        .middlenav td:first-child, .middlenav td, .middlenav td:last-child {
                            width: 33.333%;
                            height: 100%;
                            border: none;
                            text-align: center;
                        }
                    </style>
                    <table>
                        <style>
                            .button {
                                justify-content: center;
                                align: center;
                                float: center;
                                width: 95%;
                                background-color: transparent;
                            }
                            .button a {
                                padding: 0.5cm;
                                width: 75%;
                                border: none;
                                border-radius: 0.5cm;
                                background-color: lightgray;
                                transition: 0.05s;
                                box-shadow: 0px 0px 10px 2px black;
                            }
                            .button a:hover {
                                background-color: white;
                                width: 75%;
                                transition: 0.05s;
                                box-shadow: 0px 0px 10px 2px black;
                            }
                            .button button {
                                background-color: transparent;
                                border: none;
                                margin: -0.5cm;
                                width: 100%;
                                height: 100%;
                            }
                            .selected h3 {
                                text-decoration: underline 1.5px solid black;
                            }
                            .selected a {
                                background-color: white;
                            }
                        </style>
                        <tr>
                            <td>
                                <div class="button">
                                    <a href="index.php">
                                        <button><h3>HOME</h3></button>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="button">
                                    <a href="about.php">
                                        <button><h3>ABOUT</h3></button>
                                    </a>
                                </div>
                            </td>
                            <?php
                            if($result['isAdmin'] == 1) {
                                ?>
                                <td>
                                    <div class="button selected">
                                        <a href="admin.php">
                                            <button><h3>ADMIN PANEL</h3></button>
                                        </a>
                                    </div>
                                </td>
                                <?php
                            }
                            ?>
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
                        }
                        .rightnav a {
                            padding: 0.5cm;
                            margin-right: 0.25cm;
                            width: fit-content;
                            border: none;
                            border-radius: 0.5cm;
                            background-color: firebrick;
                            transition: 0.05s;
                        }
                        .rightnav a:hover {
                            background-color: red;
                            transition: 0.05s;
                        }
                        .rightnav button {
                            background-color: transparent;
                            border: none;
                        }
                        .rightnav h3 {
                            color: black;
                        }
                    </style>
                    <a href="loginSHOP.php">
                        <button><h3>Log out</h3></button>
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
                <h1>Users</h1>
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
                        }
                        .userlist th:last-child {
                            border-right: none;
                        }
                        .userlist td {
                            border-right: 2px solid gray;
                            padding: 0.15cm 0.15cm 0.25cm 0.15cm;
                            width: auto;
                        }
                        .userlist td:last-child {
                            border-right: none;
                        }
                    </style>
                    <?php
                    $query = $link->query("SELECT * FROM klant");
                    $klanten = $query->fetchAll();
                    ?>
                    <tr>
                        <th style="width: auto;">Customer ID</th>
                        <th style="width: auto;">Username</th>
                        <th style="width: auto;">E-mail</th>
                        <th style="width: auto;">Phone number</th>
                        <th style="width: auto;">Street number</th>
                        <th style="width: auto;">House number</th>
                        <th style="width: auto;">Postal code</th>
                        <th style="width: auto;">Town/City</th>
                        <th style="width: auto;">Date of birth</th>
                        <th style="width: auto;">Delete</th>
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
                        echo "<td style='text-align: right';><a href='deleteUser.php?nr=$userid'>Delete</a></td>";
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
                    }
                    .extralist table {
                        width: 100%;
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
                                    <h1>Directors</h1>
                                    <table>
                                        <style>
                                            .directorlist {
                                                margin: auto;
                                                justify-content: center;
                                                width: 85%;
                                                height: 100%;
                                                background-color: rgb(35, 35, 35);
                                                padding: 0.5cm;
                                                margin: auto;
                                                border-radius: 1cm;
                                            }
                                            .directorlist h1 {
                                                text-align: center;
                                                color: white;
                                            }
                                            .directorlist h2 {
                                                text-align: left;
                                                color: white;
                                            }
                                            .directorlist table {
                                                color: white;
                                            }
                                            .directorlist th {
                                                border-right: 2px solid gray;
                                                border-bottom: 2px solid gray;
                                                padding: 0.25cm 0.5cm 0.25cm 0.5cm;
                                            }
                                            .directorlist th:last-child {
                                                border-right: none;
                                            }
                                            .directorlist td {
                                                border-right: 2px solid gray;
                                                padding: 0.25cm 0.5cm 0.25cm 0.5cm;
                                            }
                                            .directorlist td:last-child {
                                                border-right: none;
                                            }
                                        </style>
                                        <?php
                                        $query = $link->query("SELECT * FROM regisseuren");
                                        $regisseurs = $query->fetchAll();
                                        ?>
                                        <tr>
                                            <th style="width: 2cm;">Director(s) ID</th>
                                            <th style="width: 7.5cm;">Director(s) name(s)</th>
                                            <th style="width: 2cm;">Delete</th>
                                        </tr>
                                        <?php 
                                        foreach($regisseurs as $regisseur):
                                        ?>
                                        <tr>
                                            <td style="text-align: right;"><?php echo $regisseur['RegisseurID']; ?></td>
                                            <td style="text-align: right;"><?php echo $regisseur['Naam']; ?></td>
                                            <?php
                                            $directorid = $regisseur['RegisseurID'];
                                            echo "<td style='text-align: right';><a href='deleteDirector.php?nr=$directorid'>Delete</a></td>";
                                            ?>
                                        </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                    </table>
                                </div>
                                <p>
                                    <br><br>
                                </p>
                                <div class="directorform">
                                    <h2>Add director(s)</h2>
                                    <style>
                                        .directorform {
                                            width: 100%;
                                            background-color: rgb(75, 75, 75);
                                            padding: 0.25cm;
                                            padding-left: 0.5cm;
                                            border-radius: 0.5cm;
                                            margin: 0.25cm;
                                        }
                                        .directorform, .directorform form {
                                            width: auto;
                                        }
                                        .directorform input {
                                            padding: 0.15cm;
                                            border-radius: 0.15cm;
                                            border: none;
                                        }

                                        .directorform label {
                                            color: white;
                                            font-weight: bold;
                                        }
                                    </style>
                                    <form action="" method="POST">
                                        <label for="directorname">Director(s) name(s)</label>
                                        <br>
                                        <input type="text" name="directorname" id="directorname" size="auto" required/>
                                        <br><br>
                                        <input type="submit" name="submitdirector" value="Add director('s)" style="width: auto;"/>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="agelist">
                                <div>
                                    <h1>Ages</h1>
                                    <table>
                                        <style>
                                            .agelist {
                                                margin: auto;
                                                justify-content: center;
                                                width: 85%;
                                                height: 100%;
                                                background-color: rgb(35, 35, 35);
                                                padding: 0.5cm;
                                                margin: auto;
                                                border-radius: 1cm;
                                            }
                                            .agelist h1 {
                                                text-align: center;
                                                color: white;
                                            }
                                            .agelist h2 {
                                                text-align: left;
                                                color: white;
                                            }
                                            .agelist table {
                                                color: white;
                                            }
                                            .agelist th {
                                                border-right: 2px solid gray;
                                                border-bottom: 2px solid gray;
                                                padding: 0.25cm 0.5cm 0.25cm 0.5cm;
                                            }
                                            .agelist th:last-child {
                                                border-right: none;
                                            }
                                            .agelist td {
                                                border-right: 2px solid gray;
                                                padding: 0.25cm 0.5cm 0.25cm 0.5cm;
                                            }
                                            .agelist td:last-child {
                                                border-right: none;
                                            }
                                        </style>
                                        <?php
                                        $query = $link->query("SELECT * FROM leeftijden");
                                        $leeftijden = $query->fetchAll();
                                        ?>
                                        <tr>
                                            <th style="width: 2cm;">Age ID</th>
                                            <th style="width: 7.5cm;">Age name</th>
                                            <th style="width: 2cm;">Delete</th>
                                        </tr>
                                        <?php 
                                        foreach($leeftijden as $leeftijd):
                                        ?>
                                        <tr>
                                            <td style="text-align: right;"><?php echo $leeftijd['LeeftijdID']; ?></td>
                                            <td style="text-align: right;"><?php echo $leeftijd['Naam']; ?></td>
                                            <?php
                                            $ageid = $leeftijd['LeeftijdID'];
                                            echo "<td style='text-align: right';><a href='deleteAge.php?nr=$ageid'>Delete</a></td>";
                                            ?>
                                        </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                    </table>
                                </div>
                                <p>
                                    <br><br>
                                </p>
                                <div class="ageform">
                                    <h2>Add age</h2>
                                    <style>
                                        .ageform {
                                            width: 100%;
                                            background-color: rgb(75, 75, 75);
                                            padding: 0.25cm;
                                            padding-left: 0.5cm;
                                            border-radius: 0.5cm;
                                            margin: 0.25cm;
                                        }
                                        .ageform, .ageform form {
                                            width: auto;
                                        }
                                        .ageform input {
                                            padding: 0.15cm;
                                            border-radius: 0.15cm;
                                            border: none;
                                        }
                                        .ageform label {
                                            color: white;
                                            font-weight: bold;
                                        }
                                    </style>
                                    <form action="" method="POST">
                                        <label for="agename">Age</label>
                                        <br>
                                        <input type="text" name="agename" id="agename" size="auto" required/>
                                        <br><br>
                                        <input type="submit" name="submitage" value="Add age" style="width: auto;"/>
                                    </form>
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
                                                margin: auto;
                                                justify-content: center;
                                                width: 85%;
                                                height: 100%;
                                                background-color: rgb(35, 35, 35);
                                                padding: 0.5cm;
                                                margin: auto;
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
                                            }
                                            .agelgenrelistist th:last-child {
                                                border-right: none;
                                            }
                                            .genrelist td {
                                                border-right: 2px solid gray;
                                                padding: 0.25cm 0.5cm 0.25cm 0.5cm;
                                            }
                                            .genrelist td:last-child {
                                                border-right: none;
                                            }
                                        </style>
                                        <?php
                                        $query = $link->query("SELECT * FROM genres");
                                        $genres = $query->fetchAll();
                                        ?>
                                        <tr>
                                            <th style="width: 2cm;">Age ID</th>
                                            <th style="width: 7.5cm;">Age name</th>
                                            <th style="width: 2cm;">Delete</th>
                                        </tr>
                                        <?php 
                                        foreach($genres as $genre):
                                        ?>
                                        <tr>
                                            <td style="text-align: right;"><?php echo $genre['GenreID']; ?></td>
                                            <td style="text-align: right;"><?php echo $genre['Naam']; ?></td>
                                            <?php
                                            $genreid = $genre['GenreID'];
                                            echo "<td style='text-align: right';><a href='deleteGenre.php?nr=$genreid'>Delete</a></td>";
                                            ?>
                                        </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                    </table>
                                </div>
                                <p>
                                    <br><br>
                                </p>
                                <div class="genreform">
                                    <h2>Add age</h2>
                                    <style>
                                        .genreform {
                                            width: 100%;
                                            background-color: rgb(75, 75, 75);
                                            padding: 0.25cm;
                                            padding-left: 0.5cm;
                                            border-radius: 0.5cm;
                                            margin: 0.25cm;
                                        }
                                        .genreform, .genreform form {
                                            width: auto;
                                        }
                                        .genreform input {
                                            padding: 0.15cm;
                                            border-radius: 0.15cm;
                                            border: none;
                                        }
                                        .genreform label {
                                            color: white;
                                            font-weight: bold;
                                        }
                                    </style>
                                    <form action="" method="POST">
                                        <label for="genrename">Genre</label>
                                        <br>
                                        <input type="text" name="genrename" id="genrename" size="auto" required/>
                                        <br><br>
                                        <input type="submit" name="submitgenre" value="Add genre" style="width: auto;"/>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="productlist">
                <h1>Products</h1>
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
                            padding: 0.25cm 0.5cm 0.25cm 0.5cm;
                        }
                        .productlist th:last-child {
                            border-right: none;
                        }
                        .productlist td {
                            border-right: 2px solid gray;
                            padding: 0.25cm 0.5cm 0.25cm 0.5cm;
                        }
                        .productlist td:last-child {
                            border-right: none;
                        }
                    </style>
                    <?php
                    $query = $link->query("SELECT * FROM product");
                    $producten = $query->fetchAll();
                    ?>
                    <tr>
                        <th style="width: 2cm;">ProductID</th>
                        <th style="width: 5cm;">Name</th>
                        <th style="width: 2cm;">Genre</th>
                        <th style="width: 2cm;">Age Restriction ID</th>
                        <th style="width: 2cm;">Directors ID</th>
                        <th style="width: 7.5cm;">Description</th>
                        <th style="width: 2cm;">Amount</th>
                        <th style="width: 2cm;">Price</th>
                        <th style="width: 2cm;">Delete</th>
                    </tr>
                    <?php 
                    foreach($producten as $product):
                        ?>
                        <tr>
                            <td style="text-align: right;"><?php echo $product['ProductID']; ?></td>
                            <td style="text-align: right;"><?php echo $product['Naam']; ?></td>
                            <td style="text-align: right;"><?php echo $product['Genre']; ?></td>
                            <td style="text-align: right;"><?php echo $product['Leeftijd']; ?></td>
                            <td style="text-align: right;"><?php echo $product['RegisseurID']; ?></td>
                            <td style="text-align: right;"><?php echo $product['Beschrijving']; ?></td>  
                            <td style="text-align: right;"><?php echo $product['Aantal']; ?></td>
                            <td style="text-align: right;"><?php echo $product['Prijs']; ?></td>
                            <?php
                            $productid = $product['ProductID'];
                            echo "<td style='text-align: right';><a href='deleteProduct.php?nr=$productid'>Delete</a></td>";
                            ?>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </table>
                <p>
                    <br><br>
                </p>
                <div class="producttable">
                    <style>
                        .producttable {
                            width: 100%;
                            border: none;
                        }
                        .producttable td {
                            border: none;
                            vertical-align: top;
                        }
                    </style>
                    <table>
                        <tr>
                            <td>
                                <div class="productform">
                                    <style>
                                        .productform {
                                            width: 100%;
                                            background-color: rgb(75, 75, 75);
                                            padding: 0.25cm;
                                            border-radius: 0.5cm;
                                        }
                                        .productform form {
                                            width: auto;
                                        }
                                        .productform th {
                                            text-align: left;
                                            border: none;
                                        }
                                        .productform td {
                                            justify-content: right;
                                        }
                                        .productform label {
                                            color: white;
                                            font-weight: bold;
                                        }
                                        .productform input {
                                            padding: 0.15cm;
                                            border-radius: 0.15cm;
                                            margin: 0.15cm;
                                            border: none;
                                        }
                                    </style>
                                    <form action="" method="POST">
                                        <table>
                                            <tr>
                                                <th>
                                                    <h2>Add product</h2>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="productname">Product name</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="productname" id="productname" size="auto" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="productgenre">Product Genre</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="productgenre" id="productgenre" size="auto" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="productage">Product age restriction ID</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="productage" id="productage" size="auto" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="productdirector">Product director ID</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="productdirector" id="productdirector" size="auto" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="productdescription">Product description</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="productdescription" id="productdescription" size="auto" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="productamount">Product amount</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="productamount" id="productamount" size="auto" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="productprice">Product price</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="productprice" id="productprice" size="auto" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="submit" name="submit" value="Add product"/>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="productformwijzigen">
                                    <style>
                                        .productformwijzigen {
                                            width: 100%;
                                            background-color: rgb(75, 75, 75);
                                            padding: 0.25cm;
                                            border-radius: 0.5cm;
                                        }
                                        .productformwijzigen form {
                                            width: auto;
                                        }
                                        .productformwijzigen th {
                                            text-align: left;
                                            border: none;
                                        }
                                        .productformwijzigen td {
                                            justify-content: right;
                                        }
                                        .productformwijzigen label {
                                            color: white;
                                            font-weight: bold;
                                        }
                                        .productformwijzigen input {
                                            padding: 0.15cm;
                                            border-radius: 0.15cm;
                                            margin: 0.15cm;
                                            border: none;
                                        }
                                    </style>
                                    <form action="" method="POST">
                                        <table>
                                            <tr>
                                                <th>
                                                    <h2>Edit product</h2>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="productidwijzigen">Product ID</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="productidwijzigen" id="productidwijzigen" size="auto" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="productnamewijzigen">Product name</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="productnamewijzigen" id="productnamewijzigen" size="auto" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="productgenrewijzigen">Product Genre</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="productgenrewijzigen" id="productgenrewijzigen" size="auto" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="productagewijzigen">Product age restriction ID</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="productagewijzigen" id="productagewijzigen" size="auto" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="productdirectorwijzigen">Product director ID</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="productdirectorwijzigen" id="productdirectorwijzigen" size="auto" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="productdescriptionwijzigen">Product description</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="productdescriptionwijzigen" id="productdescriptionwijzigen" size="auto" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="productamountwijzigen">Product amount</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="productamountwijzigen" id="productamountwijzigen" size="auto" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="productpricewijzigen">Product price</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="productpricewijzigen" id="productpricewijzigen" size="auto" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="submit" name="submitwijzigen" value="Edit product"/>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>