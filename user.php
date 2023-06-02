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

$winkelkar = $_SESSION['WINKELKAR'];
?>

<!-- Website Template by freewebsitetemplates.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webtoepassing Gebruikersinformatie</title>
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
                                        <h3>Gebruiker: <?php echo $_SESSION['user']; ?></h3>
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
                    <?php echo $result['Gebruikersnaam']; ?>
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
                    <?php echo $result['Email']; ?>
                </th>
                <td>
                    Telefoonnummer:
                </td>
                <th>
                    <?php echo $result['Telefoonnummer']; ?>
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
                    <?php echo $result['Straatnaam']; ?> 
                </th>
                <td>
                    Huisnummer:
                </td>
                <th>
                    <?php echo $result['Huisnummer']; ?>
                </th>
            </tr>
            <tr>
                <td>
                    Postcode:
                </td>
                <th>
                    <?php echo $result['Postcode']; ?>
                </th>
                <td>
                    Gemeente:
                </td>
                <th>
                    <?php echo $result['Gemeente']; ?>
                </th>
            </tr>
            <tr>
                <td>
                    Geboortedatum:
                </td>
                <th>
                    <?php echo $result['GeboorteDatum']; ?> 
                </th>
                <td>
                </td>
                <td>
                </td>
            </tr>
        </table>
        <br>
        <h2>Bestellingen</h2>
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
                    <div>
                        <?php
                        ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>