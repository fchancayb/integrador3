-- Base de datos: integradora
-- Proyecto: Catálogo de Productos / Inventario

CREATE DATABASE IF NOT EXISTS integradora;
USE integradora;

CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255),
    categoria VARCHAR(50) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    cantidad INT NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO productos (nombre, descripcion, categoria, precio, cantidad) VALUES
('Laptop HP 15', 'Laptop 8GB RAM, 256GB SSD', 'Electrónica', 549.99, 12),
('Mouse inalámbrico', 'Mouse óptico inalámbrico USB', 'Accesorios', 15.50, 40),
('Silla de oficina', 'Silla ergonómica con soporte lumbar', 'Mobiliario', 89.00, 8),
('Cuaderno universitario', '100 hojas cuadriculadas', 'Papelería', 2.75, 150);
