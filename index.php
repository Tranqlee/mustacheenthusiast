<?php
require_once('comm.php');
session_start();
$link = getDatabase();


if (!isset($_SESSION['user'])) { #if statement to check if the user is logged in
    header('Location: login.php');
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
    <title>Webtoepassing</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
    <link rel="stylesheet" type="text/css" href="css/NewStyle.css">
    <script type="text/javascript" src="js/mobile.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="overflow:hidden;">
    <style>
        body {
            width: 100%;
        }
    </style>
    <table class="navbar">
        <style>
            .navbar {
                background-color: rgb(35, 35, 35);
                box-shadow: 0px 0px 10px 1px black;
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
                            justify-content: center;
                        }
                        .leftnav p, .leftnav p:hover {
                            padding: 0.05cm 0.5cm 0.05cm 0.5cm;
                            margin-left: 0.25cm;
                            width: fit-content;
                            border: none;
                            border-radius: 0.25cm;
                            background-color: lightblue;
                        }
                        .leftnav button {
                            background-color: transparent;
                            border: none;
                        }
                    </style>
                    <p>
                        <button><h3>Ingelogd als: <?php echo $_SESSION['user']; ?></h3></button>
                    </p>
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
                            width: auto;
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
                                width: 100%;
                            }
                            .button a {
                                padding: 0.5cm;
                                width: 75%;
                                border: none;
                                border-radius: 0.25cm;
                                background-color: lightgray;
                                transition: 0.05s;
                            }
                            .button a:hover {
                                background-color: gray;
                                width: 75%;
                                transition: 0.05s;
                            }
                            .button button {
                                background-color: transparent;
                                border: none;
                                margin: -0.5cm;
                                width: 100%;
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
                                    <a href="about.html">
                                        <button><h3>About</h3></button>
                                    </a>
                                </div>
                            </td>
                            <?php
                            if($result['isAdmin'] == 1) {
                                ?>
                                <td>
                                    <div class="button">
                                        <a href="admin.php">
                                            <button><h3>Admin</h3></button>
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
                            color: lightgray;
                        }
                    </style>
                    <a href="loginSHOP.php">
                        <button><h3>UITLOGGEN</h3></button>
                    </a>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
<?php
