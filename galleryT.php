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

$gevonden = false;
if( isset($_SESSION['WINKELKAR']) )
{
    $winkelkar = $_SESSION['WINKELKAR'];

    for( $i=0; $i<count($winkelkar) and !$gevonden; $i++ )
    {
        if( $winkelkar[$i]['ProductID']==$_POST['additemID'] )
        {
            $gevonden = true;
            $winkelkar[$i]['AANTAL']++;
        }
    }
}
if( !$gevonden )
{
    $films = array(
        'ProductID' => $_POST['additemID'],
        'AANTAL' => 1
        );

    $winkelkar[] = $films;
}

$_SESSION['WINKELKAR'] = $winkelkar;
unset($_POST['additemID']);




if (!isset($_SESSION['user'])) { #if statement to check if the user is logged in
    header('Location: loginSHOP.php');
}
?>

<!-- Website Template by freewebsitetemplates.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webtoepassing Products</title>
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
                            background-color: transparent;
                            transition: 0.05s;
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
                                        <h3>HOME</h3>
                                    </a>
                                </div>
                            </td>
                            <td style="background-color: rgb(40, 40, 40);">
                                <div class="button selected">
                                    <a href="galleryT.php">
                                        <h3>Products</h3>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="button">
                                    <a href="shoppingcartT.php">
                                        <h3>Cart</h3>
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
                            background-color: transparent;
                            transition: 0.05s;
                        }
                        .rightnav img {
                            width: 0.875cm;
                            height: auto;
                        }

                    </style>
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
                margin-top: 1cm;
                position: absolute;
            }
        </style>
        <div class="content">
            <style>
                .content {
                    margin: auto;
                    margin-top: 1cm;
                    justify-content: center;
                    width: 60%;
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
                        border-radius: 0.666cm 0.666cm 1.25cm 0.666cm;
                        margin: -0.5cm;
                        margin-bottom: 2cm;
                        padding: 0.5cm;
                        width: 100%;
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
                        width: 7.5cm;
                        height: auto;
                    }
                    .item p {
                        color: white;
                    }



                    .info1 {
                        width: 100%;
                        height: 100%;
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
                    }

                    .beschrijving {
                        width: 100%;
                    }
                    .beschrijving strong {
                        color: white;
                    }
                    .image {
                        width: fit-content;
                        border: 5px solid black;
                        border-radius: 0.15cm;
                        background-color: black;
                    }
                </style>
                <?php
                $query = $link->query("SELECT * FROM product");
                $producten = $query->fetchAll();

                foreach($producten as $product)
                {
                    $query = $link->prepare("SELECT * FROM Genres WHERE GenreID = :GenreID");
                    $query->bindParam(":GenreID", $product['GenreID']);
                    $query->execute();
                    $genre = $query->fetch();

                    $query = $link->prepare("SELECT * FROM leeftijden WHERE LeeftijdID = :LeeftijdID");
                    $query->bindParam(":LeeftijdID", $product['Leeftijd']);
                    $query->execute();
                    $leeftijd = $query->fetch();

                    $query = $link->prepare("SELECT * FROM regisseuren WHERE RegisseurID = :RegisseurID");
                    $query->bindParam(":RegisseurID", $product['RegisseurID']);
                    $query->execute();
                    $regisseur = $query->fetch();

                    $temporaryitemID = $product['ProductID'];
                    ?>
                    <div class="item">
                        <table>
                            <tr>
                                <td class="image">
                                    <img src="<?php echo 'productimages/' . $product['Afbeelding']; ?>" alt="Product image">
                                </td>
                                <td style="vertical-align: top;">
                                    <table class="info1">
                                        <tr>
                                            <th>
                                                <p>Name:</p>
                                            </th>
                                            <td>
                                                <p><?php echo $product['Naam'] . " ||| " . $temporaryitemID; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <p>Main genre:</p>
                                            </th>
                                            <td>
                                                <p><?php echo $genre['Naam']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <p>Age restriction:</p>
                                            </th>
                                            <td>
                                                <p><?php echo $leeftijd['Naam']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <p>Director(s):</p>
                                            </th>
                                            <td>
                                                <p><?php echo $regisseur['Naam']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="vertical-align: top;">
                                                <p>Description:</p>
                                            </th>
                                            <td>
                                                <p><?php echo $product['Beschrijving']; ?></p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="text-align: right; vertical-align: bottom; display: table-cell; padding-bottom: 0.05cm; padding-left: 0.25cm;">
                                    <div class="A">
                                        <style>
                                            form input {
                                                display: table-cell;
                                                vertical-align: bottom;
                                            }
                                            form input {
                                                width: 1.5cm;
                                                height: auto;
                                                vertical-align: bottom;
                                            }
                                        </style>
                                        <form action="" method="POST">
                                            <input type="hidden" name="additemID" value="<?php echo $temporaryitemID; ?>">
                                            <input type="image" src="images/Addtocart.png" alt="Submit">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>