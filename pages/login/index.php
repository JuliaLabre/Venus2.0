<!-- Cabeçalho -->
<?php
require '../../includes/header.php';
include_once '../../includes/config.php';

session_start();
ob_start();

/* Se usuário já está logado:
Ver como vai ser a verificação nesse caso
if (isset($_COOKIE[$c['ucookie']]))

    // Envia o site para o perfil do usuário:
    header('Location: /?profile');*/

$dadoslogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);


if (!empty($dadoslogin['btnlogin'])) {

$buscalogin = "SELECT *
                        FROM users
                        WHERE user_email = :user AND user_status = 'online'
                        LIMIT 1";
           
$resultado= $conn->prepare($buscalogin); 
$resultado->bindParam(':user', $dadoslogin['user'],PDO::PARAM_STR);
$resultado->execute();

if(($resultado) AND ($resultado->rowCount()!= 0)){
    $resposta = $resultado->fetch(PDO::FETCH_ASSOC);
   
// salvando dados na variavel
    if(password_verify($dadoslogin['pass'],$resposta['user_password'])){
      $_SESSION['user_name'] = $resposta['user_name'];
      $_SESSION['user_email'] = $resposta['user_email'];
      $_SESSION['user_birth'] = $resposta ['user_birth'];
      $_SESSION['user_photo'] = $resposta['user_photo'];
      $_SESSION['user_CEPadress'] = $resposta['user_CEPadress'];
      $_SESSION['user_id'] = $resposta['user_id'];
 
      if ($resposta['user_type'] == "user"){
       header("location:../profile");
      } else if ($resposta['user_type'] == "shop"){
          header("location:../shop");
      } else{
        header("location:../admin");
      }
       
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
<!-- Conteúdo -->
<div class="wrap">
<h2 class='text-center'>Faça Login</h2>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
<form method="POST" id="login-form" class="form" action= "">
  <div class="form-group">
    <label for="exampleInputEmail1">Endereço de email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="user" aria-describedby="emailHelp" placeholder="Seu email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Senha</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="pass" placeholder="Senha">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Mantenha-me conectado</label>
  </div>

     <input type="submit" class="btn btn-primary" name="btnlogin" value="Enviar">
  
</form>
</div>
<div class="col-md-4"></div>
</div>
</div>
<hr>
<div class="text-center"> Ainda não é cadastrado ? <a href="../registration">Cadastre-se aqui</a></div>
</div>
<!-- Footer -->
<?php
require '../../includes/footer.php'
?>