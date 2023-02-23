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
 /*var_dump($upgrade);

if (!empty($upgrade['btncad'])) {

    $vazio = false;

    if (!$vazio) {
    $sql = "INSERT INTO products (prod_name, prod_photo, prod_price, prod_stock, prod_desc, prod_cat, prod_status,shop)
    values(:name, :photo, :price,:stock, :desc, :cat, :status, $user_id)";

    $salvar= $conn ->prepare($sql);
    $salvar -> bindParam(':name', $upgrade['name'],PDO::PARAM_STR);
    $salvar -> bindParam(':photo', $path,PDO::PARAM_STR);
    $salvar -> bindParam(':price', $upgrade['price'],PDO::PARAM_STR);
    $salvar -> bindParam(':stock', $upgrade['stock'], PDO::PARAM_STR);
    $salvar -> bindParam(':desc', $upgrade['desc'], PDO::PARAM_STR);
    $salvar -> bindParam(':cat', $upgrade['cat'], PDO::PARAM_STR);
    $salvar -> bindParam(':status', $upgrade['status'], PDO::PARAM_STR);
    $salvar -> execute();


    if ($salvar->rowCount()) {
        
        echo "<script>
        alert('Produto cadastrado com sucesso!!');
        parent.location = '../cadprod';
        </script>";

        unset($upgrade);
    } else {
        echo "<script>
        alert('Produto não cadastrado. Tente novamente');
        parent.location = '../cadprod';
        </script>";
        
    }

}

}*/

if (!empty($upgrade['btnedit'])){
    
    $sql = "UPDATE users 
    set user_name=:name,user_tel=:tel, user_email=:email, user_birth=:birth, user_gen=:gen, user_CPF=:CPF, user_CEPadress=:cep, user_num=:num, user_comp=:comp
    WHERE user_id=:id";

$salvar= $conn ->prepare($sql);
$salvar -> bindParam(':id', $upgrade['id'], PDO::PARAM_INT);
$salvar -> bindParam(':name', $upgrade['name'],PDO::PARAM_STR);
$salvar -> bindParam(':tel', $upgrade['tel'],PDO::PARAM_STR);
$salvar -> bindParam(':email', $upgrade['email'], PDO::PARAM_STR);
$salvar -> bindParam(':birth', $upgrade['birth'], PDO::PARAM_STR);
$salvar -> bindParam(':gen', $upgrade['gen'], PDO::PARAM_STR);
$salvar -> bindParam(':CPF', $upgrade['CPF'], PDO::PARAM_STR);
$salvar -> bindParam(':cep', $upgrade['cep'], PDO::PARAM_STR);
$salvar -> bindParam(':num', $upgrade['num'], PDO::PARAM_INT);
$salvar -> bindParam(':comp', $upgrade['comp'], PDO::PARAM_INT);

$salvar -> execute();


    if ($salvar->rowCount()) {
        
        echo "<script>
        alert('Dados atualizados com sucesso!!');
        parent.location = '../profile';
        </script>";

        unset($upgrade);
    } else {
        echo "<script>
        alert('Erro: Tente novamente!');
        parent.location = '../profile';
        </script>";
        
    }

}
}
catch(PDOException $erro){
    echo $erro;

}
