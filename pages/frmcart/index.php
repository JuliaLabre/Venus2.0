<?php

require '../../includes/header.php';
include_once '../../includes/config.php';


//$id = $_SESSION['user_id'];

//Se o usuario estiver logado, colocar no carrinho com o id dele - FAZER
//Acrescentar ou diminuir produtos no carrinho

$busca= "SELECT *
    FROM cart c, products p WHERE
    p.prod_status = 'online' AND p.prod_stock > 0  AND c.id_prod = p.prod_id";
    $resultado = $conn->prepare($busca);
    $resultado->execute();

  //Mensagem de não tem compras adicionadas no carrinho
  if(($resultado) AND ($resultado->rowCount() == 0)){
  echo '<div class="alert alert-warning" role="alert">
  <strong>Oooooooooooops!</strong> Você ainda não tem produtos adicionados no carrinho...
 </div>';
  } else{

    $totalbuy=0;  /*total compra é acumulador então temos que criar a variável antes */

    ?>

<div class="wrap">
   <form action="../checkout/index.php" method="post"> 
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
        <a href="../../finalecart"><button type="submit" class="btn btn-danger" name="delete" value="<?php echo $prod_id; ?>">Excluir</button></a> 
<!--o while é repetição vai pegar todos os dados e ir colocando um botão de acordo com o produto, mudando para button e colocando a variável do codigo produto pra excluir exatamente o produto que estou clicando-->
          </td>
        </tr>        
         

<?php   
} ?>

<!--depois que fizer while é que mostro total da compra-->
<tr><td><?php echo "Total da compra - R$ ".$totalbuy; ?></td></tr>
</tbody>
</table>

 <input type="hidden" name="totalbuy" value ="<?php echo $totalbuy?>">

<input type="submit" class="btn btn-success btn-lg btn-block" name="checkout" value="Finalizar Compra">
<br>
<input type="submit" class="btn btn-danger" name="deleteall" value="Esvaziar carrinho">
</form>
<br>
<a href="../navshops"><button type="button" class="btn btn-primary  btn-lg">Continuar Comprando</button></a>
</div>

<?php
  }

  ?>


<?php
require '../../includes/footer.php'
?>