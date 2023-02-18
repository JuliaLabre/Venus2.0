<?php
require '../../includes/header.php';
include_once '../../includes/config.php';


$postsearch = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$search = $postsearch['search'];

//barra de pesquise
//Colocar a pesquisa com o nome de categoria, nome de produto e nome de loja - tentar fazer separado as pesquisas e imprimir separado tbm
//Colocar alguma coisa se não retornar produtos


$products= "SELECT *
FROM products  WHERE 
prod_name like '%$search%' AND
prod_status = 'online' AND prod_stock > 0";

$resulprod = $conn->prepare($products);
$resulprod->execute(); 

$shopp= "SELECT *
FROM shop  WHERE 
shop_name like '%$search%' AND
shop_status = 'online' ";

$resulshop = $conn->prepare($shopp);
$resulshop->execute(); 


?>
<!-- Conteudo -->

<h2 class='text-center'><i class="fa-solid fa-wand-magic-sparkles"></i><?php echo $search?></h2>
<div class="wrap">
<div class="card-deck text-center">
<?php

if(($resulprod) AND ($resulprod->rowCount()!= 0)){
while($resprod = $resulprod->fetch(PDO::FETCH_ASSOC)){

extract($resprod);

?>


  <div class="card bg-light w-25 p-3 col-md-2">
    <img class="card-img-top" src="<?php echo $prod_photo ?>" alt="Imagem de <?php echo $prod_name ?>" style=width:100%;height:25rem;>
    <div class="card-body">
    <h5 class="card-title"><?php echo $prod_name ?></h5>
    <p class="card-text"> <?php echo $prod_desc?> - R$<?php echo $prod_price ?>,00</p> 
    <form method="post" action="carrinho.php">
    <h6>   
    <label>Quant</label>
    <input type="number" name="quantcompra" value="1" style=width:45px;>
    </h6> 
    <input type="hidden" value="<?php echo $prod_id ?>" name="codigoproduto">
    
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
               
        <input type="submit" class="btn btn-primary" name="carrinho" value="Comprar">
        </form>
        </div>
      </div>
          
    

<?php
}

}

if(($resulshop) AND ($resulshop->rowCount()!= 0)){
while($resshop = $resulshop->fetch(PDO::FETCH_ASSOC)){

extract($resshop);

?>

<div class="card bg-light w-25 p-3 col-md-2">
  <div class="card bg-secundary mb-2">
    <img class="card-img-top" src="../../pages/photoshop/<?php echo $shop_photo ?>" alt="Logo da <?php echo $shop_name ?>" style=width:100%;height:25rem;>
    <div class="card-body">
        <h4 class="card-title"><strong><?php echo $shop_name ?></strong></h4>
        <p class="card-text"> <?php echo $shop_desc?>
        <a <?php echo "href='../../pages/shopping?id=$shop_id'"?>><button type="submit" class="btn">Conheça essa loja</button></a>
    </div>
  </div>
</div> 

<?php
}

}
?>
</div>
</div>


<?php
require '../../includes/footer.php'
?>