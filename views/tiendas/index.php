<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Tienda.php';

$basePath = '../..';
$paginaActual = 'tiendas';

$db = (new Database())->getConnection();
$tiendaModel = new Tienda($db);
$tiendas = $tiendaModel->getAll();

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold mb-0">Gestión de Tiendas</h1>
        <a href="crear.php" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nueva Tienda
        </a>
    </div>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Operación realizada correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Ciudad</th>
                        <th>Estado</th>
                        <th>País</th>
                        <th>Cód. Postal</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tiendas as $t): ?>
                        <tr>
                            <td class="fw-bold"><?= htmlspecialchars($t['id_tienda']) ?></td>
                            <td><?= htmlspecialchars($t['nombre_tienda']) ?></td>
                            <td><?= htmlspecialchars($t['direcc_tienda'] ?? '') ?></td>
                            <td><?= htmlspecialchars($t['ciudad'] ?? '') ?></td>
                            <td><?= htmlspecialchars($t['estado'] ?? '') ?></td>
                            <td><?= htmlspecialchars($t['pais'] ?? '') ?></td>
                            <td><?= htmlspecialchars($t['cod_postal'] ?? '') ?></td>
                            <td class="text-end">
                                <a href="editar.php?id=<?= urlencode($t['id_tienda']) ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="eliminar.php?id=<?= urlencode($t['id_tienda']) ?>" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($tiendas)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No hay tiendas registradas.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>