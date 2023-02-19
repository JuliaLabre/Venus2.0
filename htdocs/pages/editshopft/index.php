<?php
include_once '../../includes/config.php';

session_start();
ob_start();

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    $_SESSION['msg'] = "Erro";
    header("Location: ../shop");
    exit();
}

 $sql =  "SELECT shop_photo FROM shop WHERE shop_id = $id";
           
$resultado= $conn->prepare($sql); 
$resultado->execute();

if(($resultado) AND ($resultado->rowCount()!= 0)){
    $linha = $resultado->fetch(PDO::FETCH_ASSOC);
    //var_dump($linha);
    extract($linha);

}else{
    $_SESSION['msg'] = "Erro";
    header("Location: ../shop");
}
?>
 
 <?php
//Se tiver foto...
if (!empty($_SESSION['shop_photo'])) :
    ?>
Foto atual:
<img  width="150" height="150" src="<?php echo $shop_photo ?>" alt="Foto de <?php echo $shop_name ?> ">
<?php
      endif;
      ?>

 <form method="post" action="../updateshop/index.php" enctype="multipart/form-data">
        <input name="id" type="hidden" value="<?php echo $id ?>">
                <div class="col-md-4">                
                <label for="Name">Carregue a foto da sua loja</label>
                <input type="file" class="form-control" name="photo">               
            </div>
        </div>
        <br>
        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Editar" name="edshopft" >
        </form>