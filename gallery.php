<?php
    require_once('comm.php');
    session_start();
    if(isset($_SESSION['user']))
    {
        $link = getDatabase();
        $rij = 0;
        $kolom = 0;
    
        if(isset($_POST['productname']))
        {
            try{
                $query = $link->prepare("INSERT INTO product (Naam, ProductID, Leeftijd, RegisseurID, Beschrijving, Prijs, Aantal) VALUES (:productname, :type, :leeftijd, :regisseur, :description, :price, :Amount)");
                $query->bindParam(":productname", $_POST['productname']);
                $query->bindParam(":type", $_POST['type']);
                $query->bindParam(":leeftijd", $_POST['age']);
                $query->bindParam(":regisseur", $_POST['director']);
                $query->bindParam(":description", $_POST['description']);
                $query->bindParam(":price", $_POST['price']);
                $query->bindParam(":Amount", $_POST['productamount']);
                $query->execute();
    
                #query voor het SELECTEN van de naam en de id van de regisseuren "regisseur" voor alle bindparams
                $query = $link->prepare("SELECT Naam, RegisseurID FROM regisseuren WHERE Naam = :regisseur");
                $query->bindParam(":regisseur", $_POST['director']);
                $query->execute();
                $record = $query->fetch(); 
            }
            catch(PDOException $e)
            {
                echo 'Error!:'.$e->getMessage().'<br/>';
                die();
            }
        }    
    
        #voegt het ID en het aantal toe aan een 2 dimensionale array waar constant nieuwe waardes aan toegevoegd kunnen worden zonder dat de oude waardes verloren gaan en dit dan allemaal toont in de shoppingcart.php
        if(isset($_POST['productid']))
        {
            $productid = $_POST['productid'];
            $aantal = $_POST['amount'];
    
            $rij = 0;
            $rijOptellen = 0;
    
            $rijResultaat = $rijOptellen + $rij + 1;
            $rijOptellen = $rijResultaat;
    
            #zet het productid en de amount in een 2 dimensionale array doormiddel van een nieuwe array aan te maken
            $TWOdimARRAY[$rij][$kolom] = array();
    
            $TWOdimARRAY[$rij][$kolom] = $productid;
            $TWOdimARRAY[$rij][$kolom + 1] = $aantal;
    
            #zet de array in een sessie variabele en stuurt hem naar shoppingcart.php
            $_SESSION['2dimARRAY'] = $TWOdimARRAY;
    
        }
        
        if(isset($_POST['productidVERWIJDEREN']))
        {
            try{
                $query = $link->prepare("DELETE FROM product WHERE ProductID = :productid");
                $query->bindParam(":productid", $_POST['productidVERWIJDEREN']);
                $query->execute();
            }
            catch(PDOException $e)
            {
                echo 'Error!:'.$e->getMessage().'<br/>';
                die();
            }
        }
    
        if(isset($_POST['productidWIJZIGEN']))
        {
            try{
                $query = $link->prepare("UPDATE product SET Naam = :Naam, Prijs = :Prijs, Leeftijd = :leeftijd, Beschrijving = :Beschrijving, RegisseurID = :RegisseurID, Aantal = :Amount WHERE ProductID = :productid");
                $query->bindParam(":Naam", $_POST['productnameWIJZIGEN']);
                $query->bindParam(":Prijs", $_POST['priceWIJZIGEN']);
                $query->bindParam(":leeftijd", $_POST['ageWIJZIGEN']);
                $query->bindParam(":Beschrijving", $_POST['descriptionWIJZIGEN']);
                $query->bindParam(":RegisseurID", $_POST['directorWIJZIGEN']);
                $query->bindParam(":productid", $_POST['productidWIJZIGEN']);
                $query->bindParam(":Amount", $_POST['productamountWIJZIGEN']);
                $query->execute();
            }
            catch(PDOException $e)
            {
                echo 'Error!:'.$e->getMessage().'<br/>';
                die();
            }
        }
        ?>
        <!doctype html>
        <!-- Website Template by freewebsitetemplates.com -->
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Webshop-Producten</title>
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">	
            <link rel="stylesheet" type="text/css" href="css/NewStyle.css">
            <script type="text/javascript" src="js/mobile.js"></script>
        </head>
        <body style="background-color: #626262;">
            <div id="header" style="justify-content: center; width: 100cm;">
                <ul id="navigation" class="Navigatie" style="position: fixed; padding: 1.5cm 1cm 1cm 0.5cm; margin: -2cm auto 0 auto; width: 100%; z-index: 1; background-image: linear-gradient(to bottom right, #636B7C, #323C54); box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5); border-radius: 0cm;">
                    <li>
                        <a href="index.php">| Home |</a>
                    </li>
                    <li class="selected">
                        <a href="gallery.php">| Products | </a>
                    </li>
                    <li>
                        <a href="shoppingcart.php">| Cart |</a>
                    </li>
                    <li>
                        <a href="about.html">| About |</a>
                    </li>
                </ul>
                <ul id="navigation" class="Navigatie" style="position:absolute; top: 0; right: 0; padding: 0.25cm 1cm 0.25cm 0cm; z-index: 1; background-image: linear-gradient(to top right, #323C54, #636B7C);border-radius: 0cm 0cm 0cm 0.25cm;box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);">
                    <li style="align-items: right;">
                        <?php
                            echo "Ingelogd als: " . $_SESSION['user'];
                            echo "<br><br>";
                            echo "<a href='loginSHOP.php'>Uitloggen</a>";
                        ?>
                    </li>
                </ul>
            </div>
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
            <div>
                <div>
                    <?php
                        $query = $link->query("SELECT isAdmin FROM klant WHERE Gebruikersnaam = '$_SESSION[user]'");
                        $isAdmin = $query->fetch();
                        if($isAdmin['isAdmin'] == 1)
                        {
                            ?>
                            <table style="margin: 0cm auto 0cm auto; border: 0px;">
                                <tr>
                                    <td style="border: 5px solid #626262; border-collapse: collapse; background-color: #626262;">
                                        <fieldset style="margin: 0cm 0.25cm 0cm 0.25cm; color: white; font-weight: bold; background-image: linear-gradient(to bottom right, #636B7C, #323C54);">
                                            <legend>Product Toevoegen</legend>
                                            <br>
                                            <form action="gallery.php" method="POST">
                                                <label for="productname">Productnaam</label>
                                                <input type="text" name="productname" id="txtproductname" required/>
                                                <table style="border: none; text-align: left;">
                                                    <tr>
                                                        <th><label for="ageField">Leeftijd</label></th>
                                                        <th><label for="directorField">Regisseur</label></th>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <select id="ageField" name="age" required style="padding-right: 0.225cm; margin-right: 0.1cm"/>
                                                                <?php
                                                                    $query = $link->query("SELECT * FROM leeftijden");
                                                                    $ages = $query->fetchAll();
                                                                    foreach ($ages as $age)
                                                                    {
                                                                        echo "<option value='$age[LeeftijdID]'>$age[Naam]</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                        </th>
                                                        <th>
                                                            <select id="directorID" name="director" required/>
                                                                <?php
                                                                    $query = $link->query("SELECT * FROM regisseuren");
                                                                    $directors = $query->fetchAll();
                                                                    foreach ($directors as $director)
                                                                    {
                                                                        echo "<option value='$director[RegisseurID]'>$director[Naam]</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                        </th>
                                                    </tr>
                                                </table>
                                                <br>
                                                <label for="productamount">Aantal</label>
                                                <input type="number" name="productamount" id="productamount" min="0" max="10000" step="1" required/>
                                                <label for="description">Beschrijving</label>
                                                <input type="text" name="description" id="txtdescription" required/>
                                                <label for="price">Prijs</label>
                                                <input type="number" name="price" id="price" min="0.00" max="10000.00" step="0.01" required/>
                                                <input type="submit" value="Voeg Toe" style="padding-right: 2.75cm;"/>
                                            </form>
                                        </fieldset>
                                    </td>
                                    <td>
                                        <fieldset style="margin: 0cm 0.25cm 0cm 0.25cm; color: white; font-weight: bold; background-image: linear-gradient(to bottom right, #636B7C, #323C54);">
                                            <legend>Product Wijzigen</legend>
                                            <form action="gallery.php" method="POST">
                                                <label for="productidWIJZIGEN">Product ID</label>
                                                <input type="number" name="productidWIJZIGEN" id="productid" min="1" required/>
                                                <label for="productnameWIJZIGEN">Productnaam</label>
                                                <input type="text" name="productnameWIJZIGEN" id="txtproductname" required/>
                                                <table style="border: none; text-align: left;">
                                                    <tr>
                                                        <th><label for="ageField">Leeftijd</label></th>
                                                        <th><label for="directorField">Regisseur</label></th>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <select id="ageField" name="ageWIJZIGEN" required style="padding-right: 0.225cm; margin-right: 0.1cm"/>
                                                                <?php
                                                                    $query = $link->query("SELECT * FROM leeftijden");
                                                                    $ages = $query->fetchAll();
                                                                    foreach ($ages as $age)
                                                                    {
                                                                        echo "<option value='$age[LeeftijdID]'>$age[Naam]</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                        </th>
                                                        <th>
                                                            <select id="directorField" name="directorWIJZIGEN" required/>
                                                                <?php
                                                                    $query = $link->query("SELECT * FROM regisseuren");
                                                                    $directors = $query->fetchAll();
                                                                    foreach ($directors as $director)
                                                                    {
                                                                        echo "<option value='$director[RegisseurID]'>$director[Naam]</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                        </th>
                                                    </tr>
                                                </table>
                                                <br>
                                                <label for="productamountWIJZIGEN">Aantal</label>
                                                <input type="number" name="productamountWIJZIGEN" id="productamountWIJZIGEN" min="0" max="10000" step="1" required/>
                                                <label for="description">Beschrijving</label>
                                                <input type="text" name="descriptionWIJZIGEN" id="txtdescription" required/>
                                                <label for="price">Prijs</label>
                                                <input type="number" name="priceWIJZIGEN" id="price" min="0.00" max="10000.00" step="0.01" required/>
                                                <input type="submit" value="Wijzigen" style="padding-right: 2.75cm;"/>
                                            </form>
                                        </fieldset>
                                    </td>
                                    <td>
                                        <fieldset style="margin: 0cm 0.25cm 0cm 0.25cm; color: white; font-weight: bold; background-image: linear-gradient(to bottom right, #636B7C, #323C54);">
                                            <legend>Product Verwijderen</legend>
                                            <form action="gallery.php" method="POST">
                                                <label for="productidVERWIJDEREN">Product ID</label>
                                                <input type="number" name="productidVERWIJDEREN" id="productid" min="1" required/>
                                                <input type="submit" value="Verwijderen" style="padding-right: 2.40cm;"/>
                                            </form>
                                        </fieldset>
                                    </td>
                                    <td>
                                        <fieldset style="margin: 0cm 0.25cm 0cm 0.25cm; color: white; font-weight: bold; background-image: linear-gradient(to bottom right, #636B7C, #323C54);">
                                            <legend>Product toevoegen aan winkelkar</legend>
                                            <form action="gallery.php" method="POST">
                                                <label for="productid">Product ID</label>
                                                <input type="number" name="productid" id="productid" min="1" required/>
                                                <label for="amount">Aantal</label>
                                                <input type="number" name="amount" id="amount" min="1" max="100" required/>
                                                <input type="submit" value="Voeg Toe" style="padding-right: 2.75cm;"/>
                                            </form>
                                        </fieldset>
                                    </td>
                                </tr>
                            </table>
                            <?php
                        }
                        if($isAdmin['isAdmin'] == 0)
                        {
                            ?>
                                <fieldset style="width: 0px; margin: 0cm auto 0cm auto; color: white; font-weight: bold; background-image: linear-gradient(to bottom right, #636B7C, #323C54);">
                                    <legend>Product toevoegen aan winkelkar</legend>
                                    <form action="gallery.php" method="POST">
                                        <label for="productid">Product ID</label>
                                        <input type="number" name="productid" id="productid" min="1" required/>
                                        <label for="amount">Aantal</label>
                                        <input type="number" name="amount" id="amount" min="1" max="100" required/>
                                        <input type="submit" value="Voeg Toe" style="padding-right: 2.75cm;"/>
                                    </form>
                                </fieldset>
                            <?php
                        }
                    ?>                            
                </div>
                <br>
                <style>
                    table {
                        border: 0.1cm solid black;
                    }
                </style>
                <table align="center" style="margin-left: 0.5cm; background-color: lightslategray; border: 1px solid black; border-radius: 10px; margin: 0cm auto 0cm auto;">
                <?php
                    $query = $link->query("SELECT * FROM product");
                    $products = $query->fetchAll();
                ?>
                    <tr>
                        <th style="padding-left: 0.5cm; padding-right: 0.5cm;">ID</th>
                        <th style="padding-left: 0.5cm; padding-right: 3cm;">Product</th>
                        <th style="padding-left: 0.5cm; padding-right: 2cm;">Leeftijd</th>
                        <th style="padding-left: 0.5cm; padding-right: 2cm;">Regisseur</th>
                        <th style="padding-left: 0.5cm; padding-right: 10cm;">Beschrijving</th>
                        <th style="padding-left: 0.5cm; padding-right: 0.5cm;">Prijs</th>
                        <th style="padding-left: 0.5cm; padding-right: 0.5cm;">voorraad</th>
                    </tr>
                    <?php 
                    foreach($products as $product):
                            $directorID = $link->prepare("SELECT * FROM regisseuren WHERE RegisseurID = :regisseurID");
                            $directorID->bindParam(":regisseurID", $product['RegisseurID']);
                            $directorID->execute();
                            $directorID = $directorID->fetch();
        
                            $ageID = $link->prepare("SELECT * FROM leeftijden WHERE LeeftijdID = :leeftijdID");
                            $ageID->bindParam(":leeftijdID", $product['Leeftijd']);
                            $ageID->execute();
                            $ageID = $ageID->fetch();
                        ?>
                        <tr>
                            <td style="text-align: right;"><?php echo $product['ProductID']; ?></td>
                            <td style="text-align: right;"><?php echo $product['Naam']; ?></td>
                            <td style="text-align: right;"><?php echo $ageID['Naam']; ?></td>
                            <td style="text-align: right;"><?php echo $directorID['Naam']; ?></td>
                            <td style="text-align: right;"><?php echo $product['Beschrijving']; ?></td>
                            <td style="text-align: right;"><?php echo $product['Prijs']; ?></td>  
                            <td style="text-align: right;"><?php echo $product['Aantal']; ?></td>
                        </tr>
                    <?php
                        endforeach;
                    ?>
                </table>
            </div>
        </body>
        </html>
    <?php
    }
    else
    {
        header("Location: login.php");
    }