# **Configurar la Base de Datos**

1. Crea una base de datos llamada crud_php en MySQL:

```bash
CREATE DATABASE crud_php;
USE crud_php;
```

2. Ejecuta el siguiente script SQL para crear las tablas necesarias:

```bash
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(15),
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'usuario') DEFAULT 'usuario',
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

3. Modifica el archivo /src/db.php con tus credenciales de MySQL:

```bash
$host = 'localhost';
$dbname = 'crud_php';
$username = 'root';
$password = '';
```
