<?php
    require_once('comm.php');
    session_start();
    $link = getDatabase();
    unset($_SESSION['user']);

    $isUsernameAndPasswordCorrect = false;

    if(isset($_POST['Gebruikersnaam']))
    {
        if($_POST['password'] == $_POST['repeatpassword'])
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

                $error = "";
                header("Location: loginSHOP.php");
            }
            catch(PDOException $e)
            {
                echo 'Error!:'.$e->getMessage().'<br/>';
                die();
            }
        }
        else
        {
            $error = "Wachtwoorden komen niet overeen";
        }
    }
?>
<!DOCTYPE html>
<head>
    <title>Webtoepassing Sign up</title>
    <style>
        html
        {
            height: 100%;
            background-color: rgb(75, 75, 75);
        }
        .main
        {
            background-color: white;
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
                    border-radius: 0.15cm;
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

        .buttonlogin input {
            padding: 0.25cm;
            margin: 0 auto 0 auto;
            border-radius: 0.15cm;
            background-color: lightgreen;
            border: 1px solid black;
            justify-content: center;
            font-weight: bold;
        }
        .buttonlogin input:hover {
            padding: 0.25cm;
            width: 100%;
            border-radius: 0.15cm;
            background-color: green;
            border: 1px solid black;
            justify-content: center;
            transition: 0.1s;
            font-weight: bold;
        }
    </style>
</head>
<body class="main" style="width: fit-content; margin: 0 auto 0 auto; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
    <div class="center" style="background-color: rgb(35, 35, 35); margin: 0.8cm auto auto auto; padding: 0 1cm 0 1cm; width: fit-content; height: fit-content; border-radius: 0.35cm; border: none; box-shadow: 0px 0px 10px 1px black; color: white;">
        <table>
            <tr>
                <th>
                    <h2 style="color: white; margin-top: 0.5cm;">Sign up</h2>
                </th>
            </tr>
            <tr>
                <td>
                    <div>
                    <style>
                            input {
                                padding: 0.6cm 0.15cm 0.25cm 0.15cm;
                                border-radius: 0.15cm;
                                margin: -0.6cm 0 0 0;
                            }
                            label {
                                padding: 0 0 0 0.15cm;
                                color: black;
                            }
                        </style>
                        <form action="" method="POST">
                            <table style="color: white;">
                                <tr>
                                    <td>
                                        <label for="Gebruikersnaam">Username</label>
                                        <input type="text" name="Gebruikersnaam" id="txtGebruikersnaam" size="45cm" required/>
                                    </td>
                                    <td>
                                        <div class="error">
                                            <p><?php echo $error; ?></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="txtPassword" size="45cm" required/>
                                    </td>
                                    <td>
                                        <label for="repeatpassword">Repeat Password</label>
                                        <input type="password" name="repeatpassword" id="txtRepeatPassword" size="45cm" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="Email">E-mail</label>
                                        <input type="email" name="Email" id="txtEmail" size="45cm" required/>
                                    </td>
                                    <td>
                                        <label for="Telefoonnummer">Phone number</label>
                                        <input type="text" name="Telefoonnummer" id="txtTelefoonnummer" size="45cm" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <br><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="Straatnaam">Street name</label>
                                        <input type="text" name="Straatnaam" id="txtStraatnaam" size="45cm" required/>
                                    </td>
                                    <td>
                                        <label for="Huisnummer">House number</label>
                                        <input type="text" name="Huisnummer" id="txtHuisnummer" size="45cm" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="Postcode">Postal code</label>
                                        <input type="text" name="Postcode" id="txtPostcode" size="45cm" required/>
                                    </td>
                                    <td>
                                        <label for="Gemeente">Town/City</label>
                                        <input type="text" name="Gemeente" id="txtGemeente" size="45cm" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="GeboorteDatum">Date of birth (jjjj-mm-dd)</label>
                                        <input type="text" name="GeboorteDatum" id="txtGeboorteDatum" size="45cm" required/>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <div class="buttonlogin">
                                <input class="buttonlogin" type="submit" value="Sign up" style="width: 100%;"/>
                            </div>
                        </form>
                        <style>
                            a {
                                color: dodgerblue;
                                font-weight: normal;
                            }
                            a:hover {
                                color: white;
                                font-weight: normal;
                            }
                        </style>
                        <div style="margin: 0 auto 0 auto; width: fit-content;">
                            <p><a href="loginSHOP.php">Return to login page</a></p>
                        </div>
                        <br>
                    </div>
                </td>
            </tr>
        </table> 
    </div>              
</body>
