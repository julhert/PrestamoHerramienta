# SISTEMA DE GESTIÓN PARA PRÉSTAMO DE HERRAMIENTAS

Proyecto desarrollado por:

- Luis Julián Hernández Trejo
- José Manuel Vega Torres

## Pasos para crear el entorno de desarrollo

1.Clonar el repositorio: git clone https://github.com/LgUebv/Proyecto-Prestamo-Herramienta

1. Descargar e instalar dependencias que el proyecto necesita para funcionar: composer install

2. Copiar y crear un nuevo .env:

Para Linux: cp .env.example .env

5. Generar la llave: php artisan key:generate

6. Probar si puede arrancar el servidor: php artisan serve

7. las credenciales necesarias son: 

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=herramientas_db
DB_USERNAME=
DB_PASSWORD=

Para la ejecución del proyecto en entornos de desarrollo se recomienda usar los siguientes comandos en terminales diferentes:

- `php artisan serve`
- `npm install` y luego: `npm run dev`

### DEPENDENCIAS PARA EL PROYECTO

Para que el generador de códigos QR para las herramientas se necesita la herramienta **php-imagick**. Puedes instalarla
usando el siguiente comando (Fedora):

```bash
sudo dnf install php-imagick
```
