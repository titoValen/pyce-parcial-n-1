# Old Ink School

Sitio web para un estudio de tatuajes de estética tradicional. Incluye un catálogo público de servicios, un blog y un formulario para solicitar turnos, además de un panel de administración con autenticación propia.

Proyecto académico para **Portales y Comercio Electrónico — Primer Parcial**.

## Funcionalidades

### Sitio público

- Página de inicio con servicios destacados y publicaciones recientes.
- Listado y detalle de servicios activos.
- Blog con publicaciones paginadas, categorías y páginas de detalle por slug.
- Formulario de solicitud de turnos con validación en el servidor y mensajes de resultado.

### Administración

- Inicio y cierre de sesión propios, sin scaffolding de autenticación.
- Panel con el contador de solicitudes pendientes.
- ABM de publicaciones y servicios.
- Listado, detalle, cambio de estado y eliminación de solicitudes.
- Rutas administrativas protegidas por el middleware `auth`.

## Tecnologías y requisitos

- PHP **8.3 o superior**.
- Composer.
- Laravel **13**.
- MySQL.
- Blade y CSS propio (hojas de estilo en `public/css/`).

## Instalación local

1. Instalar dependencias:

    ```bash
    composer install
    ```

2. Crear el archivo de entorno y generar la clave de Laravel:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    En Windows PowerShell, usar `Copy-Item .env.example .env` en lugar de `cp`.

3. Crear una base de datos MySQL llamada `apellido_nombre` o cambiar `DB_DATABASE` en `.env` para que coincida con la base creada. Configurar también las credenciales de conexión:

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=apellido_nombre
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4. Crear las tablas y cargar los datos iniciales:

    ```bash
    php artisan migrate --seed
    ```

5. Iniciar el servidor de desarrollo:

    ```bash
    php artisan serve
    ```

    Abrir <http://127.0.0.1:8000>.

El seeder crea un usuario administrador de demostración:

- **Correo:** `valetin.tito@davinci.du.ar`
- **Contraseña:** `tito_valentin`

Estas credenciales son solo para desarrollo local. Cambiarlas antes de desplegar o exponer la aplicación.

## Pruebas

Ejecutar la suite con:

```bash
php artisan test
```

Las pruebas usan SQLite en memoria y cubren la disponibilidad de la página principal, el login, el logout, la vista de publicaciones por slug y el envío de solicitudes de turno.

## Rutas principales

| Método | URL                      | Descripción                                              |
| ------ | ------------------------ | -------------------------------------------------------- |
| `GET`  | `/`                      | Inicio                                                   |
| `GET`  | `/servicios`             | Listado de servicios                                     |
| `GET`  | `/servicios/{id}`        | Detalle de servicio                                      |
| `GET`  | `/blog`                  | Publicaciones                                            |
| `GET`  | `/blog/categoria/{slug}` | Publicaciones por categoría                              |
| `GET`  | `/blog/{slug}`           | Detalle de publicación                                   |
| `GET`  | `/turnos/solicitar`      | Formulario de solicitud                                  |
| `POST` | `/turnos`                | Envío de solicitud                                       |
| `GET`  | `/admin/login`           | Login administrativo                                     |
| `POST` | `/admin/login`           | Autenticación                                            |
| `POST` | `/admin/logout`          | Cierre de sesión                                         |
| `GET`  | `/admin/dashboard`       | Panel (requiere autenticación)                           |
| —      | `/admin/posts`           | Administración de publicaciones (requiere autenticación) |
| —      | `/admin/services`        | Administración de servicios (requiere autenticación)     |
| —      | `/admin/appointments`    | Gestión de solicitudes (requiere autenticación)          |

## Estructura de datos

Las tablas y sus relaciones se crean mediante migrations; los datos de ejemplo se cargan mediante seeders.

| Tabla               | Propósito                                 |
| ------------------- | ----------------------------------------- |
| `usuarios`          | Cuentas administrativas                   |
| `servicios`         | Servicios ofrecidos por el estudio        |
| `posts`             | Publicaciones del blog                    |
| `categorias`        | Categorías del blog                       |
| `categoria_post`    | Relación entre publicaciones y categorías |
| `tatuadores`        | Perfiles de tatuadores                    |
| `servicio_tatuador` | Relación entre servicios y tatuadores     |
| `solicitudes_turno` | Solicitudes y estado de cada turno        |

Para recrear la base de datos desde cero durante el desarrollo se puede ejecutar `php artisan migrate:fresh --seed`. **Este comando elimina todos los datos existentes** en la base configurada.

## Diseño

La interfaz utiliza la tipografía Rye para títulos y Source Sans 3 para el cuerpo, junto con una paleta inspirada en la estética tradicional del estudio. Las fuentes se cargan desde Google Fonts.
