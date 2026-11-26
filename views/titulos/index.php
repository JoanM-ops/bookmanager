<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Titulo.php';

$basePath = '../..';
$paginaActual = 'titulos';

$db = (new Database())->getConnection();
$tituloModel = new Titulo($db);
$titulos = $tituloModel->getAll();

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold mb-0">Catálogo de Títulos (Libros)</h1>
        <a href="crear.php" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Nuevo Título
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
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Editorial</th>
                        <th>Precio</th>
                        <th>Publicación</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($titulos as $lib): ?>
                        <tr>
                            <td class="fw-bold"><?= htmlspecialchars($lib['id_titulo']) ?></td>
                            <td><?= htmlspecialchars($lib['titulo']) ?></td>
                            <td><span class="badge bg-secondary"><?= htmlspecialchars($lib['tipo'] ?? '') ?></span></td>
                            <td><?= htmlspecialchars($lib['nombre_pub'] ?? 'Sin editorial') ?></td>
                            <td>$<?= number_format((float) $lib['precio'], 2) ?></td>
                            <td><?= htmlspecialchars(substr((string) ($lib['fecha_pub'] ?? ''), 0, 10)) ?></td>
                            <td class="text-end">
                                <a href="editar.php?id=<?= urlencode($lib['id_titulo']) ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="eliminar.php?id=<?= urlencode($lib['id_titulo']) ?>" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>