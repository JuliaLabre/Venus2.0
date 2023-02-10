<?php
include_once '../../includes/config.php';

session_start();
ob_start();
//mudar de shop para profile
$shop_id = $_SESSION['shop_id'];
/*Resolver problema do preço
Posso tentar tratar depois que recebo do formulário
Não está trazendo as fotos do banco de dados
*/
try{ 
    
$upgrade = filter_input_array(INPUT_POST, FILTER_DEFAULT);


//verifica a foto para o salvamento
if(isset($_FILES['photo'])){
    $file = ($_FILES['photo']);

    if($file['error']){
        echo 'Erro ao carregar arquivo';
        header("Location: ../shop");
    }
   
    // o erro ao carregar a foto era o caminho, como estou em pastas, precisei acrescentar os ../
    $folder = "../photoshop/"; //Salva nessa pasta    
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

if (!empty($upgrade['edshopft'])) {

    $upgrade = array_map('trim', $upgrade);

    //var_dump($upgrade);

    $sql = "UPDATE shop 
    set shop_photo=:photo
    WHERE shop_id = :id";

    $salvar= $conn ->prepare($sql);
    $salvar -> bindParam(':photo', $path,PDO::PARAM_STR);
    $salvar -> bindParam(':id', $upgrade['id'], PDO::PARAM_INT);
    $salvar -> execute();


    if ($salvar->rowCount()) {        
        echo "<script>
        alert('Foto atualizada com sucesso!!');
        parent.location = '../shop';
        </script>";
        $_SESSION['shop_photo'] = $path;
        unset($upgrade);
    } else {
        echo "<script>
        alert('Erro: Tente novamente!');
        parent.location = '../shop';
        </script>";
        
    }

}

}
catch(PDOException $erro){
    echo $erro;

}