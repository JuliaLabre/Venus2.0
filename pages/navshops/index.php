<?php
include_once '../../includes/header.php';
include_once '../../includes/config.php';


$produtos = "SELECT * FROM shop WHERE shop_status = 'online' ";

$resultado = $conn->prepare($produtos);
$resultado->execute(); 

?>
<!-- Conteudo -->
<h2 class='text-center'>Lojas na Venus</h2>
<div class="wrap">
<div class="container">
      <div class="row mb-4 d-flex" >

<?php

if(($resultado) AND ($resultado->rowCount()!= 0)){
while($resposta = $resultado->fetch(PDO::FETCH_ASSOC)){

extract($resposta);


?>


  <div class="card bg-light text-center" style="outline-color: gray; outline-style: outset; max-width:24rem;margin:1rem;">
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

?>
</div>
</div>
</div>



<?php
require '../../includes/footer.php'
?>
