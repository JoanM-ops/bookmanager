<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Tienda.php';

$basePath = '../..';
$paginaActual = 'tiendas';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = (new Database())->getConnection();
        $tiendaModel = new Tienda($db);
        $tiendaModel->create($_POST);
        header('Location: index.php?msg=ok');
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="container-fluid" style="max-width: 720px;">
    <h1 class="h3 fw-bold mb-4">Registrar Nueva Tienda</h1>

    <?php if ($error !== ''): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">ID Tienda (máx. 4 chars) *</label>
                        <input type="text" name="id_tienda" maxlength="4" class="form-control" required
                               value="<?= htmlspecialchars($_POST['id_tienda'] ?? '') ?>">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Nombre de la Tienda *</label>
                        <input type="text" name="nombre_tienda" class="form-control" required
                               value="<?= htmlspecialchars($_POST['nombre_tienda'] ?? '') ?>">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Dirección</label>
                        <input type="text" name="direcc_tienda" class="form-control"
                               value="<?= htmlspecialchars($_POST['direcc_tienda'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ciudad</label>
                        <input type="text" name="ciudad" class="form-control"
                               value="<?= htmlspecialchars($_POST['ciudad'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Estado</label>
                        <input type="text" name="estado" maxlength="2" class="form-control"
                               value="<?= htmlspecialchars($_POST['estado'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">País</label>
                        <input type="text" name="pais" class="form-control"
                               value="<?= htmlspecialchars($_POST['pais'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Código Postal</label>
                        <input type="text" name="cod_postal" maxlength="5" class="form-control"
                               value="<?= htmlspecialchars($_POST['cod_postal'] ?? '') ?>">
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Guardar Tienda</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>