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
        $tiendaModel->update($id, $_POST);
        header('Location: index.php?msg=ok');
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
        $tienda = array_merge($tienda, $_POST);
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="container-fluid" style="max-width: 720px;">
    <h1 class="h3 fw-bold mb-4">Editar Tienda (<?= htmlspecialchars($tienda['id_tienda']) ?>)</h1>

    <?php if ($error !== ''): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">ID Tienda</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($tienda['id_tienda']) ?>" disabled>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Nombre de la Tienda *</label>
                        <input type="text" name="nombre_tienda" class="form-control" required
                               value="<?= htmlspecialchars($tienda['nombre_tienda']) ?>">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Dirección</label>
                        <input type="text" name="direcc_tienda" class="form-control"
                               value="<?= htmlspecialchars($tienda['direcc_tienda'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ciudad</label>
                        <input type="text" name="ciudad" class="form-control"
                               value="<?= htmlspecialchars($tienda['ciudad'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Estado</label>
                        <input type="text" name="estado" maxlength="2" class="form-control"
                               value="<?= htmlspecialchars($tienda['estado'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">País</label>
                        <input type="text" name="pais" class="form-control"
                               value="<?= htmlspecialchars($tienda['pais'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Código Postal</label>
                        <input type="text" name="cod_postal" maxlength="5" class="form-control"
                               value="<?= htmlspecialchars($tienda['cod_postal'] ?? '') ?>">
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">Actualizar Tienda</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>