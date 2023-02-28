<!-- Cabeçalho -->
<?php
require 'includes/header.php';
include_once 'includes/config.php';

//Buscando as lojas que existem no banco
$produtos = "SELECT *
FROM products WHERE prod_status = 'online' AND prod_stock > 0 ORDER BY RAND()";
$resultado = $conn->prepare($produtos);
$resultado->execute(); 

?>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img\venusshop.png" alt="Logotipo Venus Shop" style="width:100%;max-height:60rem;">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img\venusshop.png" alt="Logotipo Venus Shop" style="width:100%;max-height:60rem;">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img\venusshop.png" alt="Logotipo Venus Shop" style="width:100%;max-height:60rem;">
    </div>
  </div>
</div>

<!-- Entraria um carrossel legal falando sobre a Venus -->
<div class="wrap">
  <div class="container">
    <div class="col-md-9"> 
      <div class="row mb-4 d-flex" >
    


<?php


if(($resultado) AND ($resultado->rowCount()!= 0)){
while($resposta = $resultado->fetch(PDO::FETCH_ASSOC)){
extract($resposta);

?>
  <!-- O style dentro da div está limitando o card e dando margem pra não ficar agarrado, já que eu tirei o card-deck -->
  <div class="card bg-light text-center"  style="max-width:20rem;margin:1rem;">
      <a target="_blank" <?php echo "href='../../pages/viewprod?id=$prod_id'"?>>
      <img class="card-img-top" src="../../pages/photos/<?php echo $prod_photo ?>" alt="Imagem de <?php echo $prod_name ?>" style=width:100%;height:25rem; >
    </a>
        <div class="card-body">
        <h5 class="card-title"><?php echo $prod_name ?></h5>
        <p class="card-text"> <?php echo $prod_desc?> - R$<?php echo $prod_price ?>,00</p> 
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
      
    }else{
        $icon = '<i class="fa-regular fa-heart"></i>';
      }         
  
  ?> 
    <a <?php echo "href='../favorite?id=$prod_id'"?>><?php echo $icon ?> </a>
               
        <input type="submit" class="btn btn-primary" name="cart" value="Comprar">
        </form>
        </div>
    
  </div> 

 
<?php
}

}
?>
  </div>
  </div>
    <div class="col-md-3">
      <h5 class="text-center">Categorias</h5>
      <ul class="list-group">
        


<!-- E se as categorias entrassem como barras complementar tem que colocar numa div bonitinha ?? -->

<?php
//BUSCA DAS CATEGORIAS POR ORDEM ALFABETICA (CRESCENTE)
$sql = "SELECT * FROM category ORDER BY cat_name ASC";

$result= $conn->prepare($sql); 
$result->execute();

if(($result)&&($result->rowCount()!=0)) { 
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
            extract($linha);

?>                
       <a class="list-group-item"<?php echo "href='../../pages/category?id=$cat_id'"?>><?php echo $cat_name?></a>
<?php
        }
    }
?>

</ul>
  </div>
  </div>
  </div>




<?php
require 'includes/footer.php'
?>
