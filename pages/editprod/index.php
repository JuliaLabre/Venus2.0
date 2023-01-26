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

$sql =  "SELECT * FROM products WHERE prod_id = $id LIMIT 1";
           
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
<h2 class="text-center">Alterações</h2>
<form method="POST" action="../updateprod/index.php">
            <div class="form-row">

             <div class="col-md-4 mb-3">
                    <label>Nome do Produto</label>
                    <input name="name" type="text" class="form-control" value="<?php echo $prod_name ?>" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Foto do Produto</label>
                    <input name="photo" type="text" class="form-control" required value="<?php echo $prod_photo ?>">
                </div>
                
                <div class="col-md-4 mb-3">
                    <label>Preço do Produto</label>
                    <input name="price" type="number" class="form-control" required value="<?php echo $prod_price ?>">
                </div>   

            </div>

            <div class="form-row">
                
                <div class="col-md-4 mb-3">
                    <label>Quantidade em Estoque</label>
                    <input type="number" class="form-control" value="<?php echo $prod_stock ?>" required>
                </div>
             
                <div class="col-md-4 mb-3">
                    <label>Descrição do Produto</label>
                    <input name="desc" type="text" class="form-control" required value="<?php echo $prod_desc ?>">
                </div>

            </div>

            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label>Categoria</label>
                    <input name="cat" type="text"  class="form-control" required value="<?php echo $prod_cat ?>" >
                </div>
                <div class="col-md-4 mb-3">
                    <label>Status</label>
                    <select name="status" class="custom-select">
                        <option selected>Status</option>
                        <option type="radio" value="online">Online</option>
                        <option type="radio" value="offline">Offline</option>
                    </select>                    
                </div>                
            </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                            <label class="form-check-label" for="invalidCheck2">
                              Fazer Alterações.
                            </label>
                        </div>
                    </div>
                </div>

                <input class="btn btn-primary btn-lg btn-block" type="submit" value='Editar' name="btnedit">
        </form>
