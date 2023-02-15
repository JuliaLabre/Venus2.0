<?php
include_once '../../includes/config.php';

session_start();
ob_start();
//mudar de shop para profile
$user_id = $_SESSION['user_id'];
/*Resolver problema do preço
Posso tentar tratar depois que recebo do formulário
Não está trazendo as fotos do banco de dados
*/
try{ 
    
$upgrade = filter_input_array(INPUT_POST, FILTER_DEFAULT);


//verifica a foto para o salvamento 
if(isset($_FILES['photo'])){
    $file = ($_FILES['photo']);
    //var_dump($file);

    if($file['error']){
        echo 'Erro ao carregar arquivo';
        header("Location: ../profile");
    }
   
    // o erro ao carregar a foto era o caminho, como estou em pastas, precisei acrescentar os ../
    $folder = "../photousers/"; //Salva nessa pasta    
    $namefile = $file['name']; //pega o nome do arquivo da array que é criada automaticamente no envio do formulario    
    $newname = uniqid(); //nome unico, para não haver duplicidade e substituição  
    $exten = strtolower(pathinfo($namefile, PATHINFO_EXTENSION)); //Coloca o nome do arquivo com a sua extensão
    

    if($exten != "jpg" && $exten != "png" && $exten != "webp"&& $exten != "avif"){
        echo "<script>
        alert('Essa extensão de arquivo não é aceita');
        </script>";
        //header("Location: ../shop");
    } else {
        
        $saveimg = move_uploaded_file($file['tmp_name'], $folder . $newname . "." . $exten );

        if($saveimg){
            $path = $folder . $newname .".". $exten;
        }
       
    }


}

//recebe a foto

if (!empty($upgrade['eduserft'])) {

    $upgrade = array_map('trim', $upgrade);

    //var_dump($upgrade);

    $sql = "UPDATE users 
    set user_photo=:photo
    WHERE user_id = :id";

    $salvar= $conn ->prepare($sql);
    $salvar -> bindParam(':photo', $path,PDO::PARAM_STR);
    $salvar -> bindParam(':id', $upgrade['id'], PDO::PARAM_INT);
    $salvar -> execute();


    if ($salvar->rowCount()) {        
        echo "<script>
        alert('Foto atualizada com sucesso!!');
        parent.location = '../profile';
        </script>";
        $_SESSION['user_photo'] = $path;
        unset($upgrade);
    } else {
        echo "<script>
        alert('Erro: Tente novamente!');
        parent.location = '../profile';
        </script>";
        
    }

}
 //var_dump($upgrade);
 
 //*****************************************************EDITAR CONFORME DADOS DA TABELA FORM USER */
if (!empty($upgrade['btncad'])) {

    $vazio = false;

    if (!$vazio) {
    $sql = "INSERT INTO users (user_name, user_email, user_password)
    values(:name, :email, :pass)";

    $salvar= $conn ->prepare($sql);
    $salvar -> bindParam(':name', $upgrade['name'],PDO::PARAM_STR);
    $salvar -> bindParam(':photo', $path,PDO::PARAM_STR);
    $salvar -> bindParam(':pass', $senha,PDO::PARAM_STR);
    $salvar -> execute();


    if ($salvar->rowCount()) {
        
        echo "<script>
        alert('Cadastro efetuado com sucesso!!');
        parent.location = '../frmuser';
        </script>";

        unset($upgrade);
    } else {
        echo "<script>
        alert('Cadastro não efetuado, tente novamente!!');
        parent.location = '../frmuser';
        </script>";
        
    }

}

}
/*Não está pegando a quantidade em estoque
if (!empty($upgrade['btnedit'])){
    
    $sql = "UPDATE products 
    set prod_name=:name, prod_price=:price, prod_stock=:stock, prod_desc=:desc, prod_cat=:cat, prod_status=:status, shop=$user_id
    WHERE prod_id=:id";

$salvar= $conn ->prepare($sql);
$salvar -> bindParam(':name', $upgrade['name'],PDO::PARAM_STR);
$salvar -> bindParam(':price', $upgrade['price'],PDO::PARAM_STR);
$salvar -> bindParam(':stock', $upgrade['stock'], PDO::PARAM_STR);
$salvar -> bindParam(':desc', $upgrade['desc'], PDO::PARAM_STR);
$salvar -> bindParam(':cat', $upgrade['cat'], PDO::PARAM_STR);
$salvar -> bindParam(':status', $upgrade['status'], PDO::PARAM_STR);
$salvar -> bindParam(':id', $upgrade['id'], PDO::PARAM_STR);
$salvar -> execute();


    if ($salvar->rowCount()) {
        
        echo "<script>
        alert('Produto atualizado com sucesso!!');
        parent.location = '../shop';
        </script>";

        unset($upgrade);
    } else {
        echo "<script>
        alert('Aluno não cadastrado!');
        parent.location = '../shop';
        </script>";
        
    }

}*/
}
catch(PDOException $erro){
    echo $erro;

}