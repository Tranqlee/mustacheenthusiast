<?php
    require_once('comm.php');
    session_start();
    $link = getDatabase();
    $_SESSION['alert'] = "";

    $productwijzigenid = $_GET['nr'];

    $stmt = $link->prepare('SELECT * FROM product WHERE `ProductID` = :id');
    $stmt->bindParam(':id', $productwijzigenid);
    $stmt->execute();
    $productwijzigen = $stmt->fetch(PDO::FETCH_ASSOC);
    $test = "";

    if(isset($_POST['afbeelding']))
    {
        //update alle velden
        $stmt = $link->prepare('UPDATE product SET `Afbeelding` = :afbeelding, `Naam` = :naam, `GenreID` = :genre, `Leeftijd` = :leeftijd, `RegisseurID` = :regisseur, `Beschrijving` = :beschrijving, `Aantal` = :aantal, `Prijs` = :prijs  WHERE `ProductID` = :id');
        $stmt->bindParam(':afbeelding', $_POST['afbeelding']);
        $stmt->bindParam(':naam', $_POST['naam']);
        $stmt->bindParam(':genre', $_POST['genre']);
        $stmt->bindParam(':leeftijd', $_POST['leeftijd']);
        $stmt->bindParam(':regisseur', $_POST['regisseur']);
        $stmt->bindParam(':beschrijving', $_POST['beschrijving']);
        $stmt->bindParam(':aantal', $_POST['aantal']);
        $stmt->bindParam(':prijs', $_POST['prijs']);
        $stmt->bindParam(':id', $productwijzigenid);
        $stmt->execute();

        $_SESSION['alert'] = "Product is aangepast";
        header('Location: admin.php');
    }
?>
<!DOCTYPE html>
<head>
    <title>Webtoepassing Product Aanpassen</title>
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
<body class="main" style="width: fit-content; margin: 0 auto 0 auto; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; background-color: transparent;">
    <div class="center" style="background-color: rgb(35, 35, 35); margin: 0.8cm auto auto auto; padding: 0 1cm 0 1cm; width: fit-content; height: fit-content; border-radius: 0.35cm; border: none; box-shadow: 0px 0px 10px 1px black; color: white;">
        <table>
            <tr>
                <td>
                    <table>
                        <tr>
                            <th>
                                <h2 style="color: white; margin-top: 0.5cm;">Product aanpassen</h2>
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
                                            z-index: 2;
                                        }
                                        select {
                                            padding: 0.15cm;
                                            margin: 0.15cm;
                                            border: none;
                                            border-radius: 0.10cm;
                                        }
                                        option {
                                            text-align: right;
                                        }
                                    </style>
                                    <form action="" method="POST">
                                        <table style="color: white;">
                                            <tr>
                                                <td style="display: table-cell; vertical-align: top;">
                                                    <p for="id">Product ID:<?php echo " " . $productwijzigenid?></p>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="afbeelding">Afbeelding (+ .jpg)</label>
                                                    <input type='text' name='afbeelding' id='txtafbeelding' size='45cm' value="<?php echo $productwijzigen['Afbeelding'] ?>" required/>
                                                    <br>
                                                </td>
                                                <td>
                                                    <label for="naam">Naam</label>
                                                    <input type="text" name="naam" id="txtnaam" size="45cm" value="<?php echo $productwijzigen['Naam'] ?>" required/>
                                                    <br>
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="tableID">
                                            <style>
                                                .tableID {
                                                    width: 100%;
                                                }
                                                .tableID td {
                                                    width: 33.333%;
                                                }
                                                .tableID label {
                                                    color: white;
                                                }
                                            </style>
                                            <tr>
                                                <td>
                                                    <label for="genre">Hoofdgenre</label>
                                                    <br>
                                                    <div>
                                                        <select id="membersField" name="genre" required/>
                                                            <?php
                                                                $query = $link->query("SELECT * FROM Genres");
                                                                $genres = $query->fetchAll();

                                                                foreach($genres as $genre)
                                                                {
                                                                    echo "<option name='$genre[GenreID]' value='$genre[GenreID]'>$genre[Naam]</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <br>
                                                </td>
                                                <td>
                                                    <label for="leeftijd">Leeftijdrestrictie</label>
                                                    <div>
                                                        <select id="membersField" name="leeftijd" required/>
                                                            <?php
                                                                $query = $link->query("SELECT * FROM leeftijden");
                                                                $leeftijden = $query->fetchAll();

                                                                foreach($leeftijden as $leeftijd)
                                                                {
                                                                    echo "<option value='$leeftijd[LeeftijdID]'>$leeftijd[Naam]</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <br>
                                                </td>
                                                <td>
                                                    <label for="regisseur">Regisseur</label>
                                                    <div>
                                                        <select id="membersField" name="regisseur" required/>
                                                            <?php
                                                                $query = $link->query("SELECT * FROM regisseuren");
                                                                $regisseurs = $query->fetchAll();

                                                                foreach($regisseurs as $regisseur)
                                                                {
                                                                    echo "<option value='$regisseur[RegisseurID]'>$regisseur[Naam]</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <br>
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <td>
                                                    <label for="beschrijving">Beschrijving</label>
                                                    <input type="text" name="beschrijving" id="txtbeschrijving" size="97.5cm" value="<?php echo $productwijzigen['Beschrijving'] ?>" required/>
                                                    <br>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <td>
                                                    <label for="aantal">Aantal</label>
                                                    <input type="number" name="aantal" id="txtaantal" size="45cm" value="<?php echo $productwijzigen['Aantal'] ?>" required/>
                                                    <br>
                                                </td>
                                                <td>
                                                    <label for="prijs">Prijs</label>
                                                    <input type="number" name="prijs" id="txtprijs" size="45cm" step="0.01" value="<?php echo $productwijzigen['Prijs'] ?>" required/>
                                                    <br>
                                                </td>
                                            </tr>
                                        </table>
                                        <br>
                                        <div class="buttonlogin">
                                            <input class="buttonlogin" type="submit" value="Pas product aan" style="width: 100%;"/>
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
                                        <p><a href="admin.php">Ga terug naar admin.php</a></p>
                                    </div>
                                    <br>
                                </div>
                            </td>
                        </tr>
                    </table> 
                </td>
            </tr>
        </table>
    </div>              
</body>

<form action="deleteUser.php" method="POST">
                    <label for="membersField">Members</label>
                    <br>
                    <select id="membersField" name="members" required/>
                        <?php
                            $link = getDatabase();
                            $query = $link->query("SELECT * FROM members");
                            $memb = $query->fetchAll();
                            foreach($memb as $members)
                            {
                                echo "<option value='$members[memberLogin]'>$members[memberLogin]</option>";
                                $memb = $query->fetchAll();
                            }
                        ?>
                    </select>
                    <br><br>
                    <input type="submit" value="DeleteUser" name="delete">
                </form>