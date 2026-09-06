<?php require __DIR__ . '/partials/header.php'; ?>

<?php if ($mensaje): ?>
    <div class="mensaje mensaje-<?php echo htmlspecialchars($tipoMensaje); ?>">
        <?php echo htmlspecialchars($mensaje); ?>
    </div>
<?php endif; ?>

<section class="tarjeta">
    <h2>Iniciar sesión</h2>
    <form action="index.php?accion=login" method="POST">
        <div class="campo">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" required autofocus>
        </div>

        <div class="campo">
            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" required>
        </div>

        <button type="submit" class="boton boton-primario">Entrar</button>
    </form>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
