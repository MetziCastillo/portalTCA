<?php
/*
la session_start sirve para iniciar una nueva sesion o reanudar una ya existente.
funciona como una cookie del codigo para guardar el usuario, es muy util cuando
se quiere mantener iniciada una sesion hasta que se finalice en comando.
Es decir, guarda y accede a datos entre diferentes paginas webs.
*/
session_start();

/*
Este if sirve para proteger a las paginas privadas para ver si un usuario inicio sesion.
Si la variable user_id no existe o no ha iniciado sesion o expiro la sesion (se puede programar un tiempo)
Se detiene la ejecucion y limita el contenido hacia acceso restringido.
*/
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>Bienvenido al sistema</h2>
<p>Tu ID es: <?php echo $_SESSION['user_id']; ?></p>

<a href="logout.php">Cerrar sesión</a>