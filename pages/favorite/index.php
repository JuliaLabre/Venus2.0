<?php
include_once '../../includes/config.php';

session_start();
ob_start();


//ideias para depois - adicionar lojas favotitas também;

$pag = $_SERVER['HTTP_REFERER'] ;
//Acrescentar o favorito a tabela de favoritos, lincando o id e depois mostrar os itens favoritos


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

//Se o produto já estiver favoritado exclui o item dos favoritos

$busca= "SELECT * FROM favorite WHERE fav_prod = $fav AND fav_user = $user_id LIMIT 1";
$resultado = $conn->prepare($busca);
$resultado->execute(); 


if(($resultado) AND ($resultado->rowCount()!= 0)){          
        $delete = "DELETE FROM favorite WHERE fav_prod = $fav AND fav_user = $user_id LIMIT 1";
        $save = $conn->prepare($delete);
        $save->execute();
        
        echo "<script>
        alert('Produto retirado dos favoritos'); 
        parent.location = '$pag'; 
        </script>";
}else{ 
    $sql= "INSERT INTO favorite (fav_user,fav_prod)
    VALUES($user_id,$fav)";

    $salvar = $conn->prepare($sql);
    $salvar->execute();

    echo "<script>
    alert('Produto adicionado aos favoritos'); 
    parent.location = '$pag'; 
    </script>";

}

?>