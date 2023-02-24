<?php
session_start();
ob_start();

include_once '../../includes/config.php';


//Pega as mensagens recebidas para o adm
$sql = "SELECT * FROM contacts WHERE receiver=6";


?>
Cheguei, agora é só listar as opções que eu tenho
colocar mensagens recebidas
Colocar lojas e produtos para verificar se bate com as politicas de privacidade
colocar os comentario para avaliação tbm
