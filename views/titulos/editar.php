<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Titulo.php';

$basePath = '../..';
$paginaActual = 'titulos';
$error = '';

$id = $_GET['id'] ?? '';
$db = (new Database())->getConnection();
$tituloModel = new Titulo($db);
$libro = $tituloModel->getById($id);
$publicadores = $tituloModel->getPublicadores();

if (!$libro) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $tituloModel->update($id, $_POST);
        header('Location: index.php?msg=ok');
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
        $libro = array_merge($libro, $_POST);
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="container-fluid" style="max-width: 720px;">
    <h1 class="h3 fw-bold mb-4">Editar Título (<?= htmlspecialchars($libro['id_titulo']) ?>)</h1>

    <?php if ($error !== ''): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">ID Título</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($libro['id_titulo']) ?>" disabled>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Nombre del Libro *</label>
                        <input type="text" name="titulo" class="form-control" required
                               value="<?= htmlspecialchars($libro['titulo']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Editorial (Publicador)</label>
                        <select name="id_pub" class="form-select">
                            <option value="">-- Seleccione una editorial --</option>
                            <?php foreach ($publicadores as $pub): ?>
                                <option value="<?= htmlspecialchars($pub['id_pub']) ?>"
                                    <?= (($libro['id_pub'] ?? '') === $pub['id_pub']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($pub['nombre_pub']) ?> (<?= htmlspecialchars($pub['id_pub']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Categoría</label>
                        <input type="text" name="tipo" class="form-control"
                               value="<?= htmlspecialchars($libro['tipo'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Precio ($) *</label>
                        <input type="number" step="0.01" min="0" name="precio" class="form-control" required
                               value="<?= htmlspecialchars((string) ($libro['precio'] ?? '0')) ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Fecha de Publicación</label>
                        <input type="date" name="fecha_pub" class="form-control"
                               value="<?= htmlspecialchars(substr((string) ($libro['fecha_pub'] ?? ''), 0, 10)) ?>">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Notas</label>
                        <input type="text" name="notas" class="form-control"
                               value="<?= htmlspecialchars($libro['notas'] ?? '') ?>">
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">Actualizar Título</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>