# Catálogo de Productos - Actividad Integradora 3

Aplicación web para gestionar el inventario de una tienda, desarrollada con PHP, MySQL y JavaScript, aplicando el patrón **MVC** (Modelo - Vista - Controlador).

## Descripción

El sistema permite registrar, consultar, buscar y eliminar productos de un catálogo, validando la información tanto en el navegador (JavaScript) como en el servidor (PHP), y persistiendo los datos en una base de datos MySQL llamada `integradora`.

Flujo de la aplicación: **Vista → Controlador → Modelo → Base de datos**.

## Tecnologías utilizadas

- HTML5 / CSS3
- JavaScript (validaciones del formulario)
- PHP 8 (orientado a objetos)
- MySQL (acceso mediante PDO con prepared statements)
- XAMPP (Apache + MySQL)

## Estructura del proyecto

```
catalogo-productos/
├── config/database.php          # Conexión PDO a MySQL
├── models/ProductoModel.php     # Operaciones sobre la tabla productos
├── controllers/ProductoController.php  # Lógica de negocio y validación server-side
├── views/                       # Formulario, listado y partials (header/footer)
├── public/css/styles.css        # Estilos
├── public/js/validaciones.js    # Validaciones del formulario en el navegador
├── database/integradora.sql     # Script de creación de la base de datos
└── index.php                    # Front controller (enrutador de acciones)
```

## Instrucciones de instalación y ejecución

1. Copiar la carpeta `catalogo-productos` dentro de `htdocs` de XAMPP.
2. Iniciar los servicios **Apache** y **MySQL** desde el panel de control de XAMPP.
3. Abrir **phpMyAdmin** (`http://localhost/phpmyadmin`) e importar el archivo `database/integradora.sql` (esto crea la base de datos `integradora` y la tabla `productos` con datos de ejemplo).
4. Abrir en el navegador: `http://localhost/catalogo-productos/`.

## Funcionalidades

- **Registrar producto**: formulario con validaciones en JavaScript (campos vacíos, longitud mínima del nombre, precio y cantidad numéricos y positivos) y validación adicional en el servidor.
- **Consultar productos**: listado en tabla HTML con todos los productos registrados.
- **Buscar productos**: filtro por nombre o categoría.
- **Eliminar producto**: elimina un registro con confirmación previa en el navegador.

## Capturas de pantalla

_Agregar aquí capturas de pantalla del formulario, el listado y la búsqueda una vez probada la aplicación._

## Control de versiones

Este proyecto se desarrolló utilizando Git con commits incrementales que documentan el avance:

1. Estructura inicial del proyecto
2. Diseño de interfaz principal
3. Creación del formulario de registro
4. Agregadas validaciones con JavaScript
5. Configuración de conexión con MySQL
6. Implementación del modelo y controlador
7. Registro, consulta, búsqueda y eliminación de datos desde MySQL
