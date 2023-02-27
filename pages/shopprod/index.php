<?php
session_start();
ob_start();

//require '../../includes/header.php';
include_once '../../includes/config.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$shop_id = $id;
include_once '../../includes/headershop.php';


$produtos = "SELECT p.prod_id, p.prod_name,p.prod_photo, p.prod_price, p.prod_size, p.prod_stock, p.prod_desc, p.prod_status, c.cat_name
     FROM products p, category c 
     WHERE shop = $id 
     AND p.prod_cat = c.cat_id AND prod_status != 'banned' AND prod_status != 'deleted' ";
           
$resultado= $conn->prepare($produtos); 
$resultado->execute();

?>
<h2 class="text-center">Seus Produtos</h2>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Foto</th>
      <th scope="col">Nome</th>
      <th scope="col">Valor</th>
      <th scope="col">Tamanho</th>
      <th scope="col">Quantidade</th>      
      <th scope="col">Descrição</th>
      <th scope="col">Categoria</th>
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
        <td><?php echo $prod_price ?></td>
        <td><?php echo $prod_size ?></td>
        <td><?php echo $prod_stock ?></td>
        <td><?php echo $prod_desc ?></td>
        <td><?php echo $cat_name ?></td>
        <td><?php echo $prod_status ?></td>
        <td>
        <?php echo "<a href='../editprod?id=$prod_id'>"; ?>
        <input type="submit" class="btn btn-primary" name="edit" value="Editar">
        </td>
        <td>
        <?php echo "<a href='../delprod?id=$prod_id'>" ?>
        <input type="submit" class="btn btn-danger" name="delete" value="Excluir">
        </td>
      </tr>

<?php
  }

}
?>
   
   </tbody>
 </table>


<?php
if(!isset($_SESSION['shop_name'])){
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">
  Erro: Necessário realizar login
 </div>';
  header("Location: ../login");
}
?>

<a href="../shop"><button type="submit">Voltar</button></a>
