<?php
//  Ligação com o banco de dados
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "venushop";
$port = 3306;

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=".$dbname,$user,$pass);
    //echo "Conexão com banco de dados realizado com sucesso!";
} catch(PDOExcepcion $erro) {
   //echo "Erro: Conexão com o banco de dados não realizada".$erro;
}
