<?php
include_once '../../includes/config.php';
session_start();
ob_start();

$shop_id = $_SESSION['shop_id'];

include_once '../../includes/headershop.php';

$sql = "SELECT * FROM category";

$resultado=$conn->prepare($sql);
$resultado->execute();   

?>

<div class="wrap">
<main>
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
                <div class="col-md-4 mb-4">
                    <label>Categoria</label>
                    <select name="cat"  class="form-control" required>
                    <option selected>Escolha a Categoria...</option>
    <?php 
    
    if(($resultado)&&($resultado->rowCount()!=0)) { 
            while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)){
                extract($linha);

    ?>                
                <option value="<?php echo $cat_id ?>"><?php echo $cat_name?></option>
    <?php
            }
        }
    ?>
                 </select>       
                </div>

                <div class="col-md-4 mb-4">
                    <label>Status</label>
                    <select name="status" class="form-control">                       
                        <option value="online" selected>Online</option>
                        <option value="offline">Offline</option>
                    </select>                    
                </div>                
            </div>
               

                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Cadastrar" name="btncad">
        </form>
        <a href="../shop" ><input class="btn" type="submit" value="Sair"></a>
</main>

      </div>
      <?php

      include_once '../../includes/footershop.php';

      ?>