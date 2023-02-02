<?php
session_start();
ob_start();

require '../../includes/header.php';
include_once '../../includes/config.php';

$user_id = $_SESSION['user_id'];


$produtos = "SELECT * FROM products WHERE shop = $user_id ";
           
$resultado= $conn->prepare($produtos); 
$resultado->execute();

?>
<!-- Conteudo -->
<div class="perfil-bonito">
  <h2 class='text-center'>Olá, <?php echo $_SESSION['user_name']?></h2>
   <div class="perfil">
    <img src="<?php echo $_SESSION['user_photo'] ?>">
      <ul>
        <li><?php echo $_SESSION['user_name'] ?></li>
        <li>Membro desde <?php echo $_SESSION['datebr'] ?></li>
        <li>Total de itens vendidos : </li>
      </ul>
    </div>
</div>

<h2 class="text-center">Seus Produtos</h2>

<div class="container">
  <div class="row">    
<?php

if(($resultado) AND ($resultado->rowCount()!= 0)){
   while($resposta = $resultado->fetch(PDO::FETCH_ASSOC)){

   extract($resposta);

?> 
<div class="col-sm">
    <div class="card">
      <img class="card-img-top" src="<?php echo $prod_photo ?>" alt="Imagem de capa do card">
        <div class="card-body">
          <h5 class="card-title"><?php echo $prod_name ?></h5>
          <p class="card-text"> <?php echo $prod_desc ?> </p>
          <p class="card-text"><small class="text-muted"> <?php echo $prod_status ?></small></p>
          <!-- <form action="../editprod" method="get">
                  <label for="validationDefault01">ID do Produto</label>
                    <input name="matricula" type="text" class="form-control" id="validationDefault01" value="<?php echo $prod_id ?>">
          </form> -->
          <?php var_dump($prod_id);
          echo "<a href='../editprod?id=$prod_id'>" ?>
          <input type="submit" class="btn btn-primary" name="editar" value="Editar">
         </a>
        </div>
    </div>
  </div>
<?php
  }

}
?>
   
  </div>
</div>
<a href='../cadprod'>
<input type="submit" class="btn btn-primary" name="editar" value="Cadastrar Produto">
</a>
<?php
if(!isset($_SESSION['user_name'])){
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">
  Erro: Necessário realizar login
 </div>';
  header("Location: ../login");
}
?>

<a href="../exit"><button type="submit">Sair</button></a>
<!-- Footer -->
<?php
require '../../includes/footer.php'
?>