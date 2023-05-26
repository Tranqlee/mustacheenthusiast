<?php
    require_once('comm.php');
    session_start();

    $isUsernameAndPasswordCorrect = false;
    if(isset($_POST['Gebruikersnaam']))
    {
        try
        {
            $link = getDatabase();
            $stmt = $link->prepare('INSERT INTO klant(Gebruikersnaam, Wachtwoord, Email, Telefoonnummer, Straatnaam, Huisnummer, Postcode, Gemeente, GeboorteDatum, isAdmin) VALUES(:Gebruikersnaam, :Wachtwoord, :Email, :Telefoonnummer, :Straatnaam, :Huisnummer, :Postcode, :Gemeente, :GeboorteDatum, :isAdmin)');
            if($_POST['password'] == $_POST['repeatpassword'])
            {
                $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
                $stmt->bindParam(':Wachtwoord',$password);
            }
            
            $stmt->bindParam(':Gebruikersnaam',$_POST['Gebruikersnaam']);
            $stmt->bindParam(':Email',$_POST['Email']);
            $stmt->bindParam(':Telefoonnummer',$_POST['Telefoonnummer']);

            $stmt->bindParam(':Straatnaam',$_POST['Straatnaam']);
            $stmt->bindParam(':Huisnummer',$_POST['Huisnummer']);
            $stmt->bindParam(':Postcode',$_POST['Postcode']);
            $stmt->bindParam(':Gemeente',$_POST['Gemeente']);
            $stmt->bindParam(':GeboorteDatum',$_POST['GeboorteDatum']);
            $isAdmin = 0;
            $stmt->bindParam(':isAdmin',$isAdmin);
            $stmt->execute();

            header("Location: loginSHOP.php");
        }
        catch(PDOException $e)
        {
            echo 'Error!:'.$e->getMessage().'<br/>';
            die();
        }
    }
?>
<!DOCTYPE hmtl>
<head>
    <title>Add User</title>
    <style>
        .error
        {
            color: red;
        }
        input
        {
            display: block;
            margin-bottom: 10px;
        }
        div.center
        {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            height: 500px;
        }
    </style>
</head>
<body style="background-color: rgb(35,35,35);">
    <div class="center">
    <?php
    if(!$isUsernameAndPasswordCorrect) 
    {
        ?>
        <br><br><br><br>
        <fieldset style="background-color: rgb(55,55,55); color: white;">
            <legend>Add a User</legend>
        <form action="" method="POST">
            <table style="background-color: rgb(55,55,55); color: white;">
                <tr>
                    <td>
                        <label for="Gebruikersnaam">Username</label>
                        <input type="text" name="Gebruikersnaam" id="txtGebruikersnaam" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="txtPassword" required/>
                    </td>
                    <td>
                        <label for="repeatpassword">Repeat Password</label>
                        <input type="password" name="repeatpassword" id="txtRepeatPassword" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="Email">Email</label>
                        <input type="email" name="Email" id="txtEmail" required/>
                    </td>
                    <td>
                        <label for="Telefoonnummer">Telefoonnummer</label>
                        <input type="text" name="Telefoonnummer" id="txtTelefoonnummer" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="Straatnaam">Straatnaam</label>
                        <input type="text" name="Straatnaam" id="txtStraatnaam" required/>
                    </td>
                    <td>
                        <label for="Huisnummer">Huisnummer</label>
                        <input type="text" name="Huisnummer" id="txtHuisnummer" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="Postcode">Postcode</label>
                        <input type="text" name="Postcode" id="txtPostcode" required/>
                    </td>
                    <td>
                        <label for="Gemeente">Gemeente</label>
                        <input type="text" name="Gemeente" id="txtGemeente" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="GeboorteDatum">GeboorteDatum (jjjj-mm-dd)</label>
                        <input type="text" name="GeboorteDatum" id="txtGeboorteDatum" required/>
                    </td>
                </tr>
            </table>
            <input type="submit" value="Add User" style="margin: 0cm auto 0cm auto; padding: 0cm 1.7cm 0cm 1.7cm;"/>
        </form>
        </fieldset>
        <br>
        <form action="loginSHOP.php" method="POST">
                <input type="submit" value="  Return to login screen  ">
        </form>                   
    <?php 
    }
    ?>
</body>
