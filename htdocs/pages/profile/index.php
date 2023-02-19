<?php
require '../../includes/header.php';
include_once '../../includes/config.php';

$user_id = $_SESSION['user_id'];
// Precisa continuar o login para navegação das páginas
?>
<!-- Conteudo -->
<div class="wrap">
<h2 class='text-center'>Olá, <?php echo $_SESSION['user_name']?></h2>
   
    <?php
//Se tiver logado...
if (!empty($_SESSION['user_photo'])) :
    ?>
      <a title="Editar foto" <?php echo "href='../edituserft?id=$user_id'"?>>
        <img src="<?php echo $_SESSION['user_photo'] ?>"width="150" height="150"> 
      </a>
      <?php
      // Se não está logado...
      else :
      ?>
      <a <?php echo "href='../edituserft?id=$user_id'"?>><button type="submit" class="btn">Escolha sua foto de perfil</button></a>
    
<?php
      endif;
      ?>
    
<ul>
<li>Nome: <?php echo $_SESSION['user_name'] ?></li>
<li>Data de Nascimento: <?php echo $_SESSION['datebr'] ?></li>
<li>CEP :<?php echo $_SESSION['user_CEPadress'] ?></li>

</ul>
</div>

<?php
if(!isset($_SESSION['user_name'])){
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">
  Erro: Necessário realizar login
 </div>';
  header("Location: ../login");
}
?>

<a <?php echo "href='../edituser?id=$user_id'"?>><button type="submit" class="btn">Editar Perfil</button></a>

<a href="../exit"><button type="submit" class="btn">Sair</button></a>
<!-- Footer -->
<?php
require '../../includes/footer.php'
?>