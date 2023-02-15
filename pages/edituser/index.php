<?php
include_once '../../includes/config.php';

session_start();
ob_start();

//fazer o via cep funcionar
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    $_SESSION['msg'] = "Erro";
    header("Location: ../404");
    exit();
}

$sql =  "SELECT * FROM users WHERE user_id = $id LIMIT 1";
           
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
<form method="post" action="../updateuser/index.php">
    <div class="form-row">
        <input name="id" type="hidden" value=" <?php echo $user_id ?>">
            <div class="form-row"> 
                <div class="col-md-4 mb-3">
                    <label for="validationDefault01">Nome Completo</label>
                    <input value=" <?php echo $user_name ?>" name="nome" type="text" class="form-control" id="validationDefault01" placeholder="Nome" required>
                </div>
                <div class="col-md-2 mb-3 ">
                    <label for="telefone">Telefone</label>
                    <input value=" <?php echo $user_tel ?>" name="telefone" type="text" placeholder="(99) 99999-9999" class="form-control"
                        onkeypress="$(this).mask('(00)00000-0000')">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefaultUsername">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend2">@</span>
                        </div>
                        <input value=" <?php echo $user_email ?>" name="email" type="email" class="form-control" id="validationDefaultUsername" placeholder="Email"
                            aria-describedby="inputGroupPrepend2" required>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="validationDefault02">Data de Nascimento</label>
                    <input value=" <?php echo $user_birth ?>"name="dn" type="date" class="form-control" id="validationDefault02" placeholder="Data de Nascimento"
                        required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <!-- Colocar a programação puxando o que ta no banco -->
                    <label>Sexo</label>
                    <select name="sexo" class="custom-select" required>
                        <option selected>Sexo</option>
                        <option type="radio" value="F">Feminino</option>
                        <option type="radio" value="M">Masculino</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationDefault03">CPF</label>
                    <input value=" <?php echo $user_CPF ?>" name="CPF" type="text" class="form-control" onkeypress="$(this).mask('000.000.000-00'); "
                        placeholder="123.456.789-10" required>
                </div>               
            </div> 
            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label for="cep">CEP</label>
                    <input value=" <?php echo $user_CEPadress ?>"class="form-control" placeholder="12345-67" name="cep" type="text" id="cep" value=""
                        size="10" maxlength="9" onblur="pesquisacep(this.value);">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Endereço</label>
                    <input type="text" id="rua" size="60" class="form-control" placeholder="Rua" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="validationDefault05">Número</label>
                    <input value=" <?php echo $user_num ?>"name="num" type="number" class="form-control" id="validationDefault05" placeholder="Nº" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault05">Complemento</label>
                    <input value=" <?php echo $user_comp ?>"name="comple" type="text" class="form-control" id="validationDefault05" placeholder="Complemento" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Cidade</label>
                    <input name="cidade" type="text" id="cidade" size="40" class="form-control" placeholder="Cidade"
                        required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault04">Estado</label>
                    <input name="uf" type="text" id="uf" size="2" class="form-control" placeholder="Estado" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault04">Bairro</label>
                    <input name="bairro" type="text" id="bairro" class="form-control" placeholder="Bairro"
                        required>
                </div>
            </div>            
                <div class="col-md-12 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                            <label class="form-check-label" for="invalidCheck2">
                                Declaro que todas as informações prestadas são verdadeiras.
                            </label>
                        </div>
                    </div>
                </div>

                <input class="btn btn-primary btn-lg btn-block" type="submit" value='Editar' name="btnedit">
        </form>

        <a href="../profile" ><input class="btn btn-primary btn-lg btn-block" type="submit" value="Sair"></a>

        <script src="script.js"></script>
