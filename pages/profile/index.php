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

<div class="col-md-8">
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

<div class="col-md-4">
Cliente desde: 

ultima compra:

busca de pedidos por ordem crescente




Aproveite para comprar :


colocar itens favoritos ou mais vistos:



</div>




</div>



<a href="../exit"><button type="submit" class="btn float-right">Sair</button></a>
<!-- Footer -->
<?php
require '../../includes/footer.php'
?>