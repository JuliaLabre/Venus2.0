<?php
require '../../includes/header.php';
include_once '../../includes/config.php';

$id = $_SESSION['user_id'];

$busca= "SELECT *
    FROM favorite f, products p  WHERE 
    f.fav_user = $id AND
    p.prod_status = 'online' AND p.prod_stock > 0  AND f.fav_prod = p.prod_id";

    $resultado = $conn->prepare($busca);
    $resultado->execute(); 

?>
<!-- Conteudo -->

<h2 class='text-center'>Favoritos de <?php echo $_SESSION['user_name'];?></h2>

<div class="row">
<?php

if(($resultado) AND ($resultado->rowCount()!= 0)){
  while($resposta = $resultado->fetch(PDO::FETCH_ASSOC)){

  extract($resposta);

?>
    <div class="col-md-2 text-center">
      <div class="card bg-light mb-2">
        <img class="card-img-top" src="<?php echo $prod_photo ?>" alt="Imagem de capa do card">
        <div class="card-body">
        <h5 class="card-title"><?php echo $prod_name ?></h5>
        <p class="card-text"> <?php echo $prod_desc?> - R$<?php echo $prod_price ?>,00</p> 
        <form method="post" action="carrinho.php">
        <h6>   
        <label>Quant</label>
        <input type="number" name="quantcompra" value="1" style=width:45px;>
        </h6> 
        <input type="hidden" value="<?php echo $prod_id ?>" name="codigoproduto">
        <a <?php echo "href='../favorite?id=$prod_id'" ?>><i class="fa-regular fa-heart"></i></a>            
        <input type="submit" class="btn btn-primary" name="carrinho" value="Comprar">
        </form>
        </div>
      </div>
  </div> 

  <?php
  }

}
?>
 </div>

<?php
require '../../includes/footer.php'
?>