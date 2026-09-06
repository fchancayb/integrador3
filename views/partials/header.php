<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos - Integradora</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <header class="cabecera">
        <div class="contenedor cabecera-fila">
            <div>
                <h1>📦 Catálogo de Productos</h1>
                <p>Sistema de inventario - Actividad Integradora 3</p>
            </div>
            <?php if (!empty($_SESSION['usuario_nombre'])): ?>
                <div class="sesion">
                    <span><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></span>
                    <a href="index.php?accion=logout" class="boton boton-enlace-claro">Cerrar sesión</a>
                </div>
            <?php endif; ?>
        </div>
    </header>
    <main class="contenedor">
