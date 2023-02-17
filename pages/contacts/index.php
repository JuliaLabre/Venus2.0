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
<div class="wrap">
    <h2 class='text-center'>Faça contato</h2>
    <div class="container">
      
        <form method="post" action="" >

            <div class="form-row"> 
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01">Nome Completo</label>
                    <input name="name" type="text" class="form-control" id="validationDefault01" placeholder="Nome" required>
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
                    <label for="validationDefault01">Assunto</label>
                    <input name="subject" type="text" class="form-control" id="validationDefault01" placeholder="Assunto" required >
                </div>
                <div class="form-row"> 
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01">Mensagem</label>
                    <input name="message" type="text" class="form-control" id="validationDefault01" placeholder="Sua mensagem aqui..." required>
                </div>

            
            <div class="form-row">
                  <div class="col-md-12 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                            <label class="form-check-label" for="invalidCheck2">
                                <p>Desejo fazer contato</p>
                            </label>
                        </div>
                    </div>
          
            <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <input class="btn btn-primary btn-lg btn-block-cad" type="submit" value='enviar' name='send' >
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