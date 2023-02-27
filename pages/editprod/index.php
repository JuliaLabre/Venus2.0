<?php
include_once '../../includes/config.php';

session_start();
ob_start();

//dando erro na categoria e estoque
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    $_SESSION['msg'] = "Erro: Produto não encontrado";
    header("Location: ../shop");
    exit();
}

$sql =  "SELECT * FROM products WHERE prod_id = $id LIMIT 1";
           
$resultado= $conn->prepare($sql); 
$resultado->execute();

if(($resultado) AND ($resultado->rowCount()!= 0)){
    $linha = $resultado->fetch(PDO::FETCH_ASSOC);
    //var_dump($linha);
    extract($linha);

}else{
    $_SESSION['msg'] = "Erro: Produto não encontrado";
    header("Location: ../shop");
}
?>

<!-- INICIO DO HTML -->

<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <link rel="icon" href="../../img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venus Shop - O Sistema Delas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="stylesheet" href="../../layout2.css">
  </head>

  <body>

    <header>

      <nav class="navbar navbar-expand-lg navbar-light">
        <!--Nome + Icon-->
          <a class="navbar-brand" href="/"><img src="../../img/logo-2.png" alt="Logo da VenusShop" title="Venus Shop"></a>
          <!--Dropdown para telas menores-->  		
          <button type="button" data-target="#conteudoNavbarSuportado" data-toggle="collapse" class="navbar-toggle">
            <span class="navbar-toggler-icon"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <!-- Menu de links, usuário, pesquisa e adicionais -->
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
          <ul class="nav navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="../../pages/about"><b>quem somos</b></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="../../pages/aboutshop"><b>você&venus</b></a>
            </li>
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b>categorias</b></a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">					
                <a class="dropdown-item" href="#">moças</a>
                <a class="dropdown-item" href="#">pets</a>
                <a class="dropdown-item" href="#">beleza</a>
                <a class="dropdown-item" href="#">deco&casa</a>
                <a class="dropdown-item" href="#">escritório</a>
              </div>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#"><b>lojas</b></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#"><b>contato</b></a>
            </li>
          </ul>
        </div>
        <!--Barra de pesquisa-->
        <form id="search-box">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="pesquise em venus" name="search">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search" title="pesquisar"></i></button>
            </div>
          </div>
        </form>
        <ul class="nav navbar-nav navbar-inline" id="iuserm">
          
      <!-- Area do usuário  -->
      <?php 
     
     // Se o usuário está logado...
     if (isset($_SESSION['user_name'])) :

     ?>
            <!--Perfil do usuário logado e tiver foto-->
            <li class="dropdown-user navbar-inline nav-profile">
              <a href="#" data-toggle="dropdown" class="dropdown-toggle user-action">
              <?php
                if (!empty($_SESSION['user_photo'])):
                  ?>
              <img src="../../pages/photousers/<?php echo $_SESSION['user_photo']?>">
              </a>
              <?php 
                else:
                  ?>
             <i class="fa-solid fa-circle-user" title="minha conta" alt="Minha conta"></i></a>
  
             <?php
               endif;
               ?>
              <ul class="dropdown-menu">
                <li class="nav-profile">
                  <?php
                if (!empty($_SESSION['user_photo'])):
                  ?>                
                <li class="nav-profile"><a href="../../pages/profile"><img src="../../pages/photousers/<?php echo $_SESSION['user_photo'] ?>">meu perfil</a></li>
                <?php 
                else:
                  ?>
                   <li><a href="../../pages/profile"><i class="fa-solid fa-user-astronaut"></i> meu perfil</a></li>                
                
               <?php
               endif;
               ?>
                <li><a href="#"><i class="fa-solid fa-bag-shopping"></i> continue comprando</a></li>
                <li><a href="#"><i class="fa-solid fa-heart"></i> favoritos</a></li>
                <li><a href="#"><i class="fa-solid fa-cart-shopping"></i> minhas compras</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa-solid fa-circle-question"></i> ajuda</a></li>
                <li><a href="#"><i class="fa-solid fa-gear"></i> configurações</a></li>
                <li class="divider"></li>
                <li><a href="../../pages/exit"><i class="fa-solid fa-right-from-bracket"></i> <b>sair</b></a></li>
              </ul>
            </li>
            <?php

      // Se não está logado...
      else :

      ?>
      <li>
      <li class="nav-item">
      <a class="nav-link" href="../../pages/login"><i class="fa-solid fa-circle-user" title="Fazer Login" alt="Fazer Login"></i></a>

      <?php
      endif;
      ?>

        </ul>
        <form class="form-inline my-2 my-lg-0" id="btnsair">
          <a href="../exit"><button type="button" class="btn">Logout</button></a>
        </form>
      </nav>

    </header>

<main>
<h2 class="text-center">Alterações</h2>
<form method="POST" action="../updateprod/index.php" enctype="multipart/form-data">
            <div class="form-row">
            <input name="id" type="hidden" value=" <?php echo $id ?>">
             <div class="col-md-4 mb-3">
                    <label>Nome do Produto</label>
                    <input name="name" type="text" class="form-control" value="<?php echo $prod_name ?>">
                </div>
                
                <div class="col-md-4 mb-3">
                    <label>Preço do Produto</label>
                    <input name="price" type="text" class="form-control" value="<?php echo $prod_price ?>">
                </div>   

            </div>

            <div class="form-row">
                
                <div class="col-md-4 mb-3">
                    <label>Quantidade em Estoque</label>
                    <input type="number" name="stock" class="form-control" value="<?php echo $prod_stock ?>">
                </div>
             
                <div class="col-md-4 mb-3">
                    <label>Descrição do Produto</label>
                    <input name="desc" type="text" class="form-control" required value="<?php echo $prod_desc ?>">
                </div>

            </div>

            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label>Categoria</label>             
                    <select class="form-control" name="cat">
    <?php 
    
    $cat = $prod_cat;

    $sql = "SELECT * FROM category";

    $result= $conn->prepare($sql); 
    $result->execute();

    if(($result)&&($result->rowCount()!=0)) { 
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
                extract($linha);

    ?>                
            <option value="<?php echo $cat_id ?>"
                
                <?php
                if($cat == $cat_id){
                    echo "selected";
                }

                ?>                
                >
                <?php echo $cat_name?></option>
    <?php
            }
        }
    ?>
                     </select> 
                    
                </div>
                <div class="col-md-4 mb-3">
                    <label>Tamanho</label>
                    <input name="size" type="text" class="form-control" value="<?php echo $prod_size ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label>Status</label>
                    <select name="status" class="custom-select" required>
                        <option <?php if('online' == $prod_status){ echo "selected";}?> type="radio" value="online">Online</option>
                        <option <?php if('offline' == $prod_status){ echo "selected";}?> type="radio" value="offline">Offline</option>
                    </select>                    
                </div>                
            </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                            <label class="form-check-label" for="invalidCheck2">
                              Fazer Alterações.
                            </label>
                        </div>
                    </div>
                </div>

                <input class="btn btn-primary btn-lg btn-block" type="submit" value='Editar' name="btnedit">
                
        </form>

        <a href="../shop" ><input class="btn btn-primary btn-lg btn-block" type="submit" value="Sair"></a>
</main>
