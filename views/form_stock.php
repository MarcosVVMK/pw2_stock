<?php
require_once "controllers/StockController.php";
require_once "controllers/ProductController.php";

// Inicia a sessão
if (isset($_GET["id"])) {
    $stockController = new StockController();
    $stock = $stockController->findById($_GET["id"]);
}

if (
        isset($_POST["id_product"]) &&
        isset($_POST["quantity"]) &&
        $_POST['quantity'] > 0
) {
    $stockController = new StockController();
    $productId = $_POST["id_product"];
    $quantity = $_POST["quantity"];
    $productController = new ProductController();
    $product = $productController->findById($productId);

    if ($product) {
        // Construindo o Produto
        $stock = new Stock(0, $product, $_POST["quantity"]);
    } else {
        echo "Produto não encontrado.";
    }

    $stock->setProduct( $productController->findById( $_POST["id_product"] ) );

    if ( isset($_POST['add']) ) {
        $stockController->addQuantity($stock, $quantity);

    } elseif (isset($_POST['remove'])) {

        $stockController->removeQuantity($stock, $quantity);
    }elseif (isset($_POST['update'])) {

        $stock->setStockId((int)$_GET["id"]);
        $stockController->update($stock);
    }

    // Voltando pra tela anterior
    echo '<script type="text/javascript">
            window.location = "?page=stock";
          </script>';

    // Encerra a execução do script php
    exit();
}
?>

<div class="container mt-2">
    <h1 class="text-center mb-0">Cadastro de Produto</h1>
    <form method="POST">
        <div class="form-group">

            <label for="product">Produto</label>
            <select class="form-control" id="product" name="id_product" required>
                <?php
                $productController = new ProductController();
                $products = $productController->findAll();
                echo "<option value=''>Selecione um produto</option>";

                foreach ($products as $product):
                    $selected = (isset($stock) && $product->getId() === $stock->getProduct()->getId()) ? "selected" : "";

                    echo "<option value='" . $product->getId() . "' " . $selected . ">" . $product->getName() . "</option>";
                endforeach;
                ?>
            </select>
            <label for="quantity">Quantidade</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required
                   value="<?php echo isset($stock) ? $stock->getQuantity() : ''; ?>" step="0">
        </div>
        <?php if (isset($stock)): ?>
            <input type="submit" class="btn btn-primary" id="update" name="update" value="Salvar">
        <?php else: ?>
            <input type="submit" class="btn btn-danger" id="remove" name="remove" value="Retirar">
            <input type="submit" class="btn btn-primary" id="add" name="add" value="Adicionar">
        <?php endif; ?>
    </form>
</div>
