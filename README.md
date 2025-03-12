# **CRUD Users - PHP - MySQL**

## 📜 **Descripción**

Este es un proyecto básico de PHP que implementa un sistema CRUD (Create, Read, Update, Delete) para la gestión de usuarios, incluyendo autenticación, registro y un panel de administración. El proyecto utiliza MySQL como base de datos y sigue una estructura modular para facilitar la escalabilidad y mantenimiento.

## ✨ **Características**

Autenticación : Registro e inicio de sesión de usuarios.
Roles : Diferenciación entre usuarios regulares y administradores.
CRUD de Usuarios : Creación, lectura, actualización y eliminación de usuarios.
Borrado Lógico : Los usuarios no se eliminan físicamente, sino que se marcan como inactivos.
Panel de Administración : Gestión avanzada de usuarios con filtros y restauración de cuentas eliminadas.

## **Estructura de carpetas**

```bash
/proyecto-crud
│
├── /public                # Archivos públicos (HTML, CSS, JS)
│   ├── index.php          # Página principal para listar usuarios
│   ├── login.php          # Formulario de inicio de sesión
│   ├── register.php       # Formulario de registro
│   ├── admin/             # Panel de administración
│   │   ├── allusers.php   # Lista todos los usuarios
│   │   ├── edituser.php   # Edita un usuario
│   │   └── search.php     # Busca usuarios con filtros
│   ├── assets/            # Archivos estáticos (CSS, JS, imágenes)
│   │   └── style.css      # Hoja de estilos
│
├── /src                   # Código fuente (lógica del backend)
│   ├── db.php             # Configuración de la conexión a la base de datos
│   ├── Usuario.php        # Modelo para manejar los usuarios
│   ├── Auth.php           # Modelo para manejar autenticación
│   ├── funciones.php      # Funciones auxiliares
│   └── middleware.php     # Middleware para proteger rutas
│
├── .htaccess              # Configuración para redirigir todo al directorio /public
└── README.md              # Documentación del proyecto
```

## 📌 Endpoints

### 🔐 Autenticación (`/auth`)

| Método   | Endpoint         | Descripción                |
| -------- | ---------------- | -------------------------- |
| **POST** | `/auth/register` | Registrar un nuevo usuario |
| **POST** | `/auth/login`    | Iniciar sesión             |
| **POST** | `/auth/logout`   | Cerrar sesión              |

### 👨‍💼 Admin (`/admin`)

| Método     | Endpoint                    | Descripción                        |
| ---------- | --------------------------- | ---------------------------------- |
| **GET**    | `/admin/allusers`           | Obtener todos los usuarios         |
| **GET**    | `/admin/users/{id}`         | Obtener usuario por ID             |
| **GET**    | `/admin/search`             | Buscar usuarios con filtros        |
| **PUT**    | `/admin/users/update/{id}`  | Actualizar usuario                 |
| **DELETE** | `/admin/users/delete/{id}`  | Eliminar usuario (borrado lógico)  |
| **PUT**    | `/admin/users/restore/{id}` | Restaurar usuario (borrado lógico) |

### 👤 Usuarios (`/users`)

| Método     | Endpoint        | Descripción                       |
| ---------- | --------------- | --------------------------------- |
| **GET**    | `/users`        | Obtener datos del usuario         |
| **PUT**    | `/users/update` | Actualizar usuario                |
| **DELETE** | `/users/delete` | Eliminar usuario (borrado lógico) |
