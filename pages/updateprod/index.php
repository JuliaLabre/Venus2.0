<?php
include_once '../../includes/config.php';

try{
$upgrade = filter_input_array(INPUT_POST, FILTER_DEFAULT);


if (!empty($upgrade['btncad'])) {

    $vazio = false;

    $upgrade = array_map('trim', $upgrade);
    if (in_array("", $upgrade)) {
        $vazio = true;
        echo  "<script>
            alert('Preencher todos os campos!!!');
            parent.location = '../editprod';
            </script>";
   

    } else if(!filter_var($upgrade['email'], FILTER_VALIDATE_EMAIL)) {
        $vazio = true;
        echo  "<script>
            alert('Informe um e-mail válido!!!');
            parent.location = '../editprod';
            </script>";
    }

    if (!$vazio) {

    $sql = "INSERT INTO products (nome, telefone, emailaluno, CPF, RG, sexo, datanascimento, CEP, numerocasa, complemento, foto, senha)
    values(:nome, :telefone, :emailaluno,:CPF, :RG, :sexo, :datanascimento, :CEP, :numerocasa, :complemento, :foto, :senha)";

    $salvar= $conn ->prepare($sql);
    $salvar -> bindParam(':nome', $upgrade['nome'],PDO::PARAM_STR);
    $salvar -> bindParam(':telefone', $upgrade['telefone'],PDO::PARAM_STR);
    $salvar -> bindParam(':emailaluno', $upgrade['email'],PDO::PARAM_STR);
    $salvar -> bindParam(':CPF', $upgrade['CPF'], PDO::PARAM_STR);
    $salvar -> bindParam(':RG', $upgrade['RG'], PDO::PARAM_STR);
    $salvar -> bindParam(':sexo', $upgrade['sexo'], PDO::PARAM_STR);
    $salvar -> bindParam(':datanascimento', $upgrade['dn'], PDO::PARAM_STR);
    $salvar -> bindParam(':CEP', $upgrade['cep'], PDO::PARAM_STR);
    $salvar -> bindParam(':numerocasa', $upgrade['num'], PDO::PARAM_INT);
    $salvar -> bindParam(':complemento', $upgrade['comple'], PDO::PARAM_STR);
    $salvar -> bindParam(':foto', $upgrade['foto'], PDO::PARAM_STR);
    $salvar->bindParam(':senha', $senha, PDO::PARAM_STR);
    $salvar -> execute();


    if ($salvar->rowCount()) {
        
        echo "<script>
        alert('Usuário cadastrado com sucesso!!');
        parent.location = 'matricula.php';
        </script>";

        unset($upgrade);
    } else {
        echo "<script>
        alert('Usuário não cadastrado!');
        parent.location = 'matricula.php';
        </script>";
        
    }

}

}
if (!empty($upgrade['btnedit'])){
    
    $upgrade = array_map('trim', $upgrade);

    if(!filter_var($upgrade['email'], FILTER_VALIDATE_EMAIL)) {
        $vazio = true;
        echo  "<script>
            alert('Informe um e-mail válido!!!');
            parent.location = 'matricula.php';
            </script>";
    }
    $sql = "UPDATE aluno 
    set nome=:nome, telefone=:telefone, emailaluno=:emailaluno, CPF=:CPF, RG=:RG, sexo=:sexo, datanascimento=:datanascimento, 
    CEP=:CEP, numerocasa=:numerocasa, complemento=:complemento, foto=:foto WHERE matricula = :matricula";

    $salvar= $conn ->prepare($sql);
    $salvar -> bindParam(':nome', $upgrade['nome'],PDO::PARAM_STR);
    $salvar -> bindParam(':telefone', $upgrade['telefone'],PDO::PARAM_STR);
    $salvar -> bindParam(':emailaluno', $upgrade['email'],PDO::PARAM_STR);
    $salvar -> bindParam(':CPF', $upgrade['CPF'], PDO::PARAM_STR);
    $salvar -> bindParam(':RG', $upgrade['RG'], PDO::PARAM_STR);
    $salvar -> bindParam(':sexo', $upgrade['sexo'], PDO::PARAM_STR);
    $salvar -> bindParam(':datanascimento', $upgrade['dn'], PDO::PARAM_STR);
    $salvar -> bindParam(':CEP', $upgrade['cep'], PDO::PARAM_STR);
    $salvar -> bindParam(':numerocasa', $upgrade['num'], PDO::PARAM_INT);
    $salvar -> bindParam(':complemento', $upgrade['comple'], PDO::PARAM_STR);
    $salvar -> bindParam(':foto', $upgrade['foto'], PDO::PARAM_STR);
    $salvar -> bindParam(':matricula', $upgrade['matricula'], PDO::PARAM_INT);
    $salvar -> execute();


    if ($salvar->rowCount()) {
        
        echo "<script>
        alert('Dados atualizados com sucesso!!');
        parent.location = 'matricula.php';
        </script>";

        unset($upgrade);
    } else {
        echo "<script>
        alert('Aluno não cadastrado!');
        parent.location = 'matricula.php';
        </script>";
        
    }

}
}
catch(PDOException $erro){
    echo $erro;

}