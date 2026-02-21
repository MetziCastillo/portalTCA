<?php
$host = "localhost";//<--base de datos local
$db = "paginatca";//<--nombre de la bd
$user = "root";// <--usuario root de mysql
$pass = "Root1234";// <--como es usuario root no necesita password

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4"; //<--se manda a llamar a la bd

/*
El PDO o por sus siglas PHP Data Objects sirve para definir las conexiones a la base de datos
de manera sencilla, y esta se utiliza en MySQL, PostgreSQL, SQL, SQLite y muchas mas.

PDO: : ATTR_ERRMODE sirve para reportar errores en la base de datos con alertas o excepciones.
por eso va de la mano PDO: : ERRMODE_Exception. Para atrapar el error y enviar un log con lo que paso.

PDO::ATTR_DEFAULT_FETCH_MODE sirve para para obtener los datos por defecto, va de la mano con FETCH_ASSOC
para obtener los datos asociativos o arreglos asociativos por nombre de columna.

PDO: :ATTR_EMULATE_PREPARES este puede emular las sentencias preparadas (Prepared Statements) o usar las sentencias
del motor de base de datos que esten utilizando (por ejemplo usaremos mysql.)
Se recomienda definirlo como false para que sea la base de datos la que prepare y ejecute la consulta.
Es decir, evita la inyeccion por sql, dado que si se pone como True, emula la ejecucion de la consulta y queda vulnerable
ante ataques de inyeccion.
*/
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

/*
En esta consulta tomara los datos de la bd, los guardara en "try" para que se ejecute.
En caso de error, salta hacia el "catch" y devuelve el error.
*/
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>