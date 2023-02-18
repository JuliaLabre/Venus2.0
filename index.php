<!-- Cabeçalho -->
<?php
require 'includes/header.php';
include_once 'includes/config.php';

//Buscando as lojas que existem no banco
$produtos = "SELECT * FROM shop WHERE shop_status = 'online' ";
$resultado = $conn->prepare($produtos);
$resultado->execute(); 

?>
<!-- Colocar produtos mais comprados -->
<h2 class='text-center'>Lojas na Venus</h2>
  <div class="container">
    <div class="col-md-10 ">
    <div class="card-deck">

<?php

if(($resultado) AND ($resultado->rowCount()!= 0)){
while($resposta = $resultado->fetch(PDO::FETCH_ASSOC)){

extract($resposta);
//não está aparecendo a foto
?>
  <div class="card bg-light text-center">
    <img class="card-img-top" style=width:100%;height:25rem; src="../../pages/photoshop/<?php echo $shop_photo ?>" alt="Logo da <?php echo $shop_name ?>">
    <div class="card-body">
        <h4 class="card-title"><strong><?php echo $shop_name ?></strong></h4>
        <p class="card-text"> <?php echo $shop_desc?>
        <a <?php echo "href='../../pages/shopping?id=$shop_id'"?>><button type="submit" class="btn">Conheça essa loja</button></a>    
    </div>
  </div>

<?php
}

}
?>
    </div>
  </div>
    <div class="col-md-2">
      <h5>Categorias</h5>
      <ul>


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
       <li><a <?php echo "href='../../pages/category?id=$cat_id'"?>><?php echo $cat_name?></a></li>
<?php
        }
    }
?>

</ul>
  </div>
  </div>





<?php
require 'includes/footer.php'
?>
