<?php require __DIR__ . '/partials/header.php'; ?>

<?php if ($mensaje): ?>
    <div class="mensaje mensaje-<?php echo htmlspecialchars($tipoMensaje); ?>">
        <?php echo htmlspecialchars($mensaje); ?>
    </div>
<?php endif; ?>

<section class="tarjeta">
    <h2>Registrar nuevo producto</h2>
    <form id="form-producto" action="index.php?accion=guardar" method="POST" novalidate>
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" minlength="3" maxlength="100" required>
            <span class="error" id="error-nombre"></span>
        </div>

        <div class="campo">
            <label for="descripcion">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" maxlength="255">
        </div>

        <div class="campo">
            <label for="categoria">Categoría</label>
            <input type="text" id="categoria" name="categoria" maxlength="50" required>
            <span class="error" id="error-categoria"></span>
        </div>

        <div class="campo">
            <label for="precio">Precio ($)</label>
            <input type="number" id="precio" name="precio" min="0.01" step="0.01" required>
            <span class="error" id="error-precio"></span>
        </div>

        <div class="campo">
            <label for="cantidad">Cantidad</label>
            <input type="number" id="cantidad" name="cantidad" min="0" step="1" required>
            <span class="error" id="error-cantidad"></span>
        </div>

        <button type="submit" class="boton boton-primario">Registrar producto</button>
    </form>
</section>

<section class="tarjeta">
    <h2>Buscar productos</h2>
    <form action="index.php" method="GET" class="form-busqueda">
        <input type="hidden" name="accion" value="listar">
        <input type="text" name="termino" placeholder="Buscar por nombre o categoría"
               value="<?php echo htmlspecialchars($termino ?? ''); ?>">
        <button type="submit" class="boton boton-secundario">Buscar</button>
        <a href="index.php" class="boton boton-enlace">Limpiar</a>
    </form>
</section>

<section class="tarjeta">
    <h2>Productos registrados</h2>
    <?php if (empty($productos)): ?>
        <p class="vacio">No hay productos para mostrar.</p>
    <?php else: ?>
        <div class="tabla-scroll">
            <table class="tabla-productos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Registrado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['id']); ?></td>
                            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                            <td><?php echo htmlspecialchars($producto['categoria']); ?></td>
                            <td>$<?php echo number_format((float) $producto['precio'], 2); ?></td>
                            <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                            <td><?php echo htmlspecialchars($producto['fecha_registro']); ?></td>
                            <td>
                                <form action="index.php?accion=eliminar" method="POST" class="form-eliminar">
                                    <input type="hidden" name="id" value="<?php echo (int) $producto['id']; ?>">
                                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
                                    <button type="submit" class="boton boton-peligro boton-eliminar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
