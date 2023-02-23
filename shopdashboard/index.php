<?php
require '../shopdashboard/includes/header.php';
require '../shopdashboard/includes/nav.php';
require '../shopdashboard/includes/footer.php';
include_once '../includes/config.php';
?>

<!-------------------
  SEÇÃO HTML ABERTA
-------------------->

    <main>

      <!-- Div que abraaça todo o conteúdo da page inicial -->
      <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
          <div class="container-fluid dashboard-content ">
            <!-- Cabeçalho boas vindas -->
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                  <h2 class="pageheader-title">Olá, nomedaloja! </h2>
                </div>
              </div>
            </div>

            <!-- Total de clientes -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-inline-block">
                    <h5 class="text-muted">Total de clientes</h5>
                    <h2 class="mb-0"> 150</h2>
                  </div>
                  <div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
                    <i class="fa fa-user fa-fw fa-sm text-primary"></i>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total de vendas -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-inline-block">
                    <h5 class="text-muted">Total de vendas</h5>
                    <h2 class="mb-0"> R$20.000,00</h2>
                  </div>
                  <div class="float-right icon-circle-medium  icon-box-lg  bg-brand-light mt-1">
                    <i class="fa fa-money-bill-alt fa-fw fa-sm text-brand"></i>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total pedidos -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-inline-block">
                    <h5 class="text-muted">Pedidos</h5>
                    <h2 class="mb-0">250</h2>
                  </div>
                  <div class="float-right icon-circle-medium  icon-box-lg  bg-secondary-light mt-1">
                    <i class="fa fa-handshake fa-fw fa-sm text-secondary"></i>
                  </div>
                </div>
              </div>
            </div>


          <!-- fechando as divs lá de cima -->
          </div>
        </div>
      </div>

    </main>

<!----------------------
  SEÇÃO HTML ENCERRADA
----------------------->