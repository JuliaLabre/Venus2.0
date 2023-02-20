<?php

require '../../includes/header.php';
include_once '../../includes/config.php';


//$id = $_SESSION['user_id'];



$busca= "SELECT *
    FROM cart c, products p WHERE
    p.prod_status = 'online' AND p.prod_stock > 0  AND c.id_prod = p.prod_id";
    $resultado = $conn->prepare($busca);
    $resultado->execute();

  

    $totalbuy=0;  /*total compra é acumulador então temos que criar a variável antes */

    ?>


   <form action="../finale/index.php" method="post"> 
    <table class="table">
    <thead>
     <tr>
        <th scope="col">Imagem</th>
        <th scope="col">Nome</th>
        <th scope="col">Preço</th>
        <th scope="col">Quantidade</th>
        <th scope="col">Total</th>       

     </tr>
    </thead>
 <tbody>

<?php
    while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
       
        extract($linha);      
       
    
?>        
        <tr>
          <td scope="row"><img src="<?php echo $prod_photo ?>"style=widht:100px;height:100px;></td>
          <td><?php echo $prod_name ?></td>
          <td><?php echo $prod_price ?></td>
          <td><?php echo $quant ?></td>
          <td><?php echo $total = $quant * $prod_price; $totalbuy += $total; ?></td>
          <!--total compra é acumulador entao temos que criar a variavel antes-->
         
        <td>
        <a href="../../finalecart"><button type="submit" class="btn btn-danger" name="excluir" value="<?php echo $prod_id; ?>">Excluir</button></a> 
<!--o while é repetição vai pegar todos os dados e ir colocando um botão de acordo com o produto, mudando para button e colocando a variável do codigo produto pra excluir exatamente o produto que estou clicando-->
          </td>
        </tr>        
         

<?php   
} ?>

<!--depois que fizer while é que mostro total da compra-->
<tr><td><?php echo "Total da compra - R$ ".$totalbuy; ?></td></tr>
</tbody>
</table>

<?php $_SESSION["totalcompra"]=$totalbuy ?>

<input type="submit" class="btn btn-primary" name="finalizar" value="Finalizar Compra"> 

<?php
// Se a pessoa não tiver logada mandar pra pagina de login e precisa voltar pra página em que estava antes assim que realizar o login
if (!isset($_SESSION['user_name'])) {
    $_SESSION["cart"] = true;
    $_SESSION['pagcart'] = $pag;
    echo "<script>
    alert('Faça login para adicionar produtos.');
    parent.location = '../../pages/login';
    </script>";     
}else{
    $user_id = $_SESSION['user_id'];
}
?>

<a href="../../index.php"><button type="button" class="btn btn-primary">Continuar Comprando</button></a>
</form>



