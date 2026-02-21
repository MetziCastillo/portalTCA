<?php
/*
la session_start sirve para iniciar una nueva sesion o reanudar una ya existente.
funciona como una cookie del codigo para guardar el usuario, es muy util cuando
se quiere mantener iniciada una sesion hasta que se finalice en comando.
Es decir, guarda y accede a datos entre diferentes paginas webs.
*/
session_start();

//aqui se lee la conexion a la bd.
require 'config/database.php';

//se utiliza la siguiente declaracion para verificar si se han enviado los datos y evitar reenvios innecesarios.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //recibe y almacena los valores enviados desde el formulario html por medio de un metodo POST
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    //esta declaracion hace un select hacia la tabla local de usuarios. para insertar el usuario que viene en la bd sobre el formulario.
    $stmt = $pdo->prepare("SELECT id, password, tipo_usuario FROM usuarios WHERE usuario = :usuario");
    $stmt->execute(['usuario' => $usuario]);

    //Sobre esta linea sirve para que solo se obtenga un solo registro del select anteriormente ejecutado y almacenar el dato.
    $usuarioDB = $stmt->fetch();

    //Esta declaracion compara al usuario y la contraseña inserta para iniciar la sesion.
    //en caso de encontrar el usuario, genera una sesion sobre el formulario.
    //en caso de error envia la alerta de datos incorrectos.
    if ($usuarioDB && password_verify($password, $usuarioDB['password'])) {

        // Crear sesión
        $_SESSION['user_id'] = $usuarioDB['id'];
        $_SESSION['tipo'] = $usuarioDB['tipo_usuario'];

        header("Location: dashboard.php");
        exit();

    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>