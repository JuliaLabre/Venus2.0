<?php
require '../../includes/header.php';
include_once '../../includes/config.php';

?>
<!--Formulário de cadastro de lojista que vai ser enviado para a pasta updateshop-->


<link rel="stylesheet" href="frmshop.css">


<!--Diseño por YooJin Hong
Yo solo lo pase a CSS/HTML
https://dribbble.com/YooJtheHuge
-->
<!--580x290-->

<div id="form-ui" class="container">

  <div class="row ">
    <div class="col-6 left-img">
      <!--290x290-->
      <div id="signup-img" class="img">
        <!--img here-->
        <img src="../../img/variacao.png">
        <!--over img text-->
        <div id="over-img-text"></div>
      </div>
      <!--.img-->
    </div>
    <!--.col-->

    
    <div class="col-6 right-form">
      <div id="signup-form" class="signup-form">
        <form method="POST" id="login-form" class="form" action= "../updateuser/index.php">
        <div>
                    <label for="validationDefault01">Nome Completo</label>
                    <input name="name" type="text" required>
        </div>
        <div>
                    <label for="validationDefault01">Email</label>
                    <input name="email" type="email" required>
        </div>

        
        
          

        </form>
       

        <!--<form method="POST" id="login-form" class="form" action= "../updateuser/index.php">
                    <p>Por favor, preencha os campos abaixo</p>
  
                    <div class="form-outline mb-3">
                    <label for="validationDefault01">Nome Completo</label>
                    <input name="name" type="text" class="form-control" id="validationDefault01" placeholder="Nome" required>
                    </div>

                    <div class="form-outline mb-3">
                    <label for="validationDefaultUsername">Email</label>
                    <input name="email" type="email" class="form-control" id="validationDefaultUsername" placeholder="Email" aria-describedby="inputGroupPrepend2" required>
                    </div>
  
                    <div class="form-outline mb-3">
                      <label class="form-label" for="form2Example22">senha</label>
                      <input type="password" id="form2Example22" class="form-control"  name="pass" placeholder="........">
                    </div>
  
                    <div class="d-flex align-items-center justify-content-center pb-4">
                      <input type="submit" class="btn btn-dark" name="btncad" value ="Cadastrar">
                    </div>
  
                  </form>-->

        <br>
        <img id="circle-coulds-img" src="https://github.com/Min11Benja/SpeedCode-Dayli-UI-Challange/blob/master/daily-ui-001-formulario-martian/img/mini-moon-icon.png?raw=true" alt="circle-cloud-img">
      </div>
      <!--.sigup-form-->
    </div>
    <!--.col-->

  </div>
  <!--.row align-container-center-->
</div>
<!--.container-->

<?php
require '../../includes/footer.php'
?>