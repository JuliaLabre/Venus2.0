<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <link rel="icon" href="../../img/icondosite.png">
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
          <a class="navbar-brand" href="/"><img src="../../img/logo-principal.png" alt="Logo da VenusShop" title="Venus Shop"></a>
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
                <a class="dropdown-item" href="../../pages/category?id=1">moças</a>
                <a class="dropdown-item" href="../../pages/category?id=2">pets</a>
                <a class="dropdown-item" href="../../pages/category?id=3">beleza</a>
                <a class="dropdown-item" href="../../pages/category?id=4">deco&casa</a>
                <a class="dropdown-item" href="../../pages/category?id=5">artesanato</a>
              </div>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="../../pages/navshops"><b>lojas</b></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="../../pages/contacts"><b>contato</b></a>
            </li>
          </ul>
        </div>
        <!--Barra de pesquisa-->
        <form id="search-box" method="post" action="../../pages/search/index.php">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="pesquise em venus" name="search" required >
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search" title="pesquisar"></i></button>
            </div>
          </div>
        </form>
        <!--Sacola de compras-->
        <ul class="nav navbar-nav navbar-inline" id="iuserm">
          <li class="nav-item">
            <a class="nav-link" href="#" id="notifications"><i class="fa-solid fa-inbox" title="mensagens" alt="Mensagens"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="shopicon"><i class="fa-solid fa-bag-shopping" title="continue comprando" alt="Minha sacola"></i>
              <span class="badge">10</span>
            </a>
          </li>
          
      <!-- Area do cliente  -->
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
        <form class="form-inline my-2 my-lg-0" id="btnvender">
          <a href="../../pages/frmshop"><button type="button" class="btn btn-dark">quero vender</button></a>
        </form>
      </nav>

    </header>
