<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Tienda.php';

$basePath = '../..';
$paginaActual = 'tiendas';
$error = '';

$id = $_GET['id'] ?? '';
$db = (new Database())->getConnection();
$tiendaModel = new Tienda($db);
$tienda = $tiendaModel->getById($id);

if (!$tienda) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $tiendaModel->delete($id);
        header('Location: index.php?msg=ok');
        exit;
    } catch (PDOException $e) {
        $error = 'No se puede eliminar esta tienda porque tiene registros relacionados.';
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="container-fluid" style="max-width: 560px;">
    <div class="card border-danger shadow-sm">
        <div class="card-header bg-danger text-white fw-bold">Confirmar Eliminación</div>
        <div class="card-body">
            <?php if ($error !== ''): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <p>¿Estás seguro de que deseas eliminar la tienda <strong><?= htmlspecialchars($tienda['nombre_tienda']) ?></strong> (ID: <code><?= htmlspecialchars($tienda['id_tienda']) ?></code>)?</p>

            <form method="POST" action="" class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">Sí, Eliminar</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>