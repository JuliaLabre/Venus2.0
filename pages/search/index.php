<?php
require '../../includes/header.php';
include_once '../../includes/config.php';

$postsearch = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$search = $postsearch['search'];

//barra de pesquise
//Colocar a pesquisa com o nome de categoria, nome de produto e nome de loja - tentar fazer separado as pesquisas e imprimir separado tbm
//Colocar alguma coisa se não retornar produtos

if(!isset ($search)){

  echo "<script>
  alert('Oooooooooooops!Tente pesquisar novamente ...');
  parent.location = '/'

  </script>";
}
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

<h2 class='text-center'><i class="fa-solid fa-wand-magic-sparkles"></i>
    <?php echo $search?>
</h2>
<div class="wrap">
<div class="container">
    <div class="col-md-9"> 
      <div class="row mb-4 d-flex" >
                <?php

if(($resulprod) AND ($resulprod->rowCount()!= 0)){
while($resprod = $resulprod->fetch(PDO::FETCH_ASSOC)){

extract($resprod);

?>


                <div class="card bg-light text-center" style=max-width:24rem;margin:1rem;>
                    <a target="_blank" <?php echo "href='../viewprod?id=$prod_id'" ?>><img class="card-img-top"
                            src="<?php echo $prod_photo ?>" alt="Imagem de <?php echo $prod_name ?>"
                            style=width:100%;height:25rem;></a>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $prod_name ?>
                        </h5>
                        <p class="card-text">
                            <?php echo $prod_desc?> - R$
                            <?php echo $prod_price ?>,00
                        </p>
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
                            <a <?php echo "href='../favorite?id=$prod_id'" ?>>
                                <?php echo $icon ?>
                            </a>

                            <input type="submit" class="btn btn-primary" name="cart" value="Comprar">
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

<div class="card bg-light text-center" style="outline-color: gray; outline-style: outset; max-width:24rem;margin-left:2rem;">
  <a <?php echo "href='../../pages/shopping?id=$shop_id'"?>><img class="card-img-top img-fluid" style=width:100%;height:25rem; src="../../pages/photoshop/<?php echo $shop_photo ?>" alt="Logo da <?php echo $shop_name ?>"></a>
    <div class="card-body">
        <h4 class="card-title"><strong><?php echo $shop_name ?></strong></h4>
        <p class="card-text"> <?php echo $shop_desc?> <br>
        <a class="align-content-md-end"<?php echo "href='../../pages/shopping?id=$shop_id'"?>><button type="submit" class="btn ">Conheça essa loja</button></a>   
    </div>
    
  </div>
            
            <?php
}

}

if(($resulprod->rowCount()== 0) AND ($resulshop->rowCount()== 0)){
  echo '<div class="alert alert-warning" role="alert">
  <strong>Oooooooooooops!</strong> Não encontramos nada com esse nome...
 </div>';
}
?>
        </div>
    </div>
</div>
</div>



<?php
require '../../includes/footer.php'
?>