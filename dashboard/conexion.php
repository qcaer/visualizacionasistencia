<?php
function Conectar (){
    $conexion = null;
    $host = '127.0.0.1';
    $db = 'db';
    $user = 'root';
    $pwd = '';
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');	
try{
    $conexion = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pwd, $opciones);
} 
catch (PDOException $e) {
    echo '<p> No se puede conectar a la base de datos !!</p>';
    exit;
}

return $conexion;
}
?>





