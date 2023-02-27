<?php
require '../../includes/header.php';
include_once '../../includes/config.php';

$contacts = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//Preciso de um jeito de identificar o tipo de usuario que vai receber qui precisa ser o admin



// Se o formulário foi enviado:
if (isset($_POST['send'])) :
    $vazio = false;
    $contacts = array_map('trim', $contacts);
    //var_dump($contacts);

    if (!$vazio) {
     // Monta SQL para salvar contato no banco de dados:
    $sql = "INSERT INTO contacts (name, email, subject, message,receiver)VALUES(:name,:email,:subject,:message,6)";

  $salvar= $conn ->prepare($sql);
  $salvar -> bindParam(':name', $contacts['name'],PDO::PARAM_STR);
  $salvar -> bindParam(':email', $contacts['email'],PDO::PARAM_STR);
  $salvar -> bindParam(':subject', $contacts['subject'], PDO::PARAM_STR);
  $salvar -> bindParam(':message', $contacts['message'], PDO::PARAM_STR);
  $salvar -> execute();


  if ($salvar->rowCount()) {
      
      echo "<script>
      alert('Seu contato foi enviado com sucesso. Obrigado...');
      parent.location = '/';
      </script>";

      unset($contacts);
  } else {
      echo "<script>
      alert('Erro: Tente novamente');   
      </script>";
      
  }

}

// if (isset($_POST['send'])) :
endif;

?>
<div class="container">
    <div class="col-md-3"></div>
    <div class="col-md-6" >
    <h2 class='text-center'>Faça contato com a Venus Shop</h2>

        <form method="post" action="">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="nameContacts">Nome</label>
                <input name="name" type="text" class="form-control" id="nameContacts" placeholder="Nome" required minlength="3">
            </div>


            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="emailContacts">Email</label>
                <input name="email" type="email" class="form-control" id="emailContacts"placeholder="Email" aria-describedby="inputGroupPrepend2" required>

            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="subjectContacts">Assunto</label>
                <input name="subject" type="text" class="form-control" id="subjectContacts" placeholder="Assunto" required minlength="5">
            </div>
            <div class="form-group row">
                <label for="messagesubjectContacts" class="col-sm-2 col-form-label">Mensagem</label>
                <textarea name="message" class="form-control" id="messagesubjectContacts" rows="3" minlength="5" placeholder="Sua mensagem aqui..." required></textarea>
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" value='enviar' name='send'>
            </div>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>




<?php
require '../../includes/footer.php'
?>