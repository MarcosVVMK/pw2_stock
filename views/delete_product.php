
<?php
require_once "controllers/ProductController.php";

if (isset($_GET["id"])) {
    $productController = new ProductController();
    $productController->delete($_GET["id"]);

    // Voltando pra tela anterior
    // header("Location: ?pg=produtos");
    echo '<script type="text/javascript">
             window.location = "?page=product";
          </script>';
}
