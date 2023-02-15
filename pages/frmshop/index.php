<?php
require '../../includes/header.php';
include_once '../../includes/config.php';

?>
<!--Formulário de cadastro de lojista que vai ser enviado para a pasta updateshop-->



<div class="wrap">
    <h2 class='text-center'>Conta Vênus Shop</h2>
    <div class="container">
      
        <form method="post" action="../updateshop/index.php" enctype="multipart/form-data">
            <div class="form-row"> 
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01">Nome Completo</label>
                    <input name="nome" type="text" class="form-control" id="validationDefault01" placeholder="Nome" required>
                </div>

            <div class="form-row">
                <div class="col-md-6 mb-3 ">
                    <label for="telefone">Telefone</label>
                    <input name="telefone" type="text" placeholder="(99) 99999-9999" class="form-control"
                        onkeypress="$(this).mask('(00)00000-0000')">
            </div>

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationDefaultUsername">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend2">@</span>
                        </div>
                        <input name="email" type="email" class="form-control" id="validationDefaultUsername" placeholder="Email"
                            aria-describedby="inputGroupPrepend2" required>
                      </div>
                  </div>

            <div class="form-row">    
                <div class="col-md-6 mb-3">
                  <label>Senha</label>
                  <input type="password" class="form-control" name="senha" placeholder="Senha">
                </div>

            <div class="form-row">
                  <div class="col-md-12 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                            <label class="form-check-label" for="invalidCheck2">
                                <p>Declaro que todas as informações prestadas são verdadeiras.</p>
                            </label>
                        </div>
                    </div>
          
            <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <input class="btn btn-primary btn-lg btn-block-cad" type="submit" value='Cadastrar' name='btncad' >
                  </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>


<?php
require '../../includes/footer.php'
?>