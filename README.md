<h2> Evaluación PHP </h2>

Autor: Bouzo Damián.

Al momento de instalar: 
* <code> composer install </code>

* <code> php artisan migrate </code>
No olvidar de colocar en el .env los datos de conexión.

* <code> php artisan jwt:generate </code>

Este comando sirve para otorgar a la app una key para que los jwt entrantes sean verificados

* Completar en .env el campo MIX_APP_URL donde el valor será la URL de la api a la que queremos conectar

* Completar en .env el campo JWT_COOKIE_NAME con el nombre que queramos para la cookie de jwt

<h4> Como crear usuarios </h4>

Con el comando <code>php artisan make:user %USERNAME% %EMAIL%</code> crearemos un usuario y le otorgaremos una contraseña.