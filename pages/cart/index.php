<?php

include_once '../../includes/config.php';

session_start();
ob_start();

$_SESSION["cart"]+=1;

//echo $_SESSION["cart"];

// Se a pessoa não tiver logada mandar pra pagina de login e precisa voltar pra página em que estava antes assim que realizar o login
if (!isset($_SESSION['user_name'])) {
    $_SESSION["cart"] = true;
    $_SESSION['pagcart'] = $pag;
    echo "<script>
    alert('Faça login para adicionar produtos.');
    parent.location = '../pages/login.php';
    </script>";     
}else{
    $user_id = $_SESSION['user_id'];
}

$cart = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);




$basket = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//var_dump($basket);

$prod_id = $basket ["prod_id"];
$quant = $basket ["quant"];

/*erro >>>>>>>Warning: Trying to access array offset on value of type null in C:\xampp\htdocs\pages\cart\index.php on line 30

Warning: Trying to access array offset on value of type null in C:\xampp\htdocs\pages\cart\index.php on line 31*/


$busca= "SELECT * FROM cart WHERE id_prod = $prod_id AND id_user = $user_id LIMIT 1";

/*erro>>>>>>Fatal error: Uncaught PDOException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND user_id = 5 LIMIT 1' at line 1 i*/

$resultado = $conn->prepare($busca);
$resultado->execute();



if(($resultado)and($resultado->RowCount()!=0)) {

    $linha=$resultado->fetch(PDO::FETCH_ASSOC);
    extract($linha);
    
    if($prod_stock<$quant){        
        header ("Location: index.php");

    }
    else {
        $sql2 = "INSERT into cart(id_cart,id_prod,id_user,quant)
        values(:id_cart,:id_prod,:id_user,:quant)";
        $salvar2= $conn->prepare($sql2);
        $salvar2->bindParam(':id_cart', $id_cart, PDO::PARAM_STR);
        $salvar2->bindParam(':id_prod', $id_prod, PDO::PARAM_INT);
        $salvar2->bindParam(':id_user', $id_user, PDO::PARAM_STR);
        $salvar2->bindParam(':quant', $quant, PDO::PARAM_INT);
        $salvar2->execute();


    }
    $pag = $_SERVER['HTTP_REFERER'] ;
    header("Location:$pag");
    
}



?>