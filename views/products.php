<?php
require_once "controllers/ProductController.php";
require_once "models/Product.php";

$productController = new ProductController();
$products = $productController->findAll();

// Verificar se existe uma mensagem definida na sessão
if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "')</script>";
    unset($_SESSION['message']); // Limpar a variável de sessão após exibir o alerta
}
?>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between mb-3">
                <h1 class="text-center mb-0">Lista de Produtos</h1>
                <a href="?page=form_products" class="btn btn-success" role="button">Cadastrar</a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php  foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product->getId()); ?></td>
                        <td><?php echo htmlspecialchars($product->getName()); ?></td>
                        <td>
                            <a class="" href="?page=form_product&id=<?php echo $product->getId(); ?>">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="" href="?page=delete_product&id=<?php echo $product->getId(); ?>" onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
