<?php
include_once '../../includes/config.php';
session_start();
ob_start();

$user_id = $_SESSION['user_id'];

?>
<h2 class="text-center">Alterações</h2>

<form method="POST" action="../updateprod/index.php">
            <div class="form-row">
             <div class="col-md-4 mb-3">
                    <label>Nome do Produto</label>
                    <input name="name" type="text" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Foto do Produto</label>
                    <input name="photo" type="text" class="form-control"required>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label>Preço do Produto</label>
                    <input name="price" type="text" class="form-control" required>
                </div>   

            </div>

            <div class="form-row">
                
                <div class="col-md-4 mb-3">
                    <label>Quantidade em Estoque</label>
                    <input name="stock" type="number" class="form-control" required>
                </div>
             
                <div class="col-md-4 mb-3">
                    <label>Descrição do Produto</label>
                    <input name="desc" type="text" class="form-control" required>
                </div>

            </div>

            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label>Categoria</label>
                    <input name="cat" type="text"  class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Status</label>
                    <select name="status" class="custom-select">
                        <option selected>Status</option>
                        <option type="radio" value="online">Online</option>
                        <option type="radio" value="offline">Offline</option>
                    </select>                    
                </div>                
            </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                            <label class="form-check-label" for="invalidCheck2">
                               Cadastrar o produto.
                            </label>
                        </div>
                    </div>
                </div>

                <input class="btn" type="submit" value="Editar" name="btncad">
        </form>