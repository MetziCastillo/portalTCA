<?php
/*
la session_start sirve para iniciar una nueva sesion o reanudar una ya existente.
funciona como una cookie del codigo para guardar el usuario, es muy util cuando
se quiere mantener iniciada una sesion hasta que se finalice en comando.
Es decir, guarda y accede a datos entre diferentes paginas webs.
*/
session_start();

/*
Sirve para destruir la informacion asociada a la sesion actual almacenada en el servidor.
Se utiliza para cerrar sesion principalmente, lo que aumenta la segurodad y que se roben las sesiones.
*/
session_destroy();

header("Location: login.php");
exit();
?>