<?php
    require_once('comm.php');
    session_start();
    $link = getDatabase();

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


<!DOCTYPE html>
<head>
    <title>Webtoepassing Reset Password</title>
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
        <?php
            if($error == "")
            {
                ?>
                .error
                {
                    border: none;
                    background-color: transparent;
                }
                <?php
            }
            else
            {
                ?>
                .error
                {
                    color: white;
                    border: 1px solid black;
                    border-radius: 0.25cm;
                    background-color: red;
                    padding: 0 0.25cm 0 0.25cm;
                }
                <?php
            }
        ?>
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

        .buttonresetpassword input {
            padding: 0.25cm;
            margin: 0 auto 0 auto;
            border-radius: 0.25cm;
            background-color: lightgray;
            border: 1px solid black;
            justify-content: center;
            font-weight: bold;
        }
        .buttonresetpassword input:hover {
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
                    <h2>Reset Password</h2>
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
                                <label for="password">New password</label>
                                <input type="password" name="Newpassword" id="txtNewPassword" required/>
                            </div>
                            <div class="cssform">
                                <label for="password">Repeat new password</label>
                                <input type="password" name="Repeatnewpassword" id="txtRepeatNewPassword" required/>  
                            </div>
                            <br>
                            <div class="buttonresetpassword">
                                <input class="buttonresetpassword" type="submit" value="Reset password" style="width: 100%;"/>
                            </div>
                            <br>
                        </form>
                        <br>
                        <div class="error">
                            <p><?php echo $error; ?></p>
                        </div>
                        <br><br>
                        <style>
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
                        <form action="loginSHOP.php" class="buttonresetpassword">
                            <button type="submit">Return to login page</button>
                        </form>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>