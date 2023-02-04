<?php
include_once '../../includes/config.php';

session_start();
ob_start();

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    $_SESSION['msg'] = "Erro: Produto não encontrado";
    header("Location: ../shop");
    exit();
}

$sql =  "SELECT * FROM products WHERE prod_id = $id";
           
$resultado= $conn->prepare($sql); 
$resultado->execute();

if(($resultado) AND ($resultado->rowCount()!= 0)){
    $linha = $resultado->fetch(PDO::FETCH_ASSOC);
    //var_dump($linha);
    extract($linha);

}else{
    $_SESSION['msg'] = "Erro: Produto não encontrado";
    header("Location: ../shop");
}
?>
Foto atual:
<img  width="150" height="150" src="<?php echo $prod_photo ?>" alt="Foto do Produto">
 <form method="post" action="../updateprod/index.php" enctype="multipart/form-data">
        <input name="id" type="hidden" value="<?php echo $id ?>">
                <div class="col-md-4">                
                <label for="Name">Imagem</label>
                <input type="file" class="form-control" name="photo">               
            </div>
        </div>
        <br>
        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Editar" name="edprodft" >
        </form>