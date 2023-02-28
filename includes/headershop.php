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
          <a class="navbar-brand" href="../shop"><img src="../../img/logo-2.png" alt="Logo da VenusShop" title="Venus Shop"></a>
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
            <a <?php echo "href='../editshop?id=$shop_id'" ?> class="nav-link"><b>Editar Perfil da loja</b></a>
            </li>
            <li class="nav-item active">
            <a href='../cadprod' class="nav-link"><b>Cadastrar Produto</b></a>
            </li>
            <li class="nav-item active">
            <a  <?php echo "href='../shopprod?id=$shop_id'" ?> class="nav-link" href="#"><b>Produtos cadastrados</b></a>
            </li>
           
        </ul>

      </nav>

    </header>