<?php
    require_once('comm.php');
    session_start();
    $productid = $_GET['nr'];

    $link = getDatabase();
    $stmt = $link->prepare('DELETE FROM product WHERE `ProductID` = :id');
    $stmt->execute(array(':id' => $productid));
    $stmt->execute();
    header('Location: admin.php');
?>