<?php
require '../../includes/header.php';
include_once '../../includes/config.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

/*if (empty($id)) {
    $_SESSION['msg'] = "Erro";
    header("Location: ../profile");
    exit();
}*/

 $sql =  "SELECT * FROM users WHERE user_id = $id";
           
$resultado= $conn->prepare($sql); 
$resultado->execute();

if(($resultado) AND ($resultado->rowCount()!= 0)){
    $linha = $resultado->fetch(PDO::FETCH_ASSOC);
    //var_dump($linha);
    extract($linha);

}else{
    $_SESSION['msg'] = "Erro";
    header("Location: ../profile");
}
?>
<?php
//Se tiver foto...
if (!empty($_SESSION['user_photo'])) :
    ?>
Foto atual:
<img  width="150" height="150" src="<?php echo $user_photo ?>" alt="Foto de <?php echo $user_name ?> ">
<?php
      endif;
      ?>
 <form method="post" action="../updateuser/index.php" enctype="multipart/form-data">
        <input name="id" type="hidden" value="<?php echo $id ?>">
                <div class="col-md-4">                
                <label for="Name">Imagem</label>
                <input type="file" class="form-control" name="photo">               
            </div>
        </div>
        <br>
        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Editar" name="eduserft" >
        </form>


        <!-- Footer -->
<?php
require '../../includes/footer.php'
?>