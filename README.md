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
/proyecto-api-php
│
├── /app                     # Lógica principal del backend
│   ├── /Controllers         # Controladores para manejar las solicitudes HTTP
│   │   ├── AuthController.php  # Maneja autenticación (login, register, logout)
│   │   ├── AdminController.php # Maneja endpoints de administrador
│   │   └── UserController.php  # Maneja endpoints de usuarios
│   │
│   ├── /Models              # Modelos para interactuar con la base de datos
│   │   ├── Usuario.php         # Modelo de usuarios
│   │   └── BaseModel.php       # Clase base para modelos
│   │
│   ├── /Middleware          # Middleware para proteger rutas
│   │   ├── AuthMiddleware.php  # Verifica autenticación
│   │   └── RoleMiddleware.php  # Verifica roles (admin/usuario)
│   │
│   └── /Core                # Componentes centrales del framework
│       ├── Router.php          # Enrutador para manejar las rutas
│       └── Request.php         # Manejo de solicitudes HTTP
│
├── /config                  # Archivos de configuración
│   ├── db.php                  # Configuración de la conexión a la base de datos
│   └── constants.php           # Constantes globales (opcional)
│
├── /public                   # Archivos públicos
│   ├── index.php              # Entrada principal de la API
│   └── .htaccess              # Configuración para redirigir solicitudes al backend
│
├── /logs                     # Registros de errores y logs
│   └── error.log              # Archivo de registro de errores
│
└── README.md                 # Documentación del proyecto
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

## 📝 **Licencia**

Este proyecto está bajo la licencia MIT. Consulta el archivo LICENSE para más detalles.

## 🌟 Contribuciones

¡Las contribuciones son bienvenidas! Si tienes sugerencias o encuentras errores, no dudes en crear un issue o enviar un pull request.
