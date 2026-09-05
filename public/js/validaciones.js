document.addEventListener('DOMContentLoaded', function () {
    const formulario = document.getElementById('form-producto');

    if (formulario) {
        formulario.addEventListener('submit', function (evento) {
            if (!validarFormulario()) {
                evento.preventDefault();
            }
        });
    }

    document.querySelectorAll('.boton-eliminar').forEach(function (enlace) {
        enlace.addEventListener('click', function (evento) {
            const confirmado = confirm('¿Está seguro de que desea eliminar este producto?');
            if (!confirmado) {
                evento.preventDefault();
            }
        });
    });
});

function validarFormulario() {
    let esValido = true;

    esValido = validarNombre() && esValido;
    esValido = validarCategoria() && esValido;
    esValido = validarPrecio() && esValido;
    esValido = validarCantidad() && esValido;

    return esValido;
}

function mostrarError(idCampo, idError, mensaje) {
    const campo = document.getElementById(idCampo);
    const error = document.getElementById(idError);

    if (mensaje) {
        campo.classList.add('campo-invalido');
        error.textContent = mensaje;
        return false;
    }

    campo.classList.remove('campo-invalido');
    error.textContent = '';
    return true;
}

function validarNombre() {
    const valor = document.getElementById('nombre').value.trim();

    if (valor === '') {
        return mostrarError('nombre', 'error-nombre', 'El nombre es obligatorio.');
    }

    if (valor.length < 3) {
        return mostrarError('nombre', 'error-nombre', 'El nombre debe tener al menos 3 caracteres.');
    }

    return mostrarError('nombre', 'error-nombre', null);
}

function validarCategoria() {
    const valor = document.getElementById('categoria').value.trim();

    if (valor === '') {
        return mostrarError('categoria', 'error-categoria', 'La categoría es obligatoria.');
    }

    return mostrarError('categoria', 'error-categoria', null);
}

function validarPrecio() {
    const valor = document.getElementById('precio').value.trim();
    const numero = parseFloat(valor);

    if (valor === '') {
        return mostrarError('precio', 'error-precio', 'El precio es obligatorio.');
    }

    if (isNaN(numero) || numero <= 0) {
        return mostrarError('precio', 'error-precio', 'El precio debe ser un número mayor que 0.');
    }

    return mostrarError('precio', 'error-precio', null);
}

function validarCantidad() {
    const valor = document.getElementById('cantidad').value.trim();
    const numero = Number(valor);

    if (valor === '') {
        return mostrarError('cantidad', 'error-cantidad', 'La cantidad es obligatoria.');
    }

    if (!Number.isInteger(numero) || numero < 0) {
        return mostrarError('cantidad', 'error-cantidad', 'La cantidad debe ser un número entero mayor o igual a 0.');
    }

    return mostrarError('cantidad', 'error-cantidad', null);
}
