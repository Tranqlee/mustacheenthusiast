<?php
function getDatabase(){
    try{
        $pdo = new pdo('mysql:host=sql105.epizy.com;dbname=gipwebtoepassing','epiz_33760165','GFyZ0oqxM4K');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    catch(PDOException $e){
        die($e);
    }
}
?>