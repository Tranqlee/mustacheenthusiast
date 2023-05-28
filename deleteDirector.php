<?php
    require_once('comm.php');
    session_start();
    $directorid = $_GET['nr'];

    $link = getDatabase();
    $stmt = $link->prepare('DELETE FROM regisseuren WHERE `RegisseurID` = :id');
    $stmt->execute(array(':id' => $directorid));
    $stmt->execute();
    header('Location: admin.php');
?>