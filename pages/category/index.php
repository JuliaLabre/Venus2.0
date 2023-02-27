<?php
include_once '../../includes/header.php';
include_once '../../includes/config.php';

//pra ficar respondivo e bonito tem que entrar a class col-md-2 no card quando atinge uma determinada largura.

$pagatual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$icon = '<i class="fa-regular fa-heart"></i>';

$sql = "SELECT * FROM category WHERE cat_id = $id";
$resultado = $conn->prepare($sql);
$resultado->execute();


if(($resultado) AND ($resultado->rowCount()!= 0)){
  $resposta = $resultado->fetch(PDO::FETCH_ASSOC);
  extract($resposta);
  }
     
    $busca= "SELECT *
    FROM products  WHERE 
    prod_cat = $id AND
    prod_status = 'online' AND prod_stock > 0";

    $resultado = $conn->prepare($busca);
    $resultado->execute(); 

?>
<!-- Conteudo -->
<h2 class='text-center'><?php echo $cat_name?></h2>
<div class="wrap">
<div class="container-fluid">
    <div class="col-md-12 "> 
<div class="card-deck ">
<?php

if(($resultado) AND ($resultado->rowCount()!= 0)){
  while($resposta = $resultado->fetch(PDO::FETCH_ASSOC)){

  extract($resposta);

?>
    
      <div class="card bg-light text-center" style=max-width:27rem;>
        <a target="_blank" <?php echo "href='../viewprod?id=$prod_id'"?>><img class="card-img-top img-fluid" src="<?php echo $prod_photo ?>" alt="Imagem de <?php echo $prod_name ?>" style=width:100%;height:25rem;></a>
        <div class="card-body">
        <h5 class="card-title"><?php echo $prod_name ?></h5>
        <p class="card-text">R$<?php echo $prod_price ?>,00</p> 
        <form method="post" action="../../pages/cart/index.php">
        <h6>   
        <label>Quant</label>
        <input type="number" name="quant" value="1" style=width:45px;>
        </h6> 
        <input type="hidden" value="<?php echo $prod_id ?>" name="prod_id">
        <?php


  // Se o usuario tiver logado e tiver esse produto como favorito:
  if (isset($_SESSION['user_name'])) {
    $iduser = $_SESSION['user_id'];

    $buscafav= "SELECT * FROM favorite WHERE fav_prod = $prod_id AND fav_user = $iduser LIMIT 1";  
      $resulfav = $conn->prepare($buscafav);
      $resulfav->execute();      

      if (($resulfav) and ($resulfav->rowCount() != 0)) {         
          $icon = '<i class="fa-solid fa-heart"></i>';    
       
      }else{
        $icon = '<i class="fa-regular fa-heart"></i>';
      }     
    
  }
  ?> 
    <a <?php echo "href='../favorite?id=$prod_id'"?>><?php echo $icon ?> </a>            
        <input type="submit" class="btn btn-primary" name="cart" value="Comprar">
        </form>
        </div>
      
  </div> 

  <?php
  }

}else{
echo '<div class="alert alert-warning" role="alert">
  <strong>Oooooooooooops!</strong> Ainda não temos produtos dessa categoria...
 </div>';
}
?>
 </div>
 </div>
  </div>
  
<!-- Footer -->
<?php
include_once '../../includes/footer.php'
?>
