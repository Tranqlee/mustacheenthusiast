<?php
    require_once('comm.php');
    session_start();
    $id = $_GET['nr'];

    $link = getDatabase();
    $stmt = $link->prepare('DELETE FROM product WHERE `ProductID` = :id');
    $stmt->execute(array(':id' => $id));
    $stmt->execute();
    header('Location: gallery.php');
?>