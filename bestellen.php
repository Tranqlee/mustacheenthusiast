<?php
require_once('comm.php');
session_start();
$link = getDatabase();

//haalt de gegevens van de juiste klant op

$stmt = $link->prepare("SELECT * FROM klant WHERE Gebruikersnaam = :username");
$stmt->bindValue(':username', $_SESSION['user']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

//haalt de datum en tijd op van de bestelling

$datum = $_SESSION['DATE'];

//Voeg de bestelling toe en onthoud de PK

$isbesteld = 0;
$sqlInsert = $link->prepare("INSERT INTO `order` (isBesteld, BestelDatum, Totaalprijs, KlantenID) VALUES (:ISBESTELD, :BESTELDATUM, :TOTAALPRIJS, :KLANTENID)");
$sqlInsert->bindValue(':ISBESTELD', $isbesteld);
$sqlInsert->bindValue(':BESTELDATUM', $datum);
$sqlInsert->bindValue(':TOTAALPRIJS', $_SESSION['TOTALORDERPRICE']);
$sqlInsert->bindValue(':KLANTENID', $user['KlantenID']);
$sqlInsert->execute();

$bestelling_id = $link->lastInsertId();

//  Voeg alle films die in de winkelkar zitten toe aan de tabel orderproduct

$sqlInsert = $link->prepare("INSERT INTO `orderproduct` (Aantal, OrderID, ProductID) VALUES (:AANTAL, :ORDERID, :PRODUCTID)");
$sqlInsert->bindValue(':ORDERID', $bestelling_id);

#foreach($_SESSION['WINKELKAR'] as $winkelkarFilm)
#{
#    $sqlInsert->bindValue(':PRODUCTID', $winkelkarFilm['ProductID']);
#    $sqlInsert->bindValue(':AANTAL', $winkelkarFilm['AANTAL']);
#    $sqlInsert->execute();
#}

foreach($_SESSION['WINKELKAR'] as $i => $winkelkarFilm)
{
    if (!empty($winkelkarFilm['ProductID']) && is_numeric($winkelkarFilm['ProductID'])) {
        $sqlInsert->bindValue(':PRODUCTID', $winkelkarFilm['ProductID']);
        $sqlInsert->bindValue(':AANTAL', $winkelkarFilm['AANTAL']);
        $sqlInsert->execute();
    }
}

//  De nieuwe bestelling werd aangemaakt -> meld dit aan de gebruiker en maak de winkelkar opnieuw leeg

unset( $_SESSION['WINKELKAR']);
header("Location: Bestellingafronden.php?nr=$bestelling_id");
?>