<?php

require_once("config/db.php");
require_once("model/Character.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $character = new Character();
    $character->setName($_POST['name'])
              ->setDescription($_POST['description']);

    $stmt = $db->prepare("INSERT INTO characters (name, description) VALUES (:name, :description)");
    $stmt->bindValue(':name', $character->getName());
    $stmt->bindValue(':description', $character->getDescription());

    if ($stmt->execute()){
        echo "Se ha guardado el personaje";
    }
    

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tu personaje</title>
</head>
<body>
    <h1>Crea tu personaje</h1>
    <form action = "create_character.php" method = "POST">
        <label for="nameInput">Nombre:</label>
        <input type = "text" name = "name" id = "nameInput">
        <label for="descriptionInput">Descripción:</label>
        <input type = "text" name = "description" id = "descriptionInput">
        <button type="submit">Crear personaje</button>
    </form>
    
</body>
</html>