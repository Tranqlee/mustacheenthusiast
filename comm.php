<?php
function getDatabase(){
    try{
        $pdo = new pdo('mysql:host=localhost;dbname=gipwebtoepassing','root','');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
    catch(PDOException $e){
        echo $e;
        die($e);
    }
}
?>