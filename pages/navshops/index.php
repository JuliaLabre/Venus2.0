<?php
include_once '../../includes/header.php';
include_once '../../includes/config.php';


$produtos = "SELECT * FROM shop WHERE shop_status = 'online' ";

$resultado = $conn->prepare($produtos);
$resultado->execute(); 

?>
<!-- Conteudo -->
<div class="wrap">
<h2 class='text-center'>Lojas na Venus</h2>

<div class="row">

<?php

if(($resultado) AND ($resultado->rowCount()!= 0)){
while($resposta = $resultado->fetch(PDO::FETCH_ASSOC)){

extract($resposta);
//não está aparecendo a foto
?>

<div class="col-md-2 text-center">
  <div class="card bg-light mb-2">
    <img class="card-img-top" src="../../pages/photoshop/<?php echo $shop_photo ?>" alt="Logo da <?php echo $shop_name ?>">
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
