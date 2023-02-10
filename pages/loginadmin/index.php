<!-- Cabeçalho -->
<?php
include_once '../../includes/config.php';

session_start();
ob_start();

/* Se usuário já está logado:
Ver como vai ser a verificação nesse caso
if (isset($_COOKIE[$c['ucookie']]))

    // Envia o site para o perfil do usuário:
    header('Location: /?profile');*/


$dadoslogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo "123".password_hash(123,PASSWORD_DEFAULT);

if (!empty($dadoslogin['btnlogin'])) {

$buscalogin = "SELECT * FROM admin WHERE  admin_email = :user";
           
$resultado= $conn->prepare($buscalogin); 
$resultado->bindParam(':user', $dadoslogin['user'],PDO::PARAM_STR);
$resultado->execute();

if(($resultado) AND ($resultado->rowCount()!= 0)){
    $resposta = $resultado->fetch(PDO::FETCH_ASSOC);
    //var_dump($resposta);

// salvando dados na variavel
//o passwordverify so funcionou com 123,tentei a senha admin e ele não conseguiu verificar
    if(password_verify($dadoslogin['pass'],$resposta['admin_password'])){     
     
       header("location:../admin");
     
    }else{

     var_dump($dadoslogin);
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
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>



  </header>

  <section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="../../img/admin.svg" class="img-fluid" alt="Logotipo Venus Shop">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form method= "post" action="">
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" id="form1Example13" class="form-control form-control-lg" name="user">
            <label class="form-label" for="form1Example13">Email address</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
            <input type="password" id="form1Example23" class="form-control form-control-lg" name="pass">
            <label class="form-label" for="form1Example23">Password</label>
          </div>

          <input type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" name="btnlogin" value="Log in">

        </form>
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