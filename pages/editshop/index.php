<?php
include_once '../../includes/config.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$shop_id = $id;
include_once '../../includes/headershop.php';



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
<div class="wrap">
<form method="post" action="../updateshop/index.php">

        <input name="id" type="hidden" value=" <?php echo $shop_id ?>">            
        <label for="validationDefault01">Nome da loja</label>
        <input value=" <?php echo $shop_name ?>" name="name" type="text" class="form-control" id="validationDefault01" placeholder="Nome" required>
        <label for="validationDefaultUsername">Email</label>
        <input value=" <?php echo $shop_email ?>" name="email" type="email" class="form-control" id="validationDefaultUsername" placeholder="Email" aria-describedby="inputGroupPrepend2" required>  
        <label for="validationDefault02"> CNPJ </label>
        <input value="<?php echo $shop_CNPJ ?>" name="CNPJ" type="text" maxlength="14"class="form-control" id="validationDefault02" placeholder="Data de Nascimento" required>
        <label for="telefone">Descrição</label>
        <textarea name="desc" type="text" row="3"><?php echo $shop_desc ?></textarea>   
   
        
    </div>             

    <input class="btn btn-primary btn-lg " type="submit" value='Editar' name="btnedit">
</form>

    <a href="../shop"><input class="btn btn-primary btn-lg " type="submit" value="Sair"></a>

</div>
<?php
        require '../../includes/footer.php';
