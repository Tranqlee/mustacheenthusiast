<?php
    require_once('comm.php');
    session_start();
    $link = getDatabase();
        if(isset($_SESSION['user']))
        {        
            if(isset($_POST['productname']))
            {
                try{
                    $query = $link->prepare("INSERT INTO product (Naam, ProductID, Kleur, CategorieID, Beschrijving, Prijs) VALUES (:productname, :type, :kleur, :category, :description, :price)");
                    $query->bindParam(":productname", $_POST['productname']);
                    $query->bindParam(":type", $_POST['type']);
                    $query->bindParam(":kleur", $_POST['kleur']);
                    $query->bindParam(":category", $_POST['category']);
                    $query->bindParam(":description", $_POST['description']);
                    $query->bindParam(":price", $_POST['price']);
                    $query->execute();
                    // $record = $stmt->fetch();
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
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Webtoepassing Shoppingcart</title>
                    <link rel="stylesheet" type="text/css" href="css/style.css">
                    <link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">	
                    <link rel="stylesheet" type="text/css" href="css/NewStyle.css">
                    <script type="text/javascript" src="js/mobile.js"></script>
                </head>
                <body style="background-color: #626262;">
                    <div id="header">
                        <a href="index.html" class="logo">
                            <img src="images/logo.jpg" alt="">
                        </a>
                        <ul id="navigation" class="Navigatie" style="position: fixed; padding-right: 1cm;padding-left: 1cm;margin-top: -2cm;margin-right: 5cm;margin-left: 4.8225cm;padding-bottom: 0.5cm;z-index: 1; background-image: linear-gradient(to bottom right, #636B7C, #323C54);border-radius: 0.25cm;box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);">
                            <li>
                                <a href="index.php">| Home |</a>
                            </li>
                            <li>
                                <a href="gallery.php">| Products | </a>
                            </li>
                            <li class="selected">
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
                                    echo "<a href='login.php'>Uitloggen</a>";
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
                    <br><br><br>
                        <style>
                            table {
                                border: 0.1cm solid black;
                            }
                        </style>
                        <p>
                            <fieldset style="margin: 0cm 35cm 0cm 0.5cm; color: white; font-weight: bold; background-image: linear-gradient(to bottom right, #636B7C, #323C54);">
                                <br>
                                <form action="" method="POST">
                                    <label for="deleteKAR">Verwijder de winkelkar</label>
                                    <input type="submit" name="deleteKAR" value="Verwijder">
                                </form>
                            </fieldset>
                        </p>
                        <br>
                        <table style="margin-left: 0.5cm; background-color: lightslategray; border: 1px solid black; border-radius: 10px;">
                        <?php 
                            
                            $query = $link->query("SELECT * FROM product");
                            $products = $query->fetchAll();
                        ?>
                            <tr>
                                <th style="padding-left: 0.5cm; padding-right: 0.5cm;">ID</th>
                                <th style="padding-left: 0.5cm; padding-right: 3cm;">Product</th>
                                <th style="padding-left: 0.5cm; padding-right: 2cm;">Kleur</th>
                                <th style="padding-left: 0.5cm; padding-right: 2cm;">Categorie</th>
                                <th style="padding-left: 0.5cm; padding-right: 10cm;">Beschrijving</th>
                                <th style="padding-left: 0.5cm; padding-right: 1.5cm;">Prijs</th>
                            </tr>
                                <?php
                                    #ontvangt de sessie variabele array en zet deze in een tabel
                                    if($_SESSION['arrayEmpty'] == false)
                                    {
                                        for($i = 0; $i < 10; $i++)
                                        {
                                            echo "<tr>";
                                            for($j = 0; $j < 2; $j++)
                                                {
                                                    ?>
                                                    <td> <?php echo $_SESSION['2dimARRAY'][$i][$j]; ?> </td>
                                                    <?php
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo "Array is leeg"; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                        </table>
                </body>
            </html>
        <?php
        }
        else
        {
            header("Location: loginSHOP.php");
        }
        ?>