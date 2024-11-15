<?php
require_once 'config/db.php';

// var_dump($_POST);
/*
echo "Nombre: " . $_POST["name"] . "<br>";
echo "Descripción: " . $_POST["description"];
*/
$name = $_POST["name"];
$description = $_POST["description"];


$stmt = $db->prepare("INSERT INTO characters (name, description) VALUES (:name, :description)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':description', $description);

if ($stmt->execute()){
    echo "Personaje creado";
} else {
    echo "Ha ocurrido un fallo";
}
