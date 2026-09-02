# Blog de Avisos

## Descripción
Este proyecto es un blog llamado "Blog de Avisos" que permite a los usuarios enviar mensajes a través de un formulario de contacto. Además, incluye un sistema de etiquetas para clasificar las publicaciones.

## Estructura del Proyecto
El proyecto tiene la siguiente estructura de archivos:

```
blog-avisos
├── database
│   └── migrations
│       ├── 2025_01_01_000000_create_etiquetas_table.php
│       └── 2025_01_01_000001_create_etiqueta_post_table.php
├── resources
│   └── views
│       └── contacto.blade.php
├── composer.json
└── README.md
```

## Migraciones
- **`2025_01_01_000000_create_etiquetas_table.php`**: Crea la tabla `etiquetas` en la base de datos, definiendo campos como `id`, `nombre` y marcas de tiempo.
- **`2025_01_01_000001_create_etiqueta_post_table.php`**: Crea la tabla `etiqueta_post`, que actúa como tabla pivote para establecer una relación de muchos a muchos entre `etiquetas` y `posts`, incluyendo campos como `etiqueta_id`, `post_id` y marcas de tiempo.

## Instalación
1. Clona el repositorio en tu máquina local.
2. Navega al directorio del proyecto.
3. Ejecuta `composer install` para instalar las dependencias.
4. Configura tu archivo `.env` con las credenciales de la base de datos.
5. Ejecuta las migraciones con `php artisan migrate`.

## Uso
Puedes acceder al formulario de contacto en la vista correspondiente y enviar mensajes. Las publicaciones pueden ser etiquetadas utilizando el sistema de etiquetas implementado.

## Contribuciones
Las contribuciones son bienvenidas. Si deseas contribuir, por favor abre un issue o envía un pull request.