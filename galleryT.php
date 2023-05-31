<?php
require_once('comm.php');
session_start();
$link = getDatabase();


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
                            background-color: lightgray;
                            transition: 0.05s;
                        }
                        .leftnav a:hover {
                            background-color: white;
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
                    <a href="index.php">
                        <button><h3>HOME</h3></button>
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
                                <div class="button selected">
                                    <a href="gallery.php">
                                        <button><h3>Products</h3></button>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="button">
                                    <a href="shoppingcart.php">
                                        <button><h3>Shoppingcart</h3></button>
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
                    width: fit-content;
                    height: fit-content;
                    background-color: rgb(35, 35, 35);
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
                        background-color: lightgray;
                        border-radius: 0.666cm;
                        margin: -0.5cm;
                        margin-bottom: 2cm;
                        padding: 0.5cm;
                        width: 100%;
                   }
                    .item img {
                        width: 10cm;
                        height: auto;
                    }
                    .item p {
                        color: black;
                    }
                    .item {
                        width: 100%;
                        height: 100%;
                    }

                    .info1 {
                        width: 100%;
                    }
                    .info1 td, .info1 th {
                        width: max-content;
                        height: min-content;
                        text-align: left;
                    }
                    .info1 td p {
                        color: blue;
                        font-weight: bold;
                    }

                    .info2 {
                        width: 100%;
                    }
                    .info2 td {
                        width: 50%;
                        text-align: left;
                    }
                    .info2 th {
                        width: 50%;
                        height: min-content;
                        text-align: left;
                    }

                    .beschrijving {
                        width: 100%;
                    }
                </style>
                <?php
                $query = $link->query("SELECT * FROM product");
                $producten = $query->fetchAll();

                foreach($producten as $product)
                {
                    ?>
                    <div class="item">
                        <table style="border: 1px solid black;">
                            <tr>
                                <td>
                                    <table class="info1" style="border: 1px solid red;">
                                        <tr>
                                            <th>
                                                <p>Name:</p>
                                            </th>
                                            <td>
                                                <p><?php echo $product['Naam']; ?></p>
                                            </td>
                                            <th>
                                                <p>Genre:</p>
                                            </th>
                                            <td>
                                                <p><?php echo $product['Genre']; ?></p>
                                            </td>
                                            <th>
                                                <p>Age restriction:</p>
                                            </th>
                                            <td>
                                                <p><?php echo $product['Leeftijd']; ?></p>
                                            </td>
                                            <th>
                                                <p>Director(s):</p>
                                            </th>
                                            <td>
                                                <p><?php echo $product['RegisseurID']; ?></p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="info2" style="border: 1px solid blue;">
                                        <tr>
                                            <td>
                                                <img src="<?php echo 'productimages/' . $product['Naam']; ?>"alt="Product image">
                                            </td>
                                            <td class="beschrijving">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <p><strong>Description:</strong></p>
                                                            <br>
                                                            <p><?php echo $product['Beschrijving']; ?></p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
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