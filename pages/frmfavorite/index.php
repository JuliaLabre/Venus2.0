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
<h2 class='text-center'>Favoritos de
  <?php echo $_SESSION['user_name'];?>
</h2>
<div class="wrap">
  <div class="container">
    <div class="col-md-4">
      <?php
$shops = "SELECT * FROM shop WHERE shop_status = 'online' ORDER BY RAND() LIMIT 3";

$result = $conn->prepare($shops);
$result->execute(); 

if(($result) AND ($result->rowCount()!= 0)){
while($respost = $result->fetch(PDO::FETCH_ASSOC)){
extract($respost);

?>

        <div class="card bg-light text-center" 
          style="outline-color: gray; outline-style: outset; max-width:20rem; margin:1rem;">
          <a <?php echo "href='../../pages/shopping?id=$shop_id'" ?>><img class="card-img-top img-fluid"
              style="width:100%;height:18rem;" src="../../pages/photoshop/<?php echo $shop_photo ?>"
              alt="Logo da <?php echo $shop_name ?>"></a>
          <div class="card-body">
            <h4 class="card-title"><strong>
                <?php echo $shop_name ?>
              </strong></h4>
            <p class="card-text">
              <?php echo $shop_desc?>
              <a class="align-content-md-end" <?php echo "href='../../pages/shopping?id=$shop_id'" ?>><button
                  type="submit" class="btn ">Conheça essa loja</button></a>
          </div>

        </div>

        <?php
}

}

?>
      </div>
  <div class="col-md-8">
    <?php

if(($resultado) AND ($resultado->rowCount()!= 0)){
  while($resposta = $resultado->fetch(PDO::FETCH_ASSOC)){

  extract($resposta);

?>
<div class="row list-group-item"  style="margin:1rem;padding:1rem;">
      <li class="media">
        <img class="align-self-end mr-3" src="<?php echo $prod_photo ?>" alt="Imagem de <?php echo $prod_photo ?>"
          style=width:15rem;height:10rem;>
        <div class="media-body">
          <h5 class="mt-0 mb-1">
            <?php echo $prod_name ?>
          </h5>
          $
          <?php echo $prod_price ?>
          <div>
            <?php echo $prod_desc ?>
          </div>
          <?php echo "<a href='../cart?id=$prod_id'>"; ?>
          <input type="submit" class="btn btn-success btn-sm" name="cart" value="Adicionar ao carrinho">
          </a>
          <?php echo "<a href='../favorite?id=$prod_id'>" ?>
          <input type="submit" class="btn btn-danger btn-sm" name="delete" value="Remover dos favoritos">
          </a>
        </div>
      </li>
      </div>
      <?php
  }

}else{
  echo '<div class="alertCart" role="alert">
  <i class="fa-sharp fa-regular fa-face-frown" id="ialert"></i>
  <strong> Ooooooooooooops!</strong><br>
  Você ainda não tem produtos adicionados nos favoritos...
  <a href="../navshops" class="nounderline"><button type="button" class="btnAlert">Adicionar produtos!</button></a>
 </div>';
}
?>

  </div>
</div>
</div>


<?php
require '../../includes/footer.php'
?>