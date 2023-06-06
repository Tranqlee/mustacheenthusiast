<?php
    require_once('comm.php');
    session_start();
    $link = getDatabase();

    $isUsernameAndPasswordCorrect = false;

    $stmt = $link->prepare('SELECT * FROM klant WHERE Gebruikersnaam = :Gebruikersnaam');
    $stmt->bindParam(':Gebruikersnaam', $_SESSION['user']);
    $stmt->execute();
    $userinfo = $stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['Gebruikersnaam']))
    {
        if($_POST['password'] == $_POST['repeatpassword'])
        {
            try
            {
                $link = getDatabase();
                $stmt = $link->prepare('UPDATE klant SET Gebruikersnaam = :Gebruikersnaam, Telefoonnummer = :Telefoonnummer, Straatnaam = :Straatnaam, Huisnummer = :Huisnummer, Postcode = :Postcode, Gemeente = :Gemeente, GeboorteDatum = :GeboorteDatum WHERE Gebruikersnaam = :Gebruikersnaam');
                $stmt->bindParam(':Gebruikersnaam', $_SESSION['user']);
                $stmt->bindParam(':Telefoonnummer', $_POST['Telefoonnummer']);
                $stmt->bindParam(':Straatnaam', $_POST['Straatnaam']);
                $stmt->bindParam(':Huisnummer', $_POST['Huisnummer']);
                $stmt->bindParam(':Postcode', $_POST['Postcode']);
                $stmt->bindParam(':Gemeente', $_POST['Gemeente']);
                $stmt->bindParam(':GeboorteDatum', $_POST['GeboorteDatum']);
                $stmt->execute();

                header("Location: user.php");
            }
            catch(PDOException $e)
            {
                echo 'Error!:'.$e->getMessage().'<br/>';
                die();
            }
        }
    }
?>
<!DOCTYPE html>
<head>
    <title>Webtoepassing </title>
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
                    <h2 style="color: white; margin-top: 0.5cm;">Gebruikersgegevens aanpassen</h2>
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
                                        <label for="Gebruikersnaam">Gebruikersnaam</label>
                                        <input type="text" name="Gebruikersnaam" id="txtGebruikersnaam" size="45cm" value="<?php echo $userinfo['Gebruikersnaam'] ?>" required/>
                                    </td>
                                    <td>
                                        <label for="Telefoonnummer">Telefoonnummer</label>
                                        <input type="tel" name="Telefoonnummer" id="txtTelefoonnummer" size="45cm" placeholder="0XXX-XX-XX-XX" pattern="[0]{1}[1-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{2}" value="<?php echo $userinfo['Telefoonnummer'] ?>" required/>
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
                                        <input type="text" name="Straatnaam" id="txtStraatnaam" size="45cm" value="<?php echo $userinfo['Straatnaam'] ?>" required/>
                                    </td>
                                    <td>
                                        <label for="Huisnummer">Huisnummer</label>
                                        <input type="number" name="Huisnummer" id="txtHuisnummer" size="45cm" value="<?php echo $userinfo['Huisnummer'] ?>" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="Gemeente">Gemeente</label>
                                        <input type="text" name="Gemeente" id="txtGemeente" size="45cm" value="<?php echo $userinfo['Huisnummer'] ?>" required/>
                                    </td>
                                    <td>
                                        <label for="Postcode">Postcode</label>
                                        <input type="number" name="Postcode" id="txtPostcode" size="45cm" value="<?php echo $userinfo['Postcode'] ?>" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="GeboorteDatum">Geboortedatum</label>
                                        <input type="date" name="GeboorteDatum" id="txtGeboorteDatum" size="45cm" value="<?php echo $userinfo['GeboorteDatum'] ?>" required/>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <div class="buttonlogin">
                                <input class="buttonlogin" type="submit" value="Account aanpassen" style="width: 100%;"/>
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
                            <p><a href="user.php">Ga terug naar je profiel</a></p>
                        </div>
                        <br>
                    </div>
                </td>
            </tr>
        </table> 
    </div>              
</body>
