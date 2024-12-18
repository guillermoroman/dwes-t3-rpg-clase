<?php

require_once("../../config/db.php");
require_once("../../model/Character.php");

$characters = [];

try{
    $stmt = $db->query("SELECT * FROM characters");
    $characters = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e){
    echo "Error al leer de base de datos: " . $e->getMessage();
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tu personaje</title>
</head>

    <?php include('../partials/_menu.php') ?>
    <h1>Crea tu personaje</h1>
    <form action = <?=$_SERVER['PHP_SELF']?> method = "POST">
        <div>
            <label for="nameInput">Nombre:</label>
            <input type = "text" name = "name" id = "nameInput">
        </div>
        
        <div>
            <label for="descriptionInput">Descripción:</label>
            <input type = "text" name = "description" id = "descriptionInput" required>
        </div>

        <div>
            <label for="health Input">Puntos de Vida:</label>
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


<h1>Lista de personajes</h1>
<table>
    <thead>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>PV</th>
            <th>Fuerza</th>
            <th>Defensa</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($characters as $character):?>
            <tr>
                <td>img</td>
                <td><?= $character['name']?></td>
                <td><?= $character['description']?></td>
                <td><?= $character['health']?></td>
                <td><?= $character['strength']?></td>
                <td><?= $character['defense']?></td>
                <td>
                    <form action="edit_character.php" method="POST">
                        <input type="hidden" name="id" value="<?=$character["id"]?>">
                        <button type="submit">Editar</button>
                    </form>
                    <form action="../../controllers/delete_character.php" method="POST">
                        <input type="hidden" name="id" value="<?=$character["id"]?>">
                        <button type="submit">Borrar</button>
                    </form>
                </td>

            </tr>
        <?php endforeach;?>

    </tbody>
</table>

</body>
</html>