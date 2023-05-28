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

if(isset($_POST['Username']))
{        
    //checks if username exists
    $stmt = $link->prepare("SELECT * FROM klant WHERE Gebruikersnaam = :username");
    $stmt->bindParam(':username',$_POST['Username']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $username = $result['Gebruikersnaam'];

    if($_POST['Username'] == $username)
    {
        //checks if password is correct
        if($_POST['Newpassword'] == $_POST['Repeatnewpassword'])
        {
            $passwordhash = password_hash($_POST['Newpassword'], PASSWORD_DEFAULT);

            //checks if the user is an admin
            if($result['isAdmin'] != 1)
            {
                try
                {
                    $stmt = $link->prepare("UPDATE klant SET Wachtwoord = :wachtwoord WHERE Gebruikersnaam = :username");
                    $stmt->bindParam(':username',$_POST['Username']);
                    $stmt->bindParam(':wachtwoord',$passwordhash);
                    $stmt->execute();

                    $error = "";
                    header('Location: loginSHOP.php');
                }
                catch(PDOException $e)
                {
                    echo 'Error!:'.$e->getMessage().'<br/>';
                    die();
                }
            }
            else
            {
                $error = "Gebruiker is een Admin";
            }
        }
        else
        {
            $error = "Wachtwoorden komen niet overeen";
        }
    }
    else
    {
        $error = "Gebruiker bestaat niet";
    }
}
?>

<!-- Website Template by freewebsitetemplates.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webtoepassing User information</title>
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
                    <a href="index.php">
                        <button><h3>Back to main menu</h3></button>
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
                            width: fit-content;
                            margin: auto;
                        }
                        .middlenav h1 {
                            color: white;
                            padding-top: 0.5cm;
                        }
                    </style>
                    <h1>User information</h1>
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
                height: 550px;
                margin: auto;
                margin-top: 1cm;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -52.5%);
            }
        </style>
        <table class="centertable">
            <style>
                .centertable {
                    background-color: rgb(35, 35, 35);
                    color: white;
                    border-radius: 0.25cm;
                    width: 30cm;
                    padding: 0.5cm;
                }
                .centertable th {
                    width: 25%;
                    height: 1cm;
                    border: none;
                    text-align: right;
                    padding-right: 0.5cm;
                    color: cornflowerblue;
                }
                .centertable td {
                    width: 25%;
                    height: 1cm;
                    border: none;
                    text-align: left;
                    padding-left: 0.5cm;
                }
            </style>
            <tr>
                <td>
                    Username:
                </td>
                <th>
                    <?php echo $result['Gebruikersnaam']; ?>
                </th>
                <td>
                    Password:
                </td>
                <th>
                    <a href="resetPassword.php" style="color: dodgerblue;">Change your password</a>
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
                    Phone number:
                </td>
                <th>
                    <?php echo $result['Telefoonnummer']; ?>
                </th>
            </tr>
            <tr>
                <td>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    Streetname:
                </td>
                <th>
                    <?php echo $result['Straatnaam']; ?> 
                </th>
                <td>
                    House number:
                </td>
                <th>
                    <?php echo $result['Huisnummer']; ?>
                </th>
            </tr>
            <tr>
                <td>
                    Postal code:
                </td>
                <th>
                    <?php echo $result['Postcode']; ?>
                </th>
                <td>
                    Town/City:
                </td>
                <th>
                    <?php echo $result['Gemeente']; ?>
                </th>
            </tr>
            <tr>
                <td>
                    Date of birth:
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
        <br><br>
        <div class="center2">
            <style>
            </style>
            <h3>Change user information</h3>
        </div>
    </div>
</body>
</html>
<?php
