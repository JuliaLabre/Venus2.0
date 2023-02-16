<?php
require '../../includes/header.php';
include_once '../../includes/config.php';

?>
<!--Formulário de cadastro de lojista que vai ser enviado para a pasta updateshop-->

       

<!DOCTYPE html> 
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login na Venus Shop</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
  <link rel="stylesheet" href="frmshop.css">
</head>
<body>
  <header>



  </header>
  <section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6"> 
                <div class="card-body p-md-5 mx-md-4">
  
                  <div class="text-center">
                    <a href ="/"><img src="../../img/logo-principal.png"
                      style="width: 185px;" alt="logo"></a>
                    <h4 class="mt-1 mb-5 pb-1"><strong>Junte-se a nós!</strong></h4>
                  </div>
  
                  <!--formulário-->
                  <form method="POST" id="login-form" class="form" action= "../updateshop/index.php">
                    <p>Por favor, preencha os campos abaixo</p>
  
                    <div class="form-outline mb-3">
                      <label for="validationDefault01">Nome da Loja</label>
                      <input name="name" type="text" class="form-control" id="validationDefault01" placeholder="Nome" required>
                    </div>

                    <div class="form-outline mb-3">
                      <label for="validationDefaultUsername">Email</label>
                      <input name="email" type="email" class="form-control" id="validationDefaultUsername" placeholder="Email" aria-describedby="inputGroupPrepend2" required>
                    </div>
  
                    <div class="form-outline mb-3">
                      <label class="form-label" for="form2Example22">Senha</label>
                      <input type="password" id="form2Example22" class="form-control"  name="pass" placeholder="........">
                    </div>
  
                    <div class="d-flex align-items-center justify-content-center pb-4">
                      <input type="submit" class="btn btn-dark" name="btncad" value ="Cadastrar">
                    </div>
  
                  </form>
  
                </div>
              </div>

              <!--adicional com direcionamento para termos e políticas de privacidade-->
              <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                  <p class="small mb-0">Ao criar uma conta você concorda com os <a href="../../pages/termos">Termos de uso </a>da Vênus Shop.</p>
                    <p class="small mb-0">Por favor verifique as <a href="../../pages/policies">Políticas de privacidade</a>.</p>
                    
                    <div class="d-flex align-items-center justify-content-center pb-4">
                      <p class="mb-0 me-2">Já é cliente? </p>
                      <a href="../../pages/loginshop"><button type="button" name="btncad" class="btn btn-danger">Faça Login</button></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer>



  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

