<?php
require '../../includes/header.php';
include_once '../../includes/config.php';

$id = $_SESSION['user_id'];

$busca= "SELECT *
    FROM favorite f, products p  WHERE 
    f.fav_user = $id AND
    p.prod_status = 'online' AND p.prod_stock > 0  AND f.fav_prod = p.prod_id";

    $resultado = $conn->prepare($busca);
    $resultado->execute(); 

?>
<!-- Conteudo -->
<div class="wrap">
<h2 class='text-center'>Favoritos de <?php echo $_SESSION['user_name'];?></h2>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Imagem do produto</th>
      <th scope="col">Nome</th>
      <th scope="col">Valor</th>  
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
<td scope="row">
  <img src="<?php echo $prod_photo ?>" width="150" height="150">
</td>
<td> <?php echo $prod_name ?> </td>
<td>$<?php echo $prod_price ?></td>
<td>
<?php echo "<a href='../cart?id=$prod_id'>"; ?>
<input type="submit" class="btn btn-success" name="cart" value="Adicionar ao carrinho">
</td>
<td>
<?php echo "<a href='../favorite?id=$prod_id'>" ?>
<input type="submit" class="btn btn-danger" name="delete" value="Remover dos favoritos">
</td>
</tr>    

  <?php
  }

}
?>
  </tbody>
 </table>
 </div>

<?php
require '../../includes/footer.php'
?>