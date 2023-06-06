<?php
    require_once('comm.php');
    session_start();
    $productid = $_GET['nr'];

    $link = getDatabase();
    $stmt = $link->prepare('DELETE FROM regisseuren WHERE `RegisseurID` = :id');
    $stmt->execute(array(':id' => $productid));
    $stmt->execute();

    $_SESSION['alert'] = "Regisseur is verwijderd";
    header('Location: admin.php');
?>