<!-- Cabeçalho -->
<?php
include_once '../../includes/config.php';

$dadoslogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo "123".password_hash(123,PASSWORD_DEFAULT);
//var_dump($dadoslogin);

if (!empty($dadoslogin['btnlogin'])) {

$buscalogin = "SELECT * FROM users WHERE user_email = :admin AND user_type = 'admin' LIMIT 1";
           
$resultado= $conn->prepare($buscalogin); 
$resultado->bindParam(':admin', $dadoslogin['admin'],PDO::PARAM_STR);
$resultado->execute();

//Não ta reconhecendo o usuario
if(($resultado) AND ($resultado->rowCount()!= 0)){
    $resposta = $resultado->fetch(PDO::FETCH_ASSOC);
   echo 'aqui';

// salvando dados na variavel
//o passwordverify so funcionou com 123,tentei a senha admin e ele não conseguiu verificar
    if(password_verify($dadoslogin['passw'],$resposta['user_password'])){     
     
       header("location:../admin");
     
    }else{

     //var_dump($dadoslogin);
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

  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>



  </header>

  <section class="vh-100">

      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form method= "post" action="">
        <div class="caixa__login">
        <h2>Administrativo</h2>
        <form>
            <div class="caixa__login-input">
            <input type="email" id="form1Example13" class="form-control form-control-lg" name="admin">
            <label class="form-label" for="form1Example13">Email address</label>
            </div>
            <div class="caixa__login-input">
            <input type="password" id="form1Example23" class="form-control form-control-lg" name="passw">
            <label class="form-label" for="form1Example23">Password</label>
            </div>
            <a>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
    
                <input type="submit" class="btn btn-primary" name="btnlogin" value="Enviar">
            </a>
        </form>
    </div>


  <footer>



  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>