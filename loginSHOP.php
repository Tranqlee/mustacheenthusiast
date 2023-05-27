<?php #login page wich redirects to index.php
    require_once('comm.php');
    session_start();
    unset($_SESSION['user']);

    if(isset($_POST['Username']))
    {
        try
        {
            $link = getDatabase();
            $stmt = $link->prepare("SELECT * FROM klant WHERE Gebruikersnaam = :username");
            $stmt->bindParam(':username',$_POST['Username']);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if($result && password_verify($_POST['password'], $result['Wachtwoord']))
            {
                $_SESSION['user'] = $_POST['Username'];
                header('Location: index.php');
            }
        }
        catch(PDOException $e)
        {
            echo 'Error!:'.$e->getMessage().'<br/>';
            die();
        }
    }
?>


<!DOCTYPE html>
<head>
    <title>Webtoepassing Login</title>
    <style>
        html
        {
            height: 100%;
        }
        .main
        {
            background-color: gray;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .error
        {
            color: red;
        }
            input
        {
            display: block;
            margin-bottom: 10px;
        }
        div.center, body
        {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            height: 550px;
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -52.5%);
        }

        .buttonlogin input {
            padding: 0.25cm;
            margin: 0 auto 0 auto;
            border-radius: 0.25cm;
            background-color: lightgray;
            border: 1px solid black;
            justify-content: center;
            font-weight: bold;
        }
        .buttonlogin input:hover {
            padding: 0.25cm;
            width: 100%;
            border-radius: 0.25cm;
            background-color: gray;
            border: 1px solid black;
            justify-content: center;
            transition: 0.1s;
            font-weight: bold;
        }
    </style>
</head>
<body class="main" style="width: fit-content; margin: 0 auto 0 auto; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; background-color: rgb(35,35,35);">
    <div class="center" style="background-color: white; margin: auto; padding: 0 1cm 0 1cm; width: fit-content; height: fit-content; border-radius: 0.5cm; border: none;">
        <table>
            <tr>
                <th>
                    <h2>Login</h2>
                </th>
            </tr>
            <tr>
                <td>
                    <div>
                        <form action="" method="POST">
                            <div class="cssform">
                                <label for="Username">Username</label>
                                <input type="text" name="Username" id="txtUsername" required/>
                            </div>
                            <div class="cssform">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="txtPassword" required/>
                            </div>
                            <br>
                            <div class="buttonlogin">
                                <input class="buttonlogin" type="submit" value="Log in" style="width: 100%;"/>
                            </div>
                        </form>
                        <br><br><br>
                        <style>
                            .buttonsignup {
                                width: 100%;
                            }
                            .buttonsignup button {
                                padding: 0.25cm;
                                width: 100%;
                                margin: 0 auto 0 auto;
                                border-radius: 0.25cm;
                                background-color: lightgray;
                                color: black;
                                border: 1px solid black;
                                justify-content: center;
                                font-weight: bold;
                                text-decoration: none;
                            }
                            .buttonsignup button:hover {
                                padding: 0.25cm;
                                width: 100%;
                                border-radius: 0.25cm;
                                background-color: gray;
                                color: black;
                                border: 1px solid black;
                                justify-content: center;
                                transition: 0.1s;
                                font-weight: bold;
                                text-decoration: none;
                            }

                            .buttonresetpassword {
                                width: 100%;
                            }
                            .buttonresetpassword button {
                                padding: 0.25cm;
                                width: 100%;
                                margin: 0 auto 0 auto;
                                border-radius: 0.25cm;
                                background-color: lightgray;
                                color: black;
                                border: 1px solid black;
                                justify-content: center;
                                font-weight: bold;
                                text-decoration: none;
                            }
                            .buttonresetpassword button:hover {
                                padding: 0.25cm;
                                width: 100%;
                                border-radius: 0.25cm;
                                background-color: gray;
                                color: black;
                                border: 1px solid black;
                                justify-content: center;
                                transition: 0.1s;
                                font-weight: bold;
                                text-decoration: none;
                            }
                        </style>
                        <form action="addUser.php" class="buttonsignup">
                            <button type="submit">Sign up</button>
                        </form>
                        <br>
                        <form action="resetPassword.php" class="buttonresetpassword">
                            <button type="submit">Reset password</button>
                        </form>
                    </div>
                </td>
            </tr>
        </table>
        <br>
        <table style="margin: 0 auto 0.60cm auto; z-index: 1; margin-top: auto;">
            <tr>
                <td <?php 
                    if($error != "")
                    {
                        ?> style="color: black; font-weight: bold; text-align: center; background-color: red; padding: 0.25cm; border: none; border-radius: 0.25cm;" <?php
                        echo $error;
                    }
                    ?>
                </td>
            </tr>
        </table>
    </div>
</body>