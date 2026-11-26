<?php
$basePath = $basePath ?? '.';
$paginaActual = $paginaActual ?? 'inicio';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookManager | Gestión de Librería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; background-color: #f8f9fa; }
        .sidebar { min-width: 240px; max-width: 240px; min-height: 100vh; }
    </style>
</head>
<body>
<div class="d-flex">
    <nav class="sidebar bg-dark text-white p-3 d-flex flex-column">
        <a href="<?= $basePath ?>/index.php" class="text-white text-decoration-none fs-4 fw-bold mb-4">
            <i class="bi bi-book-half me-2 text-warning"></i>BookManager
        </a>
        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a href="<?= $basePath ?>/index.php" class="nav-link text-white <?= $paginaActual === 'inicio' ? 'active' : '' ?>">
                    <i class="bi bi-speedometer2 me-2"></i>Inicio
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= $basePath ?>/views/tiendas/index.php" class="nav-link text-white <?= $paginaActual === 'tiendas' ? 'active' : '' ?>">
                    <i class="bi bi-shop me-2"></i>Tiendas
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= $basePath ?>/views/titulos/index.php" class="nav-link text-white <?= $paginaActual === 'titulos' ? 'active' : '' ?>">
                    <i class="bi bi-journal-bookmark me-2"></i>Títulos (Libros)
                </a>
            </li>
        </ul>
    </nav>
    <main class="flex-grow-1 p-4">