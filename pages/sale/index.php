<?php
require '../../includes/header.php';
include_once '../../includes/config.php';

$id = $_SESSION['user_id'];



//Pega o ID da compra do usuario
$sale= "SELECT sale_id FROM sale WHERE sale_client = $id";
    $resulsale = $conn->prepare($sale);
    $resulsale->execute();

?>
<!-- Conteudo -->
<h2 class='text-center'>Compras de <?php echo $_SESSION['user_name'];?></h2>
<div class="wrap">

<div class="container">
<div class="col-md-4">
 Conteudo legal pra colocar aqui
</div>
<div class="col-md-8">
<ul class="list-unstyled">
<?php

 if(($resulsale) AND ($resulsale->rowCount()!= 0)){
  //Coloquei no While porque pode ter mais de uma compra
  while($respsale = $resulsale->fetch(PDO::FETCH_ASSOC)){
  extract($respsale);

  //Procura os REQUESTS gerados pelas compras anteriores
  $req= "SELECT * FROM request WHERE req_sale = $sale_id";
  $resreq = $conn->prepare($req);
  $resreq->execute();

  if(($resreq) AND ($resreq->rowCount()!= 0)){
    //Novamente pode ter mais de um, logo, tem que ser no while
    while($request = $resreq->fetch(PDO::FETCH_ASSOC)){
    extract($request);
  

//Procura os produtos que estão nos requests
  $products = "SELECT * FROM products WHERE prod_id = $req_prod";
  $resprod = $conn->prepare($products);
  $resprod->execute();


if(($resprod) AND ($resprod->rowCount()!= 0)){
  //Como pode ter mais de um produto, dentro do WHILE novamente
  while($prod = $resprod->fetch(PDO::FETCH_ASSOC)){

  extract($prod);

?>

<li class="media"> <a target="_blank" <?php echo "href='../viewprod?id=$prod_id'"?>>
    <img class="mr-3" src="<?php 
    //Peguei do produto
    echo $prod_photo 
    ?>" alt="Imagem de <?php
     //Peguei do produto
     echo $prod_photo ?>" style=width:15rem;height:10rem;></a>
    <div class="media-body">
      <h5 class="mt-0 mb-1"> <?php 
      //Peguei do produto
      echo $prod_name ?></h5>
      Preço: $ <?php 
      //Peguei do pedido, porque o preço pode ter mudado, então coloquei o preço que ele comprou
      echo $req_value ?>
      <div>
      Quantidade: <?php 
      //Quantidade que ele comprou
      echo $req_quant ?>
  </div>

<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  Avalie Esse Produto:
</button>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    
  <form method="post" action="" >
         
        <label for="validationDefault01">O que achou desse produto: </label>
        <input name="comment" type="text" class="form-control" id="validationDefault01" placeholder="Sua mensagem aqui..." required>  
        
        <input type="hidden" name="prod" value="<?php echo $prod_id?>">
        <br>

        <input class="btn btn-primary" type="submit" value='Enviar' name='send' >
         
</form>

</div>
</div>
  </div>
  </li>
<?php
}

}
}
}
}
}
$contacts = filter_input_array(INPUT_POST, FILTER_DEFAULT);
// Se o formulário foi enviado:
  if (isset($_POST['send'])) :
    $vazio = false;
    $contacts = array_map('trim', $contacts);
    $date = date('y-m-d');

    if (!$vazio) {
     // Monta SQL para salvar contato no banco de dados:
    $sql = "INSERT INTO comments (com_date,produto,comment, com_name)VALUES(:date, :prod, :comment,:name)";

  $salvar= $conn ->prepare($sql);
  $salvar -> bindParam(':prod', $contacts['prod'],PDO::PARAM_INT);
  $salvar -> bindParam(':comment', $contacts['comment'],PDO::PARAM_STR);
  $salvar -> bindParam(':name', $_SESSION['user_name'], PDO::PARAM_STR);
  $salvar -> bindParam(':date', $date, PDO::PARAM_STR);
  $salvar -> execute();


  if ($salvar->rowCount()) {
      
      echo "<script>
      alert('Obrigado pela sua avaliação!');
      </script>";

      unset($contacts);
  } else {
      echo "<script>
      alert('Erro: Tente novamente');   
      </script>";
      
  }

}

// if (isset($_POST['send'])) :
endif;



?>
</ul>
 </div>
 </div>
 </div>

<?php
require '../../includes/footer.php'
?>