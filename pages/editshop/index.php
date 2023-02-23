<?php
include_once '../../includes/config.php';
require '../../includes/header.php';


//fazer o via cep funcionar
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    $_SESSION['msg'] = "Erro";
    header("Location: ../404");
    exit();
}

$sql =  "SELECT * FROM shop WHERE shop_id = $id LIMIT 1";
           
$resultado= $conn->prepare($sql); 
$resultado->execute();

if(($resultado) AND ($resultado->rowCount()!= 0)){
    $linha = $resultado->fetch(PDO::FETCH_ASSOC);
    
    extract($linha);

}else{
    $_SESSION['msg'] = "Erro: tente novamente";
    header("Location: ../shop");
}
?>
<h2 class="text-center">Dados da loja</h2>
<div class="wrap text">
<form method="post" action="../updateshop/index.php">

    <div class="form-row">
        <input name="id" type="hidden" value=" <?php echo $shop_id ?>">            
        <div class="col-md-4 mb-3">
            <label for="validationDefault01">Nome da loja</label>
            <input value=" <?php echo $shop_name ?>" name="name" type="text" class="form-control" id="validationDefault01" placeholder="Nome" required>
        </div>
        <div class="col-md-2 mb-3 ">
            <label for="telefone">Descrição</label>
            <input value=" <?php echo $shop_desc ?>" name="desc" type="text" >
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationDefaultUsername">Email</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend2">@</span>
                </div>
                <input value=" <?php echo $shop_email ?>" name="email" type="email" class="form-control" id="validationDefaultUsername" placeholder="Email" aria-describedby="inputGroupPrepend2" required>
            </div>                
        </div>
        <div class="col-md-2 mb-3">
            <label for="validationDefault02"> CNPJ </label>
            <input value="<?php echo $shop_CNPJ ?>" name="CNPJ" type="text" maxlength="14"class="form-control" id="validationDefault02" placeholder="Data de Nascimento" required>
        </div>
        
    </div>             

    <input class="btn btn-primary btn-lg " type="submit" value='Editar' name="btnedit">
</form>

    <a href="../shop"><input class="btn btn-primary btn-lg " type="submit" value="Sair"></a>

</div>
<?php
        require '../../includes/footer.php';
