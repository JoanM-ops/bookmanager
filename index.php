<?php
require_once __DIR__ . '/config/database.php';

$basePath = '.';
$paginaActual = 'inicio';

$database = new Database();
$db = $database->getConnection();

$stmtTiendas = $db->prepare("SELECT COUNT(*) AS total FROM tiendas");
$stmtTiendas->execute();
$totalTiendas = (int) $stmtTiendas->fetch()['total'];

$stmtTitulos = $db->prepare("SELECT COUNT(*) AS total FROM titulos");
$stmtTitulos->execute();
$totalTitulos = (int) $stmtTitulos->fetch()['total'];

require_once __DIR__ . '/includes/header.php';
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-dark fw-bold">Panel de Control — BookManager</h1>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted text-uppercase small fw-bold mb-1">Tiendas Registradas</p>
                        <h2 class="mb-0 fw-bold"><?= $totalTiendas ?></h2>
                    </div>
                    <a href="views/tiendas/index.php" class="btn btn-primary">
                        Gestionar Tiendas <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted text-uppercase small fw-bold mb-1">Títulos en Catálogo</p>
                        <h2 class="mb-0 fw-bold"><?= $totalTitulos ?></h2>
                    </div>
                    <a href="views/titulos/index.php" class="btn btn-success">
                        Gestionar Títulos <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>