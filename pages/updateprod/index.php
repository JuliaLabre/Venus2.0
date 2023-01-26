<?php
include_once '../../includes/config.php';

session_start();
ob_start();

$user_id = $_SESSION['user_id'];
//Resolver problema do preço
//Psso tentar tratar depois que recebo do formulário
try{ 
    
    $upgrade = filter_input_array(INPUT_POST, FILTER_DEFAULT);

 var_dump($upgrade);

if (!empty($upgrade['btncad'])) {

    $vazio = false;

    if (!$vazio) {
    $sql = "INSERT INTO products (prod_name, prod_photo, prod_price, prod_stock, prod_desc, prod_cat, prod_status,prod_shop)
    values(:name, :photo, :price,:stock, :desc, :cat, :status, $user_id)";

    $salvar= $conn ->prepare($sql);
    $salvar -> bindParam(':name', $upgrade['name'],PDO::PARAM_STR);
    $salvar -> bindParam(':photo', $upgrade['photo'],PDO::PARAM_STR);
    $salvar -> bindParam(':price', $upgrade['price'],PDO::PARAM_FLOAT);
    $salvar -> bindParam(':stock', $upgrade['stock'], PDO::PARAM_INT);
    $salvar -> bindParam(':desc', $upgrade['desc'], PDO::PARAM_STR);
    $salvar -> bindParam(':cat', $upgrade['cat'], PDO::PARAM_STR);
    $salvar -> bindParam(':status', $upgrade['status'], PDO::PARAM_STR);
    $salvar -> execute();


    if ($salvar->rowCount()) {
        
        echo "<script>
        alert('Produto cadastrado com sucesso!!');
        parent.location = '../cadprod';
        </script>";

        unset($upgrade);
    } else {
        echo "<script>
        alert('Produto não cadastrado. Tente novamente');
        parent.location = '../cadprod';
        </script>";
        
    }

}

}
if (!empty($upgrade['btnedit'])){
    
    $sql = "UPDATE products 
    set prod_name=:name, prod_photo=:photo, prod_price=:price, prod_stock=:stock, prod_desc=:desc, prod_cat=:cat, prod_status=:status, prod_shop=$user_id";

$salvar= $conn ->prepare($sql);
$salvar -> bindParam(':name', $upgrade['name'],PDO::PARAM_STR);
$salvar -> bindParam(':photo', $upgrade['photo'],PDO::PARAM_STR);
$salvar -> bindParam(':price', $upgrade['price'],PDO::PARAM_STR);
$salvar -> bindParam(':stock', $upgrade['stock'], PDO::PARAM_INT);
$salvar -> bindParam(':desc', $upgrade['desc'], PDO::PARAM_STR);
$salvar -> bindParam(':cat', $upgrade['cat'], PDO::PARAM_STR);
$salvar -> bindParam(':status', $upgrade['status'], PDO::PARAM_STR);
$salvar -> execute();


    if ($salvar->rowCount()) {
        
        echo "<script>
        alert('Produto atualizado com sucesso!!');
        parent.location = '../shop';
        </script>";

        unset($upgrade);
    } else {
        echo "<script>
        alert('Aluno não cadastrado!');
        parent.location = '../shop';
        </script>";
        
    }

}
}
catch(PDOException $erro){
    echo $erro;

}