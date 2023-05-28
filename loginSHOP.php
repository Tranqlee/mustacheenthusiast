<?php #login page wich redirects to index.php
require_once('comm.php');
session_start();
$link = getDatabase();
unset($_SESSION['user']);
$error = "";

if (isset($_POST['Username'])) {
    $postUsername = $_POST['Username'];
    //checks if username exists
    $stmt = $link->prepare("SELECT * FROM klant WHERE Gebruikersnaam = :username");
    $stmt->bindParam(':username', $postUsername);
    $stmt->execute();
    $result = $stmt->fetch();

    if(!$result){
        $error = "Username does not exist";
    }

    if ($result && $error == "") {
        $username = $result['Gebruikersnaam'];
        //checks if password is correct
        if (password_verify($_POST['password'], $result['Wachtwoord'])) {
            $_SESSION['user'] = $username;
            header('Location: index.php');
        } else {
            $error = "Password is incorrect";
        }
    }
}
?>


<!DOCTYPE html>
<head>
    <title>Webtoepassing Login</title>
    <link rel="stylesheet" href="login.css" />
</head>
<body class="main"
      style="width: fit-content; margin: 0 auto 0 auto; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; background-color: rgb(75, 75, 75 );">
<div class="center"
     style="background-color: rgb(35, 35, 35); margin: auto; padding: 0 1cm 0 1cm; width: fit-content; height: fit-content; border-radius: 0.35cm; border: none; box-shadow: 0px 0px 10px 1px black; color: white;">
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
                            <input type="text" name="Username" id="txtUsername" size="45cm" required/>
                        </div>
                        <br>
                        <div class="cssform">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="txtPassword" size="45cm" required/>
                        </div>
                        <br>
                        <div class="buttonlogin">
                            <input class="buttonlogin" type="submit" value="Log in" style="width: 100%;"/>
                        </div>
                    </form>
                    <div style="margin: 0 auto 0 auto; width: fit-content;">
                        <p>Forgot your password? <a href="resetPassword.php">Reset your password</a></p>
                    </div>
                    <div style="margin: 0 auto 0 auto; width: fit-content;">
                        <p>Don't have an account? <a href="addUser.php">Sign up</a></p>
                    </div>
                    <br>
                    <div class="error">
                        <?php if($error != ""): ?>
                            <p class="errorText"><?php echo $error; ?></p>
                        <?php endif; ?>
                    </div>
                    <br>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>