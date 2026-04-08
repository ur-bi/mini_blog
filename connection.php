<?php 

try{

    $pdo = new PDO("mysql:host=localhost; dbname=first_project;", 'root', '');

}catch(PDOException $e){

    echo " PDO Error ->" . $e;

}