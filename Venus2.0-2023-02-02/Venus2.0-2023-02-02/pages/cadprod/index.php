<?php
include_once '../../includes/config.php';
session_start();
ob_start();

$user_id = $_SESSION['user_id'];

?>
<h2 class="text-center">Alterações</h2>

<form method="POST" action="../updateprod/index.php" enctype="multipart/form-data">
            <div class="form-row">
             <div class="col-md-4 mb-3">
                    <label>Nome do Produto</label>
                    <input name="name" type="text" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Foto do Produto</label>
                    <input name="photo" type="file" class="form-control" required>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label>Preço do Produto</label>
                    <input name="price" type="text" class="form-control" required>
                </div>   

            </div>

            <div class="form-row">
                
                <div class="col-md-4 mb-3">
                    <label>Quantidade em Estoque</label>
                    <input name="stock" type="text" class="form-control" required>
                </div>
             
                <div class="col-md-4 mb-3">
                    <label>Descrição do Produto</label>
                    <input name="desc" type="text" class="form-control" required>
                </div>

            </div>

            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label>Categoria</label>
                    <select name="cat"  class="form-control" required>
                    <option selected>Escolha a Categoria...</option>
    <?php if(($resultado)&&($resultado->rowCount()!=0)) { 
            while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)){
                extract($linha);

    ?>                
                <option value="<?php echo $idcategoria ?>"><?php echo $nomecategoria?></option>
    <?php
            }
        }
    ?>
                 </select>       
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
                               Cadastrar o produto.
                            </label>
                        </div>
                    </div>
                </div>

                <input class="btn" type="submit" value="Cadastrar" name="btncad">
        </form>
        <a href="../shop" ><input class="btn btn-primary btn-lg btn-block" type="submit" value="Sair"></a>