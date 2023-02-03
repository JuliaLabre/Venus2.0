<?php
require '../../includes/header.php';
include_once '../../includes/config.php';

session_start();
ob_start();


// Precisa continuar o login para navegação das páginas
?>
<!-- Conteudo -->
<div class="wrap">
<h2 class='text-center'>Olá, <?php echo $_SESSION['user_name']?></h2>
   <div class="perfil">
<img src="<?php echo $_SESSION['user_photo'] ?>">
<ul>
<li>Nome: <?php echo $_SESSION['user_name'] ?></li>
<li>Data de Nascimento: <?php echo $_SESSION['user_birth'] ?></li>
<li>CEP :<?php echo $_SESSION['user_CEPadress'] ?></li>
</ul>
</div>
</div>

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