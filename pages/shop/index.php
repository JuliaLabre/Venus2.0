<?php
session_start();
ob_start();

//require '../../includes/header.php';
include_once '../../includes/config.php';

$shop_id = $_SESSION['shop_id'];

include_once '../../includes/headershop.php';


$produtos = "SELECT * FROM sale s 
INNER JOIN request r ON s.sale_id= r.req_sale
INNER JOIN delivery d ON s.sale_id=d.deli_sale
INNER JOIN products p ON r.req_prod=p.prod_id 
INNER JOIN category c ON c.cat_id = p.prod_cat
INNER JOIN users u ON s.sale_client=u.user_id
WHERE p.shop = $shop_id ORDER BY sale_date DESC";
           
$resultado= $conn->prepare($produtos); 
$resultado->execute();

?>

<!-- Podemos acrescentar um botão pra ver os produtos offline, e a questão do estoque, se ele tiver zerado, ter alguma coisa diferente.  -->
<!-- Pensei em um menu ao lado com opções do que ele pode fazer, como editar os produtos, cadastrar produtos e na area principal pode ficar os produtos mais vendidos-->

<main>
<div class="perfil-bonito">
  <h2 class='text-center'>Olá, <?php echo $_SESSION['shop_name']?>!</h2>
   <div class="perfil">

   <?php
   if (!empty($_SESSION['shop_photo'])) :
    ?>
       <a title="Editar foto" <?php echo "href='../editshopft?id=$shop_id'"?>>
        <img src="<?php echo $_SESSION['shop_photo'] ?>"width="150" height="150"> 
      </a>
      <?php
      // Se não está logado...
      else :
      ?>
      <a <?php echo "href='../editshopft?id=$shop_id'"?>><button type="submit" class="btn">Carregue a foto da sua loja</button></a>
    
<?php
      endif;
      ?>
     
      <ul>
        <li><?php echo $_SESSION['shop_name'] ?></li>
        <li>Membro desde <?php echo $_SESSION['datebr'] ?></li>
        <li>Total de itens vendidos : </li>
      </ul>
    </div>
</div>

<h2 class="text-center">Ultimas vendas:</h2>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Foto</th>
      <th scope="col">Nome</th>
      <th scope="col">Valor</th>
      <th scope="col">Quantidade</th>
      <th scope="col">CEP da Entregue</th>
      <th scope="col">Numero da casa</th>
      <th scope="col">Complemento</th>
      <th scope="col">Status</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
 
<?php

if(($resultado) AND ($resultado->rowCount()!= 0)){
   while($resposta = $resultado->fetch(PDO::FETCH_ASSOC)){

   extract($resposta);

?> 

 <tr>
        <td scope="row">
          <a title="Editar foto" <?php echo "href='../editprodft?id=$prod_id'"?>>
            <img src="<?php echo $prod_photo ?>" width="150" height="150">
          </a>
        </td>
        <td> <?php echo $prod_name ?> </td>
        <td><?php echo $req_value ?></td>
        <td><?php echo $req_quant ?></td>
        <td><?php echo $user_CEPadress ?></td>
        <td><?php echo $user_num ?></td>
        <td><?php echo $user_comp ?></td>
        <td><?php echo $deli_status ?></td>
        <td>


        <?php 
        if($deli_status == 'Em Separação'){
         echo "<a href='../deliprod?id=$deli_id'>"; 
         ?>
         <form action="" method="post">
         <input type="hidden" name="del_id" value="<?php echo $deli_id ?>">
          <input type="submit" class="btn btn-primary" name="enviado" value="Produto enviado">
          </form></a>
<?php
        }if($deli_status == 'Em Trânsito'){       
         
          ?>
          <form action="" method="post">
            <input type="hidden" name="del_id" value="<?php echo $deli_id ?>">
          <input type="submit" class="btn btn-primary" name="entregue" value="Entregue">
          </form></a>
        <?php
        }
        ?> 
        
     
        </td>
      </tr>

<?php
  }

}
?>
   
   </tbody>
 </table>


<?php
$delivery = filter_input_array(INPUT_POST, FILTER_DEFAULT);
// Se o formulário foi enviado:
  if (isset($_POST['enviado'])) :
    $vazio = false;
    $delivery = array_map('trim', $delivery);
    $date = date('y-m-d');

    if (!$vazio) {
     // Monta SQL para salvar contato no banco de dados:
    $sql = "UPDATE delivery SET deli_status='Em Trânsito', deli_date=:date
    WHERE deli_id = :id";

  $salvar= $conn ->prepare($sql);
  $salvar -> bindParam(':date', $date,PDO::PARAM_STR);
  $salvar -> bindParam(':id', $delivery['del_id'],PDO::PARAM_INT);
  $salvar -> execute();


  if ($salvar->rowCount()) {
      
      echo "<script>
        alert('Status de Entrega atualizado!');
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

if (isset($_POST['entregue'])) :
  $vazio = false;
  $delivery = array_map('trim', $delivery);
  $date = date('y-m-d');

  if (!$vazio) {
   // Monta SQL para salvar contato no banco de dados:
  $sql = "UPDATE delivery SET deli_status='Entregue', deli_date=:date
  WHERE deli_id = :id";

$salvar= $conn ->prepare($sql);
$salvar -> bindParam(':date', $date,PDO::PARAM_STR);
$salvar -> bindParam(':id', $delivery['del_id'],PDO::PARAM_INT);
$salvar -> execute();


if ($salvar->rowCount()) {
    
    echo "<script>
      alert('Status de Entrega atualizado!');
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





if(!isset($_SESSION['shop_name'])){
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">
  Erro: Necessário realizar login
 </div>';
  header("Location: ../login");
}
?>

<a href="../exit"><button type="submit">Sair</button></a>

<?php
require '../../includes/footer.php';
?>
