<?php
session_start();
ob_start();
?>

<!doctype html>
<html lang="pt-br">
 
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
      <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
      <link rel="stylesheet" href="assets/libs/css/style.css">
      <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
      <title>Dashboard Lojista - Venus Shop</title>
  </head>

  <body>

    <header>

      <!---------- 
        Top Menu 
      ----------->

      <div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
          <!-- Logo Venus Shop -->
          <a class="navbar-brand" href="index.php"><img src="../img/logo-principal.png" width="100px" heigth="30px" alt="Logo da VenusShop" title="Venus Shop"></a>
          <!-- ícone Dropdown -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Dropdown usuário --> 
          <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-right-top">
              <li class="nav-item dropdown nav-user">
                <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                  <div class="nav-user-info">
                    <h5 class="mb-0 text-white nav-user-name">Nome da Loja </h5>
                    <span class="status"></span><span class="ml-2">Ativa</span>
                  </div>
                  <a class="dropdown-item" href="/shopdashboard/pages/profile.php"><i class="fas fa-user mr-2"></i>Perfil</a>
                  <a class="dropdown-item" href="/shopdashboard/pages/settings.php"><i class="fas fa-cog mr-2"></i>Configurações</a>
                  <a class="dropdown-item" href="../exit"><button type="submit"><i class="fas fa-power-off mr-2"></i>Sair</button></a>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>