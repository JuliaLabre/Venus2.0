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

<div class="card-deck text-center">

<?php

if(($resultado) AND ($resultado->rowCount()!= 0)){
while($resposta = $resultado->fetch(PDO::FETCH_ASSOC)){

extract($resposta);
//não está aparecendo a foto
?>

<div class="card bg-secondary w-25 p-3 col-md-2">
  <div class="card bg-light mb-2">
  <a <?php echo "href='../../pages/shopping?id=$shop_id'"?>><img class="card-img-top" style=width:100%;height:25rem; src="../../pages/photoshop/<?php echo $shop_photo ?>" alt="Logo da <?php echo $shop_name ?>"></a>
    <div class="card-body">
        <h4 class="card-title"><strong><?php echo $shop_name ?></strong></h4>
        <p class="card-text"> <?php echo $shop_desc?>    
    </div>
    
  </div>
  <a <?php echo "href='../../pages/shopping?id=$shop_id'"?>><button type="submit" class="btn">Conheça essa loja</button></a>
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
