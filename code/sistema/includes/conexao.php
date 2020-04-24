<?php

function conectar(){
    
    // Dados do servidor dev
    $pdo = new PDO("mysql:host=db;dbname=cerbero","producao","sentinela10bda");


    // Dados do servidor prod
    //$pdo = new PDO("mysql:host=http://10.47.0.19;dbname=cerbero","producao","sentinela10bda");
    return $pdo;
}

?>
