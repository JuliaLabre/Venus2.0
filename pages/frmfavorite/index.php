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
<div class="wrap">

<div class="container">
<div class="col-md-4">
 Conteudo legal pra colocar aqui
</div>
<div class="col-md-8">
<ul class="list-unstyled">
<?php

if(($resultado) AND ($resultado->rowCount()!= 0)){
  while($resposta = $resultado->fetch(PDO::FETCH_ASSOC)){

  extract($resposta);

?>

<li class="media">
    <img class="mr-3" src="<?php echo $prod_photo ?>" alt="Imagem de <?php echo $prod_photo ?>" style=width:15rem;height:10rem;>
    <div class="media-body">
      <h5 class="mt-0 mb-1"> <?php echo $prod_name ?></h5>
      $<?php echo $prod_price ?>
      <div>
      <?php echo $prod_desc ?>
  </div>
      <?php echo "<a href='../cart?id=$prod_id'>"; ?>
      <input type="submit" class="btn btn-success" name="cart" value="Adicionar ao carrinho">
  </a>
      <?php echo "<a href='../favorite?id=$prod_id'>" ?>
      <input type="submit" class="btn btn-danger" name="delete" value="Remover dos favoritos">
  </a>
    </div>
  </li>

  

  <?php
  }

}
?>
</ul>
 </div>
 </div>
 </div>

<?php
require '../../includes/footer.php'
?>