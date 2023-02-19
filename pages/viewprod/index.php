<?php
include_once '../../includes/header.php';
include_once '../../includes/config.php';


$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$pag = $_SERVER['HTTP_REFERER'] ;

$sql = "SELECT * FROM products WHERE prod_id = $id AND prod_status = 'online' ";
$resultado = $conn->prepare($sql);
$resultado->execute();

if(($resultado) AND ($resultado->rowCount()!= 0)){
  $resposta = $resultado->fetch(PDO::FETCH_ASSOC);
  extract($resposta);
}

?>
<h2 class="text-center"><?php echo $prod_name ?></h2>
<div class="wrap">
<div class="container">
    <div class="col-md-8">
        <img src="<?php echo $prod_photo ?>" alt="Imagem de <?php echo $prod_name ?>" class="img-fluid">
    </div>

    <div class="col-md-4">
        <h3><?php echo $prod_name ?></h3>
        <p><?php echo $prod_desc?></p>
        <p>R$<?php echo $prod_price ?>,00</p> 
        <form method="post" action="carrinho.php">
        <h6>   
        <label>Quantidade </label>
        <input type="number" name="quantcompra" value="1" style=width:50px;>
        </h6> 
        <input type="hidden" value="<?php echo $prod_id ?>" name="codigoproduto">

        
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
        <p><a <?php echo "href='../favorite?id=$prod_id'"?>><?php echo $icon ?> Adicionar aos favoritos </a></p>
               
        <input type="submit" class="btn btn-primary" name="carrinho" value="Adicionar ao carrinho">
        </form>
        
    </div>
</div>

<!-- Não funciona quando ele está na página de pesquisa, dá erro -->
<a <?php echo "href='$pag'" ?> ><button type="button" class="btn btn-secondary">Voltar</button></a>

</div>
<!-- Footer -->
<?php
include_once '../../includes/footer.php'
?>
