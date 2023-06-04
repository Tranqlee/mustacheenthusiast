<?php #login page wich redirects to index.php
require_once('comm.php');
session_start();
$link = getDatabase();

$OrderID = $_GET['nr'];

$sqlDelete = $link->prepare("DELETE FROM `orderproduct` WHERE OrderID = :ORDERID");
$sqlDelete->bindValue(':ORDERID', $OrderID);
$sqlDelete->execute();

$sqlDelete = $link->prepare("DELETE FROM `order` WHERE OrderID = :ORDERID");
$sqlDelete->bindValue(':ORDERID', $OrderID);
$sqlDelete->execute();

header("Location: user.php");
?>