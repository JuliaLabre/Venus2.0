<?php
    session_start();
    ob_start();

    include_once '../../includes/config.php';

    //Deleta o produto selecionado do carrinho
    if(isset($_POST["delete"])){

        $prod_id = $_POST["delete"];

        $sqldelete = "DELETE FROM cart WHERE id_prod = $prod_id";
        $resuldelete=$conn->prepare($sqldelete);
        $resuldelete->execute();
        $_SESSION["qntcart"]-=1;
        echo "<script>
        alert('Produto retirado do carrinho!');
        parent.location = '../frmcart';
        </script>";
    }

//Deleta todos os produtos do carrinho
    if(isset($_POST["deleteall"])){

        $prod_id = $_POST["deleteall"];

        $sqldelete = "DELETE FROM cart";
        $resuldelete=$conn->prepare($sqldelete);
        $resuldelete->execute();
        $_SESSION["qntcart"] = 0;
        echo "<script>
            alert('Carrinho esvaziado com sucesso!');
            parent.location = '/';
            </script>";
    }

//Botão que finaliza a compra - Não ta entrando aqui
    if(isset($_POST['checkout'])){
        
    //Verifica se pessoa não está logada 
        if(!isset($_SESSION['user_name'])){
            $_SESSION["cart"] = true;
            
            //Ele não está aceitando o redirecionamento de página
            /*echo "<script>
            alert('Faça login para finalizar sua compra!');
            parent.location = '../pages/login' ';
            </script>";*/

            echo "<a href = '../login'> Faça login para finalizar sua compra</a>";
            
            exit();
            
        }else{
            //acessar pagamento;
            $date = date('y-m-d');
            $value = $_POST['totalbuy'];
            //echo $value;
            $user_id = $_SESSION['user_id'];
            //var_dump ($user_id);

            

            $sqlsale = "INSERT INTO sale(sale_date,sale_value,sale_client)
            VALUES(:sale_date,:sale_value,:sale_client)";
            $salvarsale= $conn->prepare($sqlsale);
            $salvarsale->bindParam(':sale_date', $date, PDO::PARAM_STR);
            $salvarsale->bindParam(':sale_value', $value, PDO::PARAM_STR);
            $salvarsale->bindParam(':sale_client', $user_id, PDO::PARAM_STR);
            $salvarsale->execute();

            //busca o codigo da ultima venda pra inserir com o select
            $sale = "SELECT LAST_INSERT_ID() ";
            $resulsale =$conn->prepare($sale);
            $resulsale ->execute();
            
            $linhasale = $resulsale->fetch(PDO::FETCH_ASSOC);

            
            //criou variavel para nao ter que escrever tudo dnv
            $idsale = ($linhasale["LAST_INSERT_ID()"]);

            //Coloca o pedido para entrega
            $delivery = "INSERT INTO delivery(deli_sale,deli_date)VALUES($idsale,$date)";
            $resuldeli = $conn->prepare($delivery);
            $resuldeli->execute();


            //pegar tudo que está no carrinho pra salvar
            $busca ="SELECT * FROM cart";
            $resulbusca=$conn->prepare($busca);
            $resulbusca->execute();

            if(($resulbusca) && ($resulbusca->rowCount()!=0)){
                while ($linha = $resulbusca->fetch(PDO::FETCH_ASSOC)){
                    extract($linha);

                    $sqlorder = "INSERT INTO request(req_prod, req_sale, req_quant, req_value)VALUES(:req_prod,:req_sale,:req_quant,:req_value)";

                    $salvarorder= $conn->prepare($sqlorder);
                    $salvarorder->bindParam(':req_prod' , $id_prod, PDO::PARAM_INT);
                    $salvarorder->bindParam(':req_sale' , $idsale, PDO::PARAM_INT);
                    $salvarorder->bindParam(':req_quant' , $quant, PDO::PARAM_INT);
                    $salvarorder->bindParam(':req_value' , $price, PDO::PARAM_STR);
                    $salvarorder->execute();

                    $stock = "UPDATE products SET prod_stock=(prod_stock - $quant) 
                    WHERE prod_id = $id_prod ";
                    $atualiza=$conn->prepare($stock);
                    $atualiza->execute();

                     //limpar carrinho
                     $sqlclean = "DELETE FROM cart";
                     $clean= $conn->prepare($sqlclean);
                     $clean->execute();
                     $_SESSION["qntcart"] = 0; //limpa contagem do carrinho
                    echo "<script>
                    alert('Compra efetuada com sucesso!');
                    parent.location = '/index.php';
                    </script>";

                    unset($_SESSION['cart']);

                }

            }
           
        }
        
    }

?>