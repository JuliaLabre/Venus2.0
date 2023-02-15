<!-- Cabeçalho -->
<?php
include_once '../../includes/config.php';

session_start();
ob_start();

$dadoslogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo "admin".password_hash(123,PASSWORD_DEFAULT);

if (!empty($dadoslogin['btnlogin'])) {

$buscalogin = "SELECT *, DATE_FORMAT(user_birth, '%d/%m/%Y') AS datebr
                        FROM users
                        WHERE user_email = :user AND user_status = 'online' AND user_type = 'user'
                        LIMIT 1";
           
$resultado= $conn->prepare($buscalogin); 
$resultado->bindParam(':user', $dadoslogin['user'],PDO::PARAM_STR);
$resultado->execute();

if(($resultado) AND ($resultado->rowCount()!= 0)){
    $resposta = $resultado->fetch(PDO::FETCH_ASSOC);
    //var_dump($resposta);

// salvando dados na variavel

    if(password_verify($dadoslogin['pass'],$resposta['user_password'])){
      $_SESSION['user_name'] = $resposta['user_name'];
      $_SESSION['user_email'] = $resposta['user_email'];
      $_SESSION['user_photo'] = $resposta['user_photo'];
      $_SESSION['user_CEPadress'] = $resposta['user_CEPadress'];
      $_SESSION['user_id'] = $resposta['user_id'];
      $_SESSION['datebr'] = $resposta['datebr'];
    
      //echo  $_SESSION['user_email'];
      
     
       header("location:../profile");
     
    }else{
      $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">
                          Error: Usuário ou senha inválidos!
                         </div>';
    }
}   else{
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">
                        Error: Usuário ou senha inválidos!
                      </div>';
}
}
if(isset($_SESSION['msg'])){
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
}

?>
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
  <link rel="stylesheet" href="login.css">
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
                    <h4 class="mt-1 mb-5 pb-1">Olá! Que bom que voltou!</h4>
                  </div>
  
                  <form method="POST" id="login-form" class="form" action= "">
                    <p>Por favor, preencha os campos abaixo</p>
  
                    <div class="form-outline mb-4">
                      <input type="email" id="form2Example11" class="form-control" name="user"
                        placeholder="email" />
                      <label class="form-label" for="form2Example11">usuário</label>
                    </div>
  
                    <div class="form-outline mb-4">
                      <input type="password" id="form2Example22" class="form-control"  name="pass" placeholder="........">
                      <label class="form-label" for="form2Example22">senha</label>
                    </div>
  
                    <!-- <div class="text-center pt-1 mb-5 pb-1"> -->
                    <input type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" name="btnlogin" value="Log in">                     
                      <a class="text-muted" href="#!">Esqueceu a senha?</a>
                    <!-- </div> -->
  
                    <div class="d-flex align-items-center justify-content-center pb-4">
                      <p class="mb-0 me-2">Ainda não possui conta?</p>
                      <a href="frmuser"><button type="button" class="btn btn-dark">Registre-se</button></a>
                    </div>
  
                  </form>
  
                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                  <h4 class="mb-4">Nós somos a <strong>Venus Shop</strong></h4>
                  <p class="small mb-0">Um marktplace voltado exclusivamente para empreendedoras mulheres.
                    A Vênus Shop é a plataforma de divulgação da sua loja.</p>
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