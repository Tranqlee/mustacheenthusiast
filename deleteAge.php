<?php
    require_once('comm.php');
    session_start();
    $ageid = $_GET['nr'];

    $link = getDatabase();
    $stmt = $link->prepare('DELETE FROM leeftijden WHERE `LeeftijdID` = :id');
    $stmt->execute(array(':id' => $ageid));
    $stmt->execute();
    header('Location: admin.php');
?>