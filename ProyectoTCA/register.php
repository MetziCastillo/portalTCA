<?php
require 'config/database.php';

$usuario = "victoria";
$password = password_hash("123456", PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO usuarios (usuario, password) VALUES (:usuario, :password)");
$stmt->execute([
    'usuario' => $usuario,
    'password' => $password
]);

echo "Usuario creado correctamente";
?>