<?php
// Configuración de la base de datos
$host = 'localhost';
$dbname = 'dwes_t3_rpg_clase';
$username = 'root';
$password = '';


try{
    // Crear nueva instancia de PDO pra conectar a la base de datos
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    

} catch (PDOException $e){
    echo "Error de conexión: " . $e->getMessage();
    exit;
}


