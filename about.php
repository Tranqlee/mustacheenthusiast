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
?>

<!-- Website Template by freewebsitetemplates.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webtoepassing About</title>
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
                            border-radius: 0.25cm;
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
                                border-radius: 0.25cm;
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
                                <div class="button selected">
                                    <a href="about.php">
                                        <button><h3>ABOUT</h3></button>
                                    </a>
                                </div>
                            </td>
                            <?php
                            if($result['isAdmin'] == 1) {
                                ?>
                                <td>
                                    <div class="button">
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
                            border-radius: 0.25cm;
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
    <div class="center">
        <style>
            div.center {
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;
                margin: auto;
                margin-top: 2cm;
                position: absolute;
            }
        </style>
        <div class="about">
            <style>
                .about {
                    background-color: rgb(35, 35, 35);
                    color: white;
                    border: none;
                    border-radius: 1cm 1cm 0cm 0cm;
                    box-shadow: 0px 0px 10px 2px black;
                    padding: 0.50cm;
                    width: 85%;
                }
                .about td {
                    width: 50%;
                    padding: 0.25cm;
                }
                .about td:first-child {
                    border-right: 1px solid white;
                }
                .about h3 {
                    text-align: center;
                    color: white;
                }
                .about p {
                    text-align: left;
                    color: white;
                }
                .about li {
                    padding: 0.05cm;
                    color: white;
                }
            </style>
            <table>
                <tr>
                    <th>
                        <h3>Over deze webshop</h3>
                    </th>
                    <th>
                        <h3>About this webshop</h3>
                    </th>
                </tr>
                <tr>
                    <td>
                        <p>Deze webshop is een project voor mijn GIP dat ik heb opgezet rondom de verkoop van fysieke exemplaren van films.</p>
                        <br><br>
                        <p>Op deze webshop kan je:</p>
                        <ul>
                            <li>
                                Inloggen
                            </li>
                            <li>
                                Registreren
                            </li>
                            <li>
                                Je wachtwoord veranderen
                            </li>
                            <li>
                                Jouw gebruikersinformatie zien
                            </li>
                            <li>
                                Producten zien
                            </li>
                            <li>
                                Producten toevoegen aan je winkelmandje
                            </li>
                            <li>
                                Producten verwijderen uit je winkelmandje
                            </li>
                            <li>
                                ...
                            </li>
                        </ul>
                        <p>Als een admin kan je ook nog:</p>
                        <ul>
                            <li>
                                Producten toevoegen
                            </li>
                            <li>
                                Producten aanpassen
                            </li>
                            <li>
                                Producten verwijderen
                            </li>
                            <li>
                                Gebruikers verwijderen
                            </li>
                            <li>
                                Regisseurs toevoegen
                            </li>
                            <li>
                                Regisseurs verwijderen
                            </li>
                            <li>
                                Leeftijd categorieën toevoegen
                            </li>
                            <li>
                                Leeftijd categorieën verwijderen
                            </li>
                            <li>
                                ...
                            </li>
                        </ul>
                    </td>
                    <td>
                        <p>This webshop is a project for my GIP which i made around selling physical copies of movies.</p>
                        <br><br>
                        <p>On this webshop you can:</p>
                        <ul>
                            <li>
                                Log in
                            </li>
                            <li>
                                Register
                            </li>
                            <li>
                                Reset your password
                            </li>
                            <li>
                                View your user information
                            </li>
                            <li>
                                View products
                            </li>
                            <li>
                                Add products to your cart
                            </li>
                            <li>
                                Remove products from your cart
                            </li>
                            <li>
                                ...
                            </li>
                        </ul>
                        <p>As an admin you can also:</p>
                        <ul>
                            <li>
                                Add products
                            </li>
                            <li>
                                Edit products
                            </li>
                            <li>
                                Remove products
                            </li>
                            <li>
                                Remove users
                            </li>
                            <li>
                                Add directors
                            </li>
                            <li>
                                Remove directors
                            </li>
                            <li>
                                Add age categories
                            </li>
                            <li>
                                Remove age categories
                            </li>
                            <li>
                                ...
                            </li>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>