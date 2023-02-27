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

    if(!isset($_SESSION['user_name'])){
      $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">
      Erro: Necessário realizar login
     </div>';
      header("Location: ../login");
    }
    $user_id = $_SESSION['user_id'];
    ?>
    <h3 class='cartname'>Olá, <?php echo $_SESSION['user_name']?>! Esse é o seu carrinho!</h3>
    <br>


<div class="wrap">
   <form action="../checkout/index.php" method="post"> 
    <table class="table table-responsive"> <!--table-responsive COLOCAR ESSA CLASSE E ESTILIZAR PRA TENTAR DEIXAR TABLE RESPONSIVE-->
            <thead>
     <tr>
        <th scope="col">Produto</th>
        <th scope="col">Nome</th>
        <th scope="col">Preço</th>
        <th scope="col">Quant</th>
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
          <td><?php echo "R$ ".$prod_price ?>,00</td>
          <td><?php echo $quant ?></td>
          <td ><?php echo "R$ ".$total = $quant * $prod_price; $totalbuy += $total; ?>,00</td>
          <!--total compra é acumulador entao temos que criar a variavel antes-->
         
        <td class="btnexc">
        <a href="../../finalecart"><button type="submit" class="btn-cartExcluir" data-toggle="tooltip" data-placement="bottom" title="Excluir" name="delete" value="<?php echo $prod_id; ?>"><i class="fa-regular fa-square-minus"></i></button></a> 
<!--o while é repetição vai pegar todos os dados e ir colocando um botão de acordo com o produto, mudando para button e colocando a variável do codigo produto pra excluir exatamente o produto que estou clicando-->
          </td>
        </tr>        
         

<?php   
} ?>
</tbody>
</table>

<!--depois que fizer while é que mostro total da compra-->
<tr><td><?php echo "<strong class='compratotal'>Total da compra - R$ ".$totalbuy; ?>,00</strong></td></tr>

<input type="hidden" name="totalbuy" value ="<?php echo $totalbuy?>">

<input  type="submit" class="btnfinal btn-custom" name="checkout"  value="Finalizar Compra" >

<a href="../navshops"><button type="button" class="btncontcompra btn-custom"><i class="fa-solid fa-cart-shopping"></i> Continuar Comprando</button></a>

<button type="submit" class="btnesvaziar" name="deleteall" value="Esvaziar carrinho"><i class="fa-regular fa-trash-can"></i> Esvaziar carrinho</button>

</form>
</div>

<?php
  }

  ?>


<?php
require '../../includes/footer.php'
?>