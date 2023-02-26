<?php
include_once '../../includes/header.php';
include_once '../../includes/config.php';

//ao invés depaginação. colocar aquele mostrar mais para colocar mais produtos... 
//a paginação acho que não vai funcionar no sosso caminho, pq já estamos usando a rota pra definir a loja 

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$sql = "SELECT * FROM shop WHERE shop_id = $id";
$resultado = $conn->prepare($sql);
$resultado->execute();

if(($resultado) AND ($resultado->rowCount()!= 0)){
  $resposta = $resultado->fetch(PDO::FETCH_ASSOC);
  extract($resposta);
  
}
  
    $busca= "SELECT *
    FROM products  WHERE 
    shop = $id AND
    prod_status = 'online' AND prod_stock > 0 ";

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
<h2 class="text-center"><img src="<?php echo $shop_photo ?>" style=width:150px;> <?php echo $shop_name?></h2>
<div class="wrap">
  <div class="container">
    <div class="col-md-10"> 
      <div class="row mb-4" >
<?php
$max=3;
$card=0;

if(($resultado) AND ($resultado->rowCount()!= 0)){
  while($resposta = $resultado->fetch(PDO::FETCH_ASSOC)){

  extract($resposta);
  $card++;
  if(($card - 1)% $max == 0){
    echo '</div><div class="row mb-4">';
  }
?>

      <div class="card bg-light text-center"  style=max-width:24rem;margin-left:2rem;>
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
</div>
 
<div class="col-md-2">
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
   Faça contato com <?php echo $shop_name?>
  </button>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    
  <form method="post" action="" >
        <label for="validationDefault01">Nome</label>
        <input name="name" type="text" class="form-control" id="validationDefault01" placeholder="Nome"minlength="5" required>
 
        <label for="validationDefaultUsername">Email</label>
        <input name="email" type="email" class="form-control" id="validationDefaultUsername" placeholder="Email" minlength="5" aria-describedby="inputGroupPrepend2" required>
        

         <label for="validationDefault01">Assunto</label>
        <input name="subject" type="text" class="form-control" id="validationDefault01" placeholder="Assunto" minlength="5" required >
 
        <label for="validationDefault01">Mensagem</label>
        <textarea name="message" minlength="5" class="form-control" id="validationDefault01" placeholder="Sua mensagem aqui..." required></textarea>
        
        <input type="hidden" name="address" value="<?php echo $id?>">
        <br>

        <input class="btn btn-primary" type="submit" value='Enviar' name='send' >
         
</form>

</div>
</div>
</div>
</div>

</div>



</div>
 
<!-- Footer -->
<?php
include_once '../../includes/footer.php'
?>
