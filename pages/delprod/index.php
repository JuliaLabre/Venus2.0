<?php
include_once '../../includes/config.php';

session_start();
ob_start();

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    $_SESSION['msg'] = "Erro";
    header("Location: ../shop");
    exit();
}

//precisa de uma confirmação de exclusão

$sql = "UPDATE products set prod_status = 'deleted' WHERE prod_id = $id LIMIT 1";
           
$resultado= $conn->prepare($sql); 
$resultado->execute();

if(($resultado) AND ($resultado->rowCount()!= 0)){

    echo  "<script>
    alert('Produto excluído com sucesso com sucesso!!');
    parent.location = '../shop';
    </script>";

}else{

    echo  "<script>
    alert('Erro: Tente novamente!!');
    parent.location = '../shop';
    </script>";
}

