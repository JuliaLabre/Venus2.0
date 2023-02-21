<?php
/**
 * Coleção (array) com as opções configuração inicial do aplicativo:
 * Referências:
 *  • https://www.w3schools.com/php/php_arrays.asp
 *  • https://www.w3schools.com/php/func_array.asp
 **/
$c = array(
    'ucookie' => 'mtuserdata',
    'ucookiedays' => 365
);


//  Ligação com o banco de dados
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "venushop";
$port = 3306;

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=".$dbname,$user,$pass);
    
} catch(PDOExcepcion $erro) {
   //echo "Erro: Conexão com o banco de dados não realizada".$erro;
}

