<?php
require '../../includes/header.php';
include_once '../../includes/config.php';

session_start();
ob_start();

?>
<!-- Conteudo -->
<div class="wrap">
<h2 class='text-center'>Área do Aluno</h2>
<h2 class='text-center'>Olá, <?php echo $_SESSION['user_name']?>! Seja bem vindo (a)  </h2>
   <div class="perfil">
<img src="<?php echo $_SESSION['user_photo'] ?>">
<ul>
<li>Nome: <?php echo $_SESSION['user_name'] ?></li>
<li>Data de Nascimento: <?php echo $_SESSION['user_birth'] ?></li>
<li>CEP :<?php echo $_SESSION['user_adress'] ?></li>
</ul>
</div>
</div>

<?php
if(!isset($_SESSION['nome'])){
  $_SESSION['msg'] = "Erro: Necessário realizar login";
  header("Location: login.php");
}
?>

<a href="#"><button type="submit">Sair</button></a>
<!-- Footer -->
<?php
require '../../includes/footer.php'
?>