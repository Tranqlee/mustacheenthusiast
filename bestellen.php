<?php
require_once('comm.php');
session_start();
$link = getDatabase();

//haalt juiste KlantenID op

$stmt = $link->prepare("SELECT * FROM klant WHERE KlantenID = :id");
$stmt->bindValue(':id', $_SESSION['user']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

//haalt de datum en tijd op

?>
<div id="current_date"></p>
<script>
    document.cookie = document.getElementById("current_date").innerHTML = Date();
</script>
<?php
$datum = $_COOKIE['current_date'];
$_SESSION['datum'] = $datum;

//Voeg de bestelling toe en onthoud de PK

$sqlInsert = $link->prepare("INSERT INTO order(KlantenID, BestelDatum, Totaalprijs) VALUES(:KlantenID, :BESTELDATUM, :TOTAALPRIJS)");
$sqlInsert->bindValue(':KlantenID', $user['KlantenID']);
$sqlInsert->bindValue(':BESTELDATUM',);
$sqlInsert->execute();

$bestelling_id = $dbh->lastInsertId();

//  Voeg alle films die in de winkelkar zitten toe aan de tabel orderproduct

$sqlInsert = $link->prepare("INSERT INTO orderproduct(bestelling_id, ProductID, console_id, aantal) VALUES(:BESTELLING_ID, :SPEL_ID, :CONSOLE_ID, :AANTAL)");
$sqlInsert->bindValue(':BESTELLING_ID', $bestelling_id);

foreach( $_SESSION['WINKELKAR'] as $winkelkarSpel)
{
    $sqlInsert->bindValue(':ProductID', $winkelkarSpel['ProductID']);
    $sqlInsert->bindValue(':AANTAL', $winkelkarSpel['AANTAL']);
    $sqlInsert->execute();
}

//  De nieuwe bestelling werd aangemaakt -> meld dit aan de gebruiker en maak de winkelkar opnieuw leeg

unset( $_SESSION['WINKELKAR'] );
?>