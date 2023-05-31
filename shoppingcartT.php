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
    <title>Webtoepassing Shoppingcart</title>
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
                    <a href="index.php">
                        <img src="images/homeTRANSblue.png" alt="User Profile">
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
                        }
                        .middlenav td:first-child, .middlenav td:last-child {
                            width: 33.333%;
                            height: 100%;
                            border: none;
                            text-align: center;
                        }
                        .middlenav td:first-child {
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
                                    <a href="galleryT.php">
                                        <h3>PRODUCTS</h3>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="button selected">
                                    <a href="shoppingcartT.php">
                                        <h3>CART</h3>
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
                margin: auto;
                margin-top: 1cm;
                position: absolute;
            }
        </style>
        <div class="content">
            <h1>HIER KOMT CODE</h1>
        </div>
    </div>
</body>
</html>