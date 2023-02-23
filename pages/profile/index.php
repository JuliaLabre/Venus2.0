<?php
require '../../includes/header.php';
include_once '../../includes/config.php';

if(!isset($_SESSION['user_name'])){
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">
  Erro: Necessário realizar login
 </div>';
  header("Location: ../login");
}
$user_id = $_SESSION['user_id'];
// Precisa continuar o login para navegação das páginas
?>
<h3 class='text-center'>Olá, <?php echo $_SESSION['user_name']?>, aqui é sua conta :) </h3>
<div class="wrap">
   
<div class="container">

<div class="col-md-4">
  <div class="row">
  <h4>Cliente desde: <?php echo $_SESSION['datebr']?></h4>
  </div>
  <div class="row">
  <i class="fa-solid fa-receipt fa-fw"></i> <a href="../sale">   Seus pedidos </a>

  </div>
  <div class="row">

  <i class="fa-solid fa-user-pen fa-fw"></i> <a <?php echo "href='../edituser?id=$user_id'"?> > Edite seus Dados</a>

</div>

<div class="row">

<i class="fa-solid fa-camera fa-fw"></i> <a <?php echo "href='../edituserft?id=$user_id'"?>> Edite sua foto </a>

</div>

<div class="row">

<i class="fa-solid fa-question fa-fw"></i> <a href="../faq" > Perguntas frequentes</a>

</div>
<div class="row">

<i class="fa-solid fa-lock fa-fw"></i> <a href="../policies"> Privacidade </a>

</div>

</div>

<div class="col-md-8">

ultima compra:

<?php
//Buscando a ultima compra por ordem de id 
$sale= "SELECT * 
FROM sale s INNER JOIN request r ON s.sale_id= r.req_sale
INNER JOIN delivery d ON s.sale_id=d.deli_sale
INNER JOIN products p ON r.req_prod=p.prod_id WHERE sale_client = $user_id ORDER BY sale_id DESC LIMIT 1";
    $resulsale = $conn->prepare($sale);
    $resulsale->execute();

?>
<ul class="list-unstyled">
                <?php

 if(($resulsale) AND ($resulsale->rowCount()!= 0)){
  //Coloquei no While porque pode ter mais de uma compra
  $respsale = $resulsale->fetch(PDO::FETCH_ASSOC);
  extract($respsale);


?>

    <li class="media"> <a target="_blank" <?php echo "href='../viewprod?id=$prod_id'" ?>>
      <img class="mr-3" src="<?php 
    //Peguei do produto
    echo $prod_photo 
    ?>" alt="Imagem de <?php
     //Peguei do produto
     echo $prod_photo ?>" style=width:15rem;height:10rem;></a>
                    <div class="media-body">
                        <h5 class="mt-0 mb-1">
                            <?php 
      //Peguei do produto
      echo $prod_name ?>
                        </h5>
                        Preço: $
                        <?php 
      //Peguei do pedido, porque o preço pode ter mudado, então coloquei o preço que ele comprou
      echo $req_value ?>
                        <div>
                            Quantidade:
                            <?php 
      //Quantidade que ele comprou
      echo $req_quant ?>
<br>
                            Status da entrega:
                            <?php
      echo $deli_status ?>
                        </div>

                    </div>
                </li>
                <?php
}

?>

<?php
//Buscando a ultima compra por ordem de id 
$sale= "SELECT * 
FROM favorite f 
INNER JOIN products p ON f.fav_prod=p.prod_id 
WHERE f.fav_user = $user_id ORDER BY fav_id DESC LIMIT 3";
    $resulsale = $conn->prepare($sale);
    $resulsale->execute();

?>
 <h4>Aproveite para comprar:</h4>
<div class="row">
 
                <?php

 if(($resulsale) AND ($resulsale->rowCount()!= 0)){
  //Coloquei no While porque pode ter mais de uma compra
  while($respsale = $resulsale->fetch(PDO::FETCH_ASSOC)){
  extract($respsale);


?>
<div>
    <a target="_blank" <?php echo "href='../viewprod?id=$prod_id'" ?>>
      <img class="mr-3" src="<?php echo $prod_photo ?>" alt="Imagem de <?php echo $prod_photo ?>" style=width:15rem;height:10rem;>
    </a>
  <h5><?php echo $prod_name ?></h5>

   <h5>Preço: $<?php echo $prod_price ?></h5>
   </div>                   
   
<?php
}

}
?>

</div>
</div>
</div>



<a href="../exit"><button type="submit" class="btn">Sair</button></a>
<!-- Footer -->
<?php
require '../../includes/footer.php'
?>