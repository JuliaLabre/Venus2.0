Acrescentar o favorito a tabela de favoritos, lincando o id e depois mostrar os itens favoritos

<?php
include_once '../../includes/config.php';

session_start();
ob_start();

// Se a pessoa não tiver logada mandar pra pagina de login e precisa voltar pra página em que estava antes assim que realizar o login
if (!isset($_SESSION['user_name'])) {
    echo "<script>
    alert('Faça login para adicionar produtos favoritos.');
    parent.location = '../login';
    </script>";     
}else{
    $user_id = $_SESSION['user_id'];
}

$fav = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

//Se o produto já estiver no favoritado tem que mudar o icone e tirar dos favoritos se mexer novamente

        $sql= "INSERT INTO favorite (fav_user,fav_prod)
        VALUES($user_id,$fav)";

        $salvar = $conn->prepare($sql);
        $salvar->execute();

//agora precisa retornar pra página que estava
   echo "<script>
    alert('Produto adicionado ao carrinho.');
    </script>"; 
//}
exit;


?>