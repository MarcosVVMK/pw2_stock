
<?php
require_once "controllers/StockController.php";

if (isset($_GET["id"])) {
    $stockController = new StockController();
    $stockController->delete($_GET["id"]);

    // Voltando pra tela anterior
    echo '<script type="text/javascript">
             window.location = "?page=stock";
          </script>';
}
