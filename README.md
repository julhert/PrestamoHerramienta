1.Clonar el repositorio: git clone https://github.com/LgUebv/Proyecto-Prestamo-Herramienta

2. Descargar e instalar dependencias que el proyecto necesita para funcionar: composer install

3. Copiar y crear un nuevo .env:

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
- `npm run dev`
