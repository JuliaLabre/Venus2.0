<?php
require '../../includes/header.php';
include_once '../../includes/config.php';

session_start();
ob_start();

$user_id = $_SESSION['user_id'];
// Preciso Selecionar todos os produtos desse vendedor para aparecer na tela dele

$produtos = "SELECT * FROM products WHERE shop = $user_id ";
           
$resultado= $conn->prepare($produtos); 
$resultado->execute();

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
<h2 class="text-center">Seus Produtos</h2>
<?php
if(($resultado) AND ($resultado->rowCount()!= 0)){
   while($resposta = $resultado->fetch(PDO::FETCH_ASSOC)){

   extract($resposta);

      ?> 
    <div class="col-md-3">
      <div class="card bg-light mb-3">
        <img class="card-img-top" src="<?php echo $prod_photo ?>" alt="Imagem de capa do card">
        <div class="card-body">
          <h5 class="card-title"><?php echo $prod_name ?></h5>
          <p class="card-text"> <?php echo $prod_desc ?> </p> 

         <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#roupa1">
 Editar
</button>

<!-- Modal vai ter que entrar como formulário, trazendo as respostas do banco-->
<div class="modal fade" id="roupa1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fazer alterações</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <img class="img-fluid" src="../imagens/roupa1.webp" alt="Imagem de capa do card">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Adicionar ao Carrinho</button>
      </div>
    </div>
  </div>
</div>
        </div>
      </div>
    </div> 
<?php
  }

}
?>

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