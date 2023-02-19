<?php
    session_start();
    ob_start();

    include_once '../../includes/config.php';

    //se exiiste excluir, vai criar variavel para excluir   
    if(isset($_POST["excluir"])){

        $prod_id = $_POST["excluir"];

        $sqlexcluir = "DELETE from cart where prod_id = $prod_id";
        $resulexcluir=$conn->prepare($sqlexcluir);
        $resulexcluir->execute();
        $_SESSION["cart"]-=1;
    }else{
        if(!isset($_SESSION['nome'])){
            $_SESSION["cart"] = true;
            echo "<script>
            alert('Faça login para finalizar sua compra!');
            parent.location = ''../pages/login.php'';
            </script>";
        }
        else{
            //acessar pagamento;
            $date = date('y-m-d');
            $value = $_SESSION['totalbuy'];
            //echo $value;
            $user_id = $_SESSION['user_id'];
            //var_dump ($user_id);

            

            $sqlsale = "INSERT into sale(sale_date,sale_value,sale_client)values(:sale_date,:sale_value,:sale_client)";
            $salvarsale= $conn->prepare($sqlsale);
            $salvarsale->bindParam(':sale_date', $sale_date, PDO::PARAM_STR);
            $salvarsale->bindParam(':sale_value', $sale_value, PDO::PARAM_STR);
            $salvarsale->bindParam(':sale_client', $sale_client, PDO::PARAM_STR);
            $salvarsale->execute();

            //busca o codigo da ultima venda pra inserir com o select
            $sale = "Select LAST_INSERT_ID()";
            $resulvenda=$conn->prepare($sale);
            $resulsale->execute();

            $linhasale = $resulsale->fetch(PDO::FETCH_ASSOC);

            
            //criou variavel para nao ter que escrever tudo dnv
            $idsale = ($linhasale["LAST_INSERT_ID()"]);

            //pegar tudo que está no carrinho pra salvar
            $busca ="select * from cart";
            $resulbusca=$conn->prepare($busca);
            $resulbusca->execute();

            if(($resulbusca) && ($resulbusca->rowCount()!=0)){
                while ($linha = $resulbusca->fetch(PDO::FETCH_ASSOC)){
                    extract($linha);

                    $sqlorder = "insert into item(order_prod,order_sale,order_quant,order_value)
                    values(:order_prod,:order_sale,:order_quant,:order_value)";
                    $salvarorder= $conn->prepare($sqlitem);
                    $salvarorder->bindParam(':order_prod', $order_prod, PDO::PARAM_INT);
                    $salvarorder->bindParam(':order_sale', $order_sale, PDO::PARAM_INT);
                    $salvarorder->bindParam(':order_quant', $order_quant, PDO::PARAM_INT);
                    $salvarorder->bindParam(':order_value', $order_value, PDO::PARAM_STR);
                    $salvarorder->execute();

                    $stock = "UPDATE products set prod_stock=(prod_stock - $quant) 
                    where prod_id = $prod_id ";
                    $atualiza=$conn->prepare($stock);
                    $atualiza->execute();

                }
            }
        }
        //limpar carrinho
        $sqlclean = "delete from cart";
        $clean= $conn->prepare($sqlclean);
        $clean->execute();
        $_SESSION["cart"] = 0; //limpa contagem do carrinho
            echo "<script>
            alert('Compra efetuada com sucesso!');
            parent.location = '/index.php';
            </script>";

      //  header("Location:/index.php");  
    }



    ?>