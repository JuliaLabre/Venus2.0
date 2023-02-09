<?php
include_once '../../includes/config.php';

session_start();
ob_start();

//falta tudo não mexi
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    $_SESSION['msg'] = "Erro: Produto não encontrado";
    header("Location: ../user");
    exit();
}

$sql =  "SELECT * FROM user WHERE user_id = $id LIMIT 1";
           
$resultado= $conn->prepare($sql); 
$resultado->execute();

if(($resultado) AND ($resultado->rowCount()!= 0)){
    $linha = $resultado->fetch(PDO::FETCH_ASSOC);
    //var_dump($linha);
    extract($linha);

}else{
    $_SESSION['msg'] = "Erro: Produto não encontrado";
    header("Location: ../user");
}
?>
<h2 class="text-center">Alterações</h2>
<form method="POST" action="../updateuser/index.php">
            <div class="form-row">
            <input name="id" type="hidden" value=" <?php echo $id ?>">
             <div class="col-md-4 mb-3">
                    <label>Nome</label>
                    <input name="name" type="text" class="form-control" value="<?php echo $user_name ?>" required>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label>CEP</label>
                    <input name="price" type="text" class="form-control" required value="<?php echo $prod_price ?>">
                </div>   

            </div>

            <div class="form-row">
                
                <div class="col-md-4 mb-3">
                    <label>Quantidade em Estoque</label>
                    <input type="text" class="form-control" value="<?php echo $prod_stock ?>" required>
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
