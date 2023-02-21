<?php
include_once '../../includes/config.php';

session_start();
ob_start();

//dando erro na categoria e estoque
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
<form method="POST" action="../updateprod/index.php" enctype="multipart/form-data">
            <div class="form-row">
            <input name="id" type="hidden" value=" <?php echo $id ?>">
             <div class="col-md-4 mb-3">
                    <label>Nome do Produto</label>
                    <input name="name" type="text" class="form-control" value="<?php echo $prod_name ?>">
                </div>
                
                <div class="col-md-4 mb-3">
                    <label>Preço do Produto</label>
                    <input name="price" type="text" class="form-control" value="<?php echo $prod_price ?>">
                </div>   

            </div>

            <div class="form-row">
                
                <div class="col-md-4 mb-3">
                    <label>Quantidade em Estoque</label>
                    <input type="number" name="stock" class="form-control" value="<?php echo $prod_stock ?>">
                </div>
             
                <div class="col-md-4 mb-3">
                    <label>Descrição do Produto</label>
                    <input name="desc" type="text" class="form-control" required value="<?php echo $prod_desc ?>">
                </div>

            </div>

            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label>Categoria</label>             
                    <select class="form-control" name="cat">
    <?php 
    
    $cat = $prod_cat;

    $sql = "SELECT * FROM category";

    $result= $conn->prepare($sql); 
    $result->execute();

    if(($result)&&($result->rowCount()!=0)) { 
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
                extract($linha);

    ?>                
            <option value="<?php echo $cat_id ?>"
                
                <?php
                if($cat == $cat_id){
                    echo "selected";
                }

                ?>                
                >
                <?php echo $cat_name?></option>
    <?php
            }
        }
    ?>
                     </select> 
                    
                </div>
                <div class="col-md-4 mb-3">
                    <label>Tamanho</label>
                    <input name="size" type="text" class="form-control" value="<?php echo $prod_size ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label>Status</label>
                    <select name="status" class="custom-select" required>
                        <option <?php if('online' == $prod_status){ echo "selected";}?> type="radio" value="online">Online</option>
                        <option <?php if('offline' == $prod_status){ echo "selected";}?> type="radio" value="offline">Offline</option>
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

        <a href="../shop" ><input class="btn btn-primary btn-lg btn-block" type="submit" value="Sair"></a>
