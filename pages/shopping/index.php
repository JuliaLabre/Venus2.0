<?php
include_once '../../includes/header.php';
include_once '../../includes/config.php';

//ao invés depaginação. colocar aquele mostrar mais para colocar mais produtos... 
//a paginação acho que não vai funcionar no sosso caminho, pq já estamos usando a rota pra definir a loja 

$pagatual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$pag = (!empty($pagatual)) ? $pagatual : 1;

$sql = "SELECT * FROM shop WHERE shop_id = $id";
$resultado = $conn->prepare($sql);
$resultado->execute();

if(($resultado) AND ($resultado->rowCount()!= 0)){
  $resposta = $resultado->fetch(PDO::FETCH_ASSOC);
  extract($resposta);
  
}

    $limitereg = 10;

    $inicio = ($limitereg * $pag) - $limitereg;

  
    $busca= "SELECT *
    FROM products  WHERE 
    shop = $id AND
    prod_status = 'online' AND prod_stock > 0 LIMIT $inicio , $limitereg";

    $resultado = $conn->prepare($busca);
    $resultado->execute(); 


    $contacts = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//precisa ser a loja o address 
// Se o formulário foi enviado:
if (isset($_POST['send'])) :
    $vazio = false;
    $contacts = array_map('trim', $contacts);
    //var_dump($contacts);

    if (!$vazio) {
     // Monta SQL para salvar contato no banco de dados:
    $sql = "INSERT INTO contactshop (name, email, subject, message,address)VALUES(:name,:email,:subject,:message,:address)";

  $salvar= $conn ->prepare($sql);
  $salvar -> bindParam(':name', $contacts['name'],PDO::PARAM_STR);
  $salvar -> bindParam(':email', $contacts['email'],PDO::PARAM_STR);
  $salvar -> bindParam(':subject', $contacts['subject'], PDO::PARAM_STR);
  $salvar -> bindParam(':message', $contacts['message'], PDO::PARAM_STR);
  $salvar -> bindParam(':address', $contacts['address'], PDO::PARAM_INT);
  $salvar -> execute();


  if ($salvar->rowCount()) {
      
      echo "<script>
      alert('Seu contato foi enviado com sucesso. Obrigado...');
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
<!-- Conteudo -->
<div class="container">
  <div class="col-md-6">
<h2><img src="<?php echo $shop_photo ?>" style=width:150px;> <?php echo $shop_name?></h2>
</div>

<div class="col-md-6">
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
   Faça contato com <?php echo $shop_name?>
  </button>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    
  <form method="post" action="" >
        <label for="validationDefault01">Nome</label>
        <input name="name" type="text" class="form-control" id="validationDefault01" placeholder="Nome" required>
 
        <label for="validationDefaultUsername">Email</label>
        <input name="email" type="email" class="form-control" id="validationDefaultUsername" placeholder="Email"  aria-describedby="inputGroupPrepend2" required>
        

         <label for="validationDefault01">Assunto</label>
        <input name="subject" type="text" class="form-control" id="validationDefault01" placeholder="Assunto" required >
 
        <label for="validationDefault01">Mensagem</label>
        <input name="message" type="text" class="form-control" id="validationDefault01" placeholder="Sua mensagem aqui..." required>  
        
        <input type="hidden" name="address" value="<?php echo $id?>">
        <br>

        <input class="btn btn-primary" type="submit" value='Enviar' name='send' >
         
</form>

</div>
</div>
</div>
</div>


<div class="wrap">
<div class="card-deck text-center">


<?php

if(($resultado) AND ($resultado->rowCount()!= 0)){
  while($resposta = $resultado->fetch(PDO::FETCH_ASSOC)){

  extract($resposta);

?>
<!-- a classe col-md-2 funciona muito bem para telas grandes, mas em telas menores está uma porcaria -->
      <div class="card bg-light w-25 p-3 col-md-2">
      <a target="_blank" <?php echo "href='../viewprod?id=$prod_id'"?>><img class="card-img-top" src="<?php echo $prod_photo ?>" alt="Imagem de <?php echo $prod_name ?>" style=width:100%;height:25rem; ></a>
        <div class="card-body">
        <h5 class="card-title"><?php echo $prod_name ?></h5>
        <p class="card-text"> <?php echo $prod_desc?> - R$<?php echo $prod_price ?>,00</p> 
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
    <a <?php echo "href='../favorite?id=$prod_id'"?>><?php echo $icon ?> </a>
               
        <input type="submit" class="btn btn-primary" name="cart" value="Comprar">
        </form>
        </div>
    
  </div> 

  <?php
  }

}
?>
 </div>










 
 <?php
//Contar os registros no banco
    $qtregistro = "SELECT COUNT(prod_id) AS registros FROM
    products WHERE 
    shop = $id AND prod_status = 'online' AND prod_stock > 0 ";  
     $resultado = $conn->prepare($qtregistro);
     $resultado->execute();
     $resposta = $resultado->fetch(PDO::FETCH_ASSOC);

     //Quantidade de página que serão usadas - quantidade de registros
     //dividido pela quantidade de registro por página
     $qnt_pagina = ceil($resposta['registros'] / $limitereg);

      // Maximo de links      
      $maximo = 2;

      echo "<a href='../shopping?page=1'>Primeira</a> ";
    // Chamar página anterior verificando a quantidade de páginas menos 1 e 
    // também verificando se já não é primeira página
    for ($anterior = $pag - $maximo; $anterior <= $pag - 1; $anterior++) {
        if ($anterior >= 1) {
            echo "  <a href='../shopping?page=$anterior'>$anterior</a> ";
        }
    }

    //Mostrar a página ativa
    echo "$pag";

    //Chamar próxima página, ou seja, verificando a página ativa e acrescentando 1
    // a ela
    for ($proxima = $pag + 1; $proxima <= $pag + $maximo; $proxima++) {
        if ($proxima <= $qnt_pagina) {
            echo "<a href='../shopping?page=$proxima'>$proxima</a> ";
        }
    }

    echo "<a href='../shopping?page=$qnt_pagina'>Última</a> ";


?>
</div>
 
<!-- Footer -->
<?php
include_once '../../includes/footer.php'
?>