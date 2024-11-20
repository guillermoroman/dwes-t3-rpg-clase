<?php

require_once("../config/db.php");
require_once("../model/Character.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $character = new Character($db);
    $character->setName($_POST['name'])
              ->setDescription($_POST['description'])
              ->setHealth($_POST['health'])
              ->setStrength($_POST['strength'])
              ->setDefense($_POST['defense']);


    if ($character->save()){
        echo "Se ha guardado el personaje";
    } else {
        echo "Error al guardar el personaje";
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
    <?php include('partials/_menu.php') ?>
    <h1>Crea tu personaje</h1>
    <form action = "create_character.php" method = "POST">
        <div>
            <label for="nameInput">Nombre:</label>
            <input type = "text" name = "name" id = "nameInput">
        </div>
        
        <div>
            <label for="descriptionInput">Descripción:</label>
            <input type = "text" name = "description" id = "descriptionInput" required>
        </div>

        <div>
            <label for="healthInput">Puntos de Vida:</label>
            <input type = "number" name = "health" value="100" min="1" id = "healthInput" required>
        </div>
        
        <div>
            <label for="strengthInput">Fuerza:</label>
            <input type = "number" name = "strength" value="10" min="1" id = "strengthInput" required>
        </div>
        
        <div>
            <label for="defenseInput">Defensa:</label>
            <input type = "number" name = "defense" value="10" min="1" id = "defenseInput" required>
        </div>
        
        <button type="submit">Crear personaje</button>
        
    </form>
    
</body>
</html>