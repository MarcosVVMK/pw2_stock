<?php
require_once "controllers/StockController.php";
require_once "models/Product.php";

$stockController = new StockController();
$stocks = $stockController->findAll();

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
                <h1 class="text-center mb-0">Estoque</h1>
                <a href="?page=form_stock" class="btn btn-success" role="button" >Cadastrar</a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php  foreach ($stocks as $stock): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($stock->getStockId()); ?></td>
                        <td><?php echo htmlspecialchars($stock->getProduct()->getName()); ?></td>
                        <td><?php echo htmlspecialchars($stock->getProduct()->getCategory()->getName()); ?></td>
                        <td><?php echo htmlspecialchars($stock->getQuantity()); ?></td>
                        <td>
                            <a class="" href="?page=form_stock&id=<?php echo $stock->getStockId(); ?>">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="" href="?page=delete_stock&id=<?php echo $stock->getStockId(); ?>"
                               onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
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
