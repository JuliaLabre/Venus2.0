<?php

include_once '../../includes/config.php';

session_start();
ob_start();

//Recebe os dados do produto
$basket = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//quantidade que vem do produto retirado da array
$quantcart = $basket ["quant"];

//id do produto retirado da array
$prod_id = $basket ["prod_id"];

//Página anterior para referencia caso precise redirecionar e enviar alert
$pag = $_SERVER['HTTP_REFERER'] ;


//Faz a busca dos produtos para pegar as informações necessárias para adicionar ao carrinho
$busca= "SELECT * FROM products WHERE prod_id = $prod_id LIMIT 1";
$resultado = $conn->prepare($busca);
$resultado->execute();


//Se houve retorno da busca associa e extrai as linhas gerando uma variavel com o msm nome da coluna no banco 
if(($resultado)and($resultado->RowCount()!=0)) {
    $linha=$resultado->fetch(PDO::FETCH_ASSOC);
    extract($linha);

/* NÃO ESTÁ EXIBINDO Mas tbm não está adicionando nem no carinho nem no badge- 
Se a quantidade que a pessoa tentar adicionar ao carrinho for maior que a quantidade em estoque gera um alerta
Verificar um modo de mandar essa atualização
*/  

if($prod_stock<$quantcart){

        echo "<script>
            alert('Compra efetuada com sucesso!');
            parent.location = '$pag';
            </script>";

    }
    else {
        $update = "SELECT * FROM cart WHERE id_prod = $prod_id LIMIT 1";
        $resul = $conn->prepare($update);
        $resul->execute();
       
//Não estou conseguindo aumentar a quantidade, VERIFICAR
        if(($resul)and($resul->RowCount()!=0)) {
            $row=$resultado->fetch(PDO::FETCH_ASSOC);
        
            $cartupdate = "UPDATE cart SET quant = (quant + $quantcart) 
            WHERE id_prod = $prod_id ";
            $resultup = $conn->prepare($cartupdate);
            $resultup->execute();
            
 //quantidade que fica em cima da sacolinha acumulando com o que for adicionado
$_SESSION['qntcart']+=$quantcart;

         } else{
        $sql2 = "INSERT INTO cart(id_prod,quant,price)
        VALUES(:prod_id,:quant,:price)";
        $salvar2= $conn->prepare($sql2);
        $salvar2->bindParam(':prod_id', $prod_id, PDO::PARAM_INT);
        $salvar2->bindParam(':quant', $quantcart, PDO::PARAM_INT);
        $salvar2->bindParam(':price', $prod_price , PDO::PARAM_INT);
        $salvar2->execute();

        
 //quantidade que fica em cima da sacolinha acumulando com o que for adicionado
$_SESSION['qntcart']+=$quantcart;
            }

    }
    $pag = $_SERVER['HTTP_REFERER'] ;
    header("Location:$pag");


    
}




?>