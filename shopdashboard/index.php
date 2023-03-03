<?php
require '../shopdashboard/includes/header.php';
require '../shopdashboard/includes/nav.php';
require '../shopdashboard/includes/footer.php';
include_once '../includes/config.php';




$shop_id = $_SESSION['shop_id'];
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
                  <h2 class="pageheader-title">Olá, <?php echo $_SESSION['shop_name']?>! </h2>
                </div>
              </div>
            </div>

            <!-- Total de clientes -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-inline-block">
                    <h5 class="text-muted">Total de clientes</h5>
                    <?php

$totaldeclientes ="SELECT COUNT(s.sale_client) as clientes FROM sale s 
INNER JOIN request r ON s.sale_id= r.req_sale
INNER JOIN delivery d ON s.sale_id=d.deli_sale
INNER JOIN products p ON r.req_prod=p.prod_id 
INNER JOIN category c ON c.cat_id = p.prod_cat
INNER JOIN users u ON s.sale_client=u.user_id
WHERE p.shop = $shop_id";

$tclientes= $conn->prepare($totaldeclientes); 
$tclientes->execute();

$clientes = $tclientes->fetch(PDO::FETCH_ASSOC);

?>
                    <h2 class="mb-0"><?php echo $clientes['clientes'] ?></h2>
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
  <?php

  $totaldevendas ="SELECT SUM(r.req_value) as vendas FROM sale s 
  INNER JOIN request r ON s.sale_id= r.req_sale
  INNER JOIN delivery d ON s.sale_id=d.deli_sale
  INNER JOIN products p ON r.req_prod=p.prod_id 
  INNER JOIN category c ON c.cat_id = p.prod_cat
  INNER JOIN users u ON s.sale_client=u.user_id
  WHERE p.shop = $shop_id";

$tvendas= $conn->prepare($totaldevendas); 
$tvendas->execute();

$valortotal = $tvendas->fetch(PDO::FETCH_ASSOC);

?>

                    <h2 class="mb-0"><?php echo $valortotal['vendas'] ?></h2>
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
                    <?php

$totaldepedidos ="SELECT COUNT(r.req_id) as pedidos FROM sale s 
INNER JOIN request r ON s.sale_id= r.req_sale
INNER JOIN delivery d ON s.sale_id=d.deli_sale
INNER JOIN products p ON r.req_prod=p.prod_id 
INNER JOIN category c ON c.cat_id = p.prod_cat
INNER JOIN users u ON s.sale_client=u.user_id
WHERE p.shop = $shop_id";

$tpedidos= $conn->prepare($totaldepedidos); 
$tpedidos->execute();

$pedidos = $tpedidos->fetch(PDO::FETCH_ASSOC);

?>


                    <h2 class="mb-0"><?php echo $pedidos['pedidos'] ?></h2>
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