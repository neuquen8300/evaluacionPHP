<h2> Evaluación PHP </h2>

Autor: Bouzo Damián.

Al momento de instalar: 
* <addr> composer install </addr>

* <addr> php artisan migrate </addr>
No olvidar de colocar en el .env los datos de conexión.

* <addr> php artisan jwt:generate </addr>

Este comando sirve para otorgar a la app una key para que los jwt entrantes sean verificados

* Completar en .env el campo MIX_APP_URL donde el valor será la URL de la api a la que queremos conectar

* Completar en .env el campo JWT_COOKIE_NAME con el nombre que queramos para la cookie de jwt

<h4> Como crear usuarios </h4>

Con el comando <addr>php artisan make:user %USERNAME% %EMAIL%</addr> crearemos un usuario y le otorgaremos una contraseña.