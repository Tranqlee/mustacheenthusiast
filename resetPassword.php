<?php
    require_once('comm.php');
    session_start();

    if(isset($_POST['Resetpassword']))
    {
        if($_POST['Newpassword'] == $_POST['Repeatnewpassword'])
        {
            try
            {
                $link = getDatabase();
                $stmt = $link->prepare("UPDATE klant SET Wachtwoord = :wachtwoord WHERE Gebruikersnaam = :username");
                $stmt->bindParam(':username',$_POST['Username']);
                $stmt->bindParam(':wachtwoord',$_POST['Newpassword'])
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
            $error = "'New password' en 'Repeat new password' zijn niet hetzelfde";   
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
                                <input class="buttonresetpassword" type="submit" value="Resetpassword" style="width: 100%;"/>
                            </div>
                            <br>
                        </form>
                        <div class="buttonresetpassword">
                            <label><?php echo $error; ?></label>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>