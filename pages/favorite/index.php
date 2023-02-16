Acrescentar o favorito a tabela de favoritos, lincando o id e depois mostrar os itens favoritos

<?php
include_once '../../includes/config.php';

session_start();
ob_start();

$pag = $_SERVER['HTTP_REFERER'] ;

// Se a pessoa não tiver logada mandar pra pagina de login e precisa voltar pra página em que estava antes assim que realizar o login
if (!isset($_SESSION['user_name'])) {
    $_SESSION["favorite"] = true;
    $_SESSION['pagfav'] = $pag;
    echo "<script>
    alert('Faça login para adicionar produtos favoritos.');
    parent.location = '../login';
    </script>";     
}else{
    $user_id = $_SESSION['user_id'];
}

$fav = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

//Se o produto já estiver no favoritado tem que excluir da tabela
$busca= "SELECT * FROM favorite WHERE fav_user = $user_id ";

$resultado = $conn->prepare($busca);
$resultado->execute(); 

if(($resultado) AND ($resultado->rowCount()!= 0)){
    while($resposta = $resultado->fetch(PDO::FETCH_ASSOC)){
    extract($resposta);

        if($fav == $fav_prod){
        //não está fazendo o delete    
        $delete = "DELETE FROM favorite WHERE fav_prod = $fav AND fav_user = $user_id LIMIT 1";
        $save = $conn->prepare($delete);
        $save->execute();
        echo "<script>
        alert('Produto retirado dos favoritos');     
        </script>";

        }
    }

    $sql= "INSERT INTO favorite (fav_user,fav_prod)
    VALUES($user_id,$fav)";

    $salvar = $conn->prepare($sql);
    $salvar->execute();
}
       

        
//agora precisa retornar pra página que estava
header("Location:$pag");




?>