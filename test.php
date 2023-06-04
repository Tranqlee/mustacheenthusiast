<?php
require_once 'comm.php';
session_start();
$link = getDatabase();

//haalt de gegevens van de juiste klant op
$stmt = $link->prepare("SELECT * FROM klant WHERE Gebruikersnaam = :username");
$stmt->bindValue(':username', $_SESSION['user']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

//haalt de datum en tijd op van de bestelling
$datum = $_SESSION['DATE'];

//maakt een div aan voor elke order van de klant
$sql = $link->prepare("SELECT * FROM `order` WHERE KlantenID = :KLANTENID");
$sql->bindValue(':KLANTENID', $user['KlantenID']);
$sql->execute();
$orders = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<head>
    <title>TEST</title>
</head>
<body>
    <div>
        <style>
            .inhoud {
                width: 100%;
                height: 100%;
                background-color: #f1f1f1;
                padding: 20px;
                border: 3px solid black;
            }
        </style>
        <?php
        foreach ($orders as $order) {
            $stmt = $link->prepare("SELECT * FROM orderproduct WHERE OrderID = :ORDERID");
            $stmt->bindValue(':ORDERID', $order['OrderID']);
            $stmt->execute();
            $orderproducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <p>Aanmaakdatum: <?php echo $order['BestelDatum']; ?></p>
            <p>OrderID: <?php echo $order['OrderID']; ?></p>
            <?php
            foreach ($orderproducts as $orderproduct) {
                $stmt = $link->prepare("SELECT * FROM product WHERE ProductID = :PRODUCTID");
                $stmt->bindValue(':PRODUCTID', $orderproduct['ProductID']);
                $stmt->execute();
                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                ?>

                <p>ProductID: <?php echo $product['ProductID']; ?></p>                
                <table class="inhoud">
                    <tr>
                        <th>
                            Product
                        </th>
                        <th>
                            Aantal
                        </th>
                        <th>
                            Prijs
                        </th>
                        <th>
                            Totaalprijs
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $product['Naam']; ?>
                        </td>
                        <td>
                            <?php echo $orderproduct['Aantal']; ?>
                        </td>
                        <td>
                            <?php echo $product['Prijs']; ?>
                        </td>
                        <td>
                            <?php echo $product['Prijs'] * $orderproduct['Aantal']; ?>
                        </td>
                    </tr>
                </table>
                <?php
            }
            ?>
            <p>Totaalprijs: <?php echo $order['Totaalprijs']; ?></p>
            <br><br><br>
            <?php
        }
        ?>
    </div>
</body>
</html>