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
  echo '<div class="alertCart" role="alert">
  <i class="fa-sharp fa-regular fa-face-frown" id="ialert"></i>
  <strong> Ooooooooooooops!</strong><br>
  Você ainda não tem produtos adicionados no carrinho...
  <a href="../navshops" class="nounderline"><button type="button" class="btnAlert">Adicionar produtos!</button></a>
 </div>';
  } else{
    /*tira o text-decoration dos botoes do bootstrap, coloca essa classe "nounderline" depois do a href e estliza no CSS*/


    $totalbuy=0;  /*total compra é acumulador então temos que criar a variável antes */

    ?>

<div class="tabcart">
   <form action="../checkout/index.php" method="post"> 
    <table class="table">
    <thead>
     <tr>
        <th scope="col">Imagem</th>
        <th class="align" scope="col">Nome</th>
        <th class="align" scope="col">Preço</th>
        <th class="align" scope="col">Quantidade</th>
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
          <td class="align"><?php echo $prod_name ?></td>
          <td class="align"><?php echo $prod_price ?></td>
          <td class="align"><?php echo $quant ?></td>
          <td ><?php echo $total = $quant * $prod_price; $totalbuy += $total; ?></td>
          <!--total compra é acumulador entao temos que criar a variavel antes-->
         
        <td>
        <a href="../../finalecart"><button type="submit" class="btn btn-danger" name="delete" value="<?php echo $prod_id; ?>">Excluir</button></a> 
<!--o while é repetição vai pegar todos os dados e ir colocando um botão de acordo com o produto, mudando para button e colocando a variável do codigo produto pra excluir exatamente o produto que estou clicando-->
          </td>
        </tr>        
         

<?php   
} ?>

<!--depois que fizer while é que mostro total da compra-->
<tr><td><?php echo "<strong>Total da compra - R$ </strong>".$totalbuy; ?></td></tr>
</tbody>
</table>

 <input type="hidden" name="totalbuy" value ="<?php echo $totalbuy?>">

<input type="submit" class="btn btn-success btn-lg btn-block" name="checkout" value="Finalizar Compra">
<br>
<input type="submit" class="btn btn-danger " name="deleteall" value="Esvaziar carrinho">
</form>
<br>
<a href="../navshops"><button type="button" class="btn btn-primary float-right btn-lg">Continuar Comprando</button></a>
</div>

<?php
  }

  ?>


<?php
require '../../includes/footer.php'
?>
