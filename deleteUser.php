<?php
    require_once('comm.php');
    session_start();
    $userid = $_GET['nr'];

    $link = getDatabase();
    $stmt = $link->prepare('DELETE FROM klant WHERE `KlantenID` = :id');
    $stmt->execute(array(':id' => $userid));
    $stmt->execute();
    header('Location: admin.php');
?>