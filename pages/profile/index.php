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
<h3 class='text-center'>Olá,
    <?php echo $_SESSION['user_name']?>, aqui é sua conta :)
</h3>
<div class="wrap">

    <div class="container">

        <div class="col-md-4">
            <div class="row" style="padding:1rem;">
                <a href="../sale" style="width:100%" class="list-group-item"><i class="fa-solid fa-receipt fa-fw"></i>
                    &nbsp; Seus pedidos </a>

            </div>
            <div class="row" style="padding:1rem;">

                <a style="width:100%" <?php echo "href='../edituser?id=$user_id'" ?> class="list-group-item"><i
                        class="fa-solid fa-user-pen fa-fw"></i> &nbsp; Edite seus Dados</a>

            </div>

            <div class="row" style="padding:1rem;">

                <a style="width:100%" <?php echo "href='../edituserft?id=$user_id'" ?> class="list-group-item"><i
                        class="fa-solid fa-camera fa-fw"></i> &nbsp; Edite sua foto </a>

            </div>
            <div class="row" style="padding:1rem;">

    <a style="width:100%" <?php echo "href='../frmfavorite'" ?> class="list-group-item"><i class="fa-solid fa-heart fa-fw"></i> &nbsp; Seus Favoritos </a>

</div>

            <div class="row" style="padding:1rem;">

                <a style="width:100%" href="../faq" class="list-group-item"><i class="fa-solid fa-question fa-fw"></i>
                    &nbsp; Perguntas frequentes</a>

            </div>
            <div class="row" style="padding:1rem;">

                <a href="../policies" style="width:100%" class="list-group-item"><i class="fa-solid fa-lock fa-fw"></i>
                    &nbsp; Privacidade </a>
            </div>

            <div class="row" style="background-color: lightblue; border-left: .3rem solid blue; padding:1rem;">
                <p style="width:100%">Cliente desde:
                <?php echo $_SESSION['datebr']?></p>
            </div>



        </div>

        <div class="col-md-8" >
        <div class="row list-group-item d-flex" style="padding:1rem; margin-left:.5rem; ">

            <p>Último pedido:</p>

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
      echo $deli_status; 
      if(($deli_status == "Em Separação")){     

        ?>
        <br>
        <button type="submit" class="btn btn-danger btn-sm">Cancelar Compra</button>
        <?php
      } if(($deli_status == "Em Trânsito" )){
        ?>
        <br>
        <button type="submit" class="btn btn-success btn-sm">Produto Entregue</button>
        <button type="submit" class="btn btn-danger btn-sm">Cancelar Compra</button>
        <?php
      }if(($deli_status == "Entregue" )){
        ?>
        <br>
        <button type="submit" class="btn btn-success btn-sm">Avaliar Compra</button>
        <button type="submit" class="btn btn-danger btn-sm">Trocas ou Reclamações</button>
        <?php
      }
      ?>

                        </div>

                    </div>
                </li>
                </div>
                
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
                <br><h4 class="text-center">Aproveite para comprar:</h4>
                <div class="row d-flex justify-content-around text-center" style="margin-left:.5rem;padding:1rem;">

                    <?php

 if(($resulsale) AND ($resulsale->rowCount()!= 0)){
  //Coloquei no While porque pode ter mais de uma compra
  while($respsale = $resulsale->fetch(PDO::FETCH_ASSOC)){
  extract($respsale);


?>
                   <div style="padding:.5rem;" class="list-group-item">
                            <a target="_blank" <?php echo "href='../viewprod?id=$prod_id'" ?>>
                                <img src="<?php echo $prod_photo ?>" alt="Imagem de <?php echo $prod_photo ?>"
                                    style=width:15rem;height:10rem;>
                            </a>
                            <h5>
                                <?php echo $prod_name ?>
                            </h5>
    
                            <h5>Preço: $
                                <?php echo $prod_price ?>
                            </h5>
                        </div>

                    <?php
}

}else{
  $product= "SELECT * FROM products WHERE prod_status = 'online' AND prod_stock > 0 ORDER BY prod_id DESC LIMIT 3";
    $resul = $conn->prepare($product);
    $resul->execute();

    if(($resul) AND ($resul->rowCount()!= 0)){
      //Coloquei no While porque pode ter mais de uma compra
      while($resp = $resul->fetch(PDO::FETCH_ASSOC)){
      extract($resp);
    
    
    ?>
                        <div style="padding:.5rem;">
                            <a target="_blank" <?php echo "href='../viewprod?id=$prod_id'" ?>>
                                <img src="<?php echo $prod_photo ?>" alt="Imagem de <?php echo $prod_photo ?>"
                                    style=width:15rem;height:10rem;>
                            </a>
                            <h5>
                                <?php echo $prod_name ?>
                            </h5>
    
                            <h5>Preço: $
                                <?php echo $prod_price ?>
                            </h5>
                        </div>
    
                        <?php
    }
  }
}
?>

                </div>
        </div>
    </div>
    
<br>
    <a href="../exit"><button type="submit" class="btn">Sair</button></a>
</div>
    <!-- Footer -->
    <?php
require '../../includes/footer.php'
?>