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
    <p>
        <br><br><br>
    </p>
    <div class="center">
        <style>
            div.center {
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;
                margin: auto;
                margin-top: 1cm;
                position: absolute;
            }
        </style>
        <div class="userlist">
            <h1>Users</h1>
            <table>
                <style>
                    .userlist {
                        margin: auto;
                        justify-content: center;
                    }
                    .userlist h1 {
                        text-align: center;
                        color: white;
                    }
                    .userlist table {
                        width: 95%;
                        height: 100%;
                        background-color: rgb(35, 35, 35);
                        color: white;
                        padding: 0.5cm;
                        margin: auto;
                        border-radius: 1cm;
                    }
                    .userlist th {
                        border-right: 2px solid gray;
                        border-bottom: 2px solid gray;
                        padding: 0.25cm 0.5cm 0.25cm 0.5cm;
                    }
                    .userlist th:last-child {
                        border-right: none;
                    }
                    .userlist td {
                        border-right: 2px solid gray;
                        padding: 0.25cm 0.5cm 0.25cm 0.5cm;
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
                    <th style="width: 5cm;">ID</th>
                    <th style="width: 5cm;">Username</th>
                    <th style="width: 5cm;">E-mail</th>
                    <th style="width: 5cm;">Phone number</th>
                    <th style="width: 5cm;">Street number</th>
                    <th style="width: 2cm;">House number</th>
                    <th style="width: 2cm;">Postal code</th>
                    <th style="width: fit-content;">Town/City</th>
                    <th style="width: 7.5cm;">Date of birth</th>
                    <th style="width: 5cm;">Delete</th>
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
                            <h1>Directors</h1>
                            <table>
                                <style>
                                    .directorlist {
                                        margin: auto;
                                        justify-content: center;
                                    }
                                    .directorlist h1 {
                                        text-align: center;
                                        color: white;
                                    }
                                    .directorlist table {
                                        width: 95%;
                                        height: 100%;
                                        background-color: rgb(35, 35, 35);
                                        color: white;
                                        padding: 0.5cm;
                                        margin: auto;
                                        border-radius: 1cm;
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
                                    <th style="width: 2cm;">Director ID</th>
                                    <th style="width: 7.5cm;">Director name</th>
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
                    </td>
                    <td>
                        <div class="agelist">
                            <h1>Ages</h1>
                            <table>
                                <style>
                                    .agelist {
                                        margin: auto;
                                        justify-content: center;
                                    }
                                    .agelist h1 {
                                        text-align: center;
                                        color: white;
                                    }
                                    .agelist table {
                                        width: 95%;
                                        height: 100%;
                                        background-color: rgb(35, 35, 35);
                                        color: white;
                                        padding: 0.5cm;
                                        margin: auto;
                                        border-radius: 1cm;
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
                                    $leeftijdid = $leeftijd['LeeftijdID'];
                                    echo "<td style='text-align: right';><a href='deleteAge.php?nr=$leeftijdid'>Delete</a></td>";
                                    ?>
                                </tr>
                                <?php
                                endforeach;
                                ?>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="productlist">
            <h1>Products</h1>
            <table>
                <style>
                    .productlist {
                        margin: auto;
                        justify-content: center;
                    }
                    .productlist h1 {
                        text-align: center;
                        color: white;
                    }
                    .productlist table {
                        width: 95%;
                        height: 100%;
                        background-color: rgb(35, 35, 35);
                        color: white;
                        padding: 0.5cm;
                        margin: auto;
                        border-radius: 1cm 1cm 0cm 0cm;
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
                    <th style="width: 2cm;">Price</th>
                    <th style="width: 2cm;">Age Restriction ID</th>
                    <th style="width: 12cm;">Description</th>
                    <th style="width: 2cm;">Directors ID</th>
                    <th style="width: 2cm;">Amount</th>
                    <th style="width: 2cm;">Delete</th>
                </tr>
                <?php 
                foreach($producten as $product):
                    ?>
                    <tr>
                        <td style="text-align: right;"><?php echo $product['ProductID']; ?></td>
                        <td style="text-align: right;"><?php echo $product['Naam']; ?></td>
                        <td style="text-align: right;"><?php echo $product['Prijs']; ?></td>
                        <td style="text-align: right;"><?php echo $product['Leeftijd']; ?></td>
                        <td style="text-align: right;"><?php echo $product['Beschrijving']; ?></td>  
                        <td style="text-align: right;"><?php echo $product['RegisseurID']; ?></td>
                        <td style="text-align: right;"><?php echo $product['Aantal']; ?></td>
                        <?php
                        $productid = $product['ProductID'];
                        echo "<td style='text-align: right';><a href='deleteProduct.php?nr=$productid'>Delete</a></td>";
                        ?>
                    </tr>
                    <?php
                endforeach;
                ?>
            </table>
        </div>
    </div>
</body>
</html>