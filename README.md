# Aplicación de Búsqueda de Cursos y Exámenes

Esta aplicación de consola permite buscar clases y exámenes de idiomas ingresando al menos las tres primeras letras del nombre del recurso.

## Requisitos

- PHP 8.2 o superior
- MySQL / MariaDB
- Composer

## Instalación

1. Clonar este repositorio o descargar los archivos

2. Instalar dependencias usando Composer:
```
composer install
```

3. Crear base de datos
   - Ejecutar el archivo `sql/database.sql` en su servidor MySQL:
   ```
   mysql -u tu_usuario -p < sql/database.sql
   ```

4. Configurar acceso a la base de datos
   - Editar el archivo `.env`, renombra el archivo `.env.example` a `.env` y reemplaza los datos de conexión:
   ```
   DB_HOST=localhost
   DB_DATABASE=language_courses
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña
   DB_CHARSET=utf8mb4
   DB_PORT=3306
   ```

## Uso

La aplicación se ejecuta por línea de comandos:

```
php main.php search <término de búsqueda>
```

Ejemplo:

```
php main.php search trabajo
```

Resultado de ejemplo:

```
Clase: Vocabulario sobre Trabajo en Inglés | 5/5
Clase: Conversaciones de Trabajo en Inglés | 5/5
Examen: Trabajos y ocupaciones en Inglés | Selección
```

## Estructura del proyecto

- `main.php`: Punto de entrada a la aplicación
- `src/`: Código fuente organizado por namespaces
  - `Entity/`: Clases de entidades (Course, Exam)
  - `Interface/`: Interfaces (SearchableInterface)
  - `Repository/`: Repositorios para acceso a datos
  - `Service/`: Servicios de la aplicación
  - `Database/`: Conexión a la base de datos
- `config/`: Archivos de configuración
- `sql/`: Scripts SQL para la base de datos
- `tests/`: Tests unitarios (opcional)

## Características implementadas

- Programación Orientada a Objetos con uso de:
  - Interfaces
  - Clases abstractas
  - Visibilidad de propiedades
- Cumplimiento con estándares PSR:
  - PSR-4 para autoloading
  - PSR-2 para estilo de código
  - PHPDoc para documentación
- Patrones de diseño:
  - Patrón Repositorio
  - Patrón Singleton (para conexión DB)
  - Patrón Estrategia (para búsquedas)

## Tests unitarios

Para ejecutar los tests unitarios:

```
./vendor/bin/phpunit
```
