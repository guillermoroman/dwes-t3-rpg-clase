<?php

require_once("../../config/db.php");
require_once("../../model/Character.php");

//print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])){
    try {
        $stmt = $db->prepare("SELECT * FROM characters WHERE id = :id");
        $stmt->bindValue(':id', $_POST['id']);
        $stmt->execute();
        $character = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {}
}

print_r($character);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tu personaje</title>
</head>

<?php include('../partials/_menu.php') ?>
<h1>Modifica tu personaje</h1>
<form action = <?=$_SERVER['PHP_SELF']?> method = "POST">
<div>
    <label for="nameInput">Nombre:</label>
    <input type = "text" name = "name" id = "nameInput" value="<?= $character['name'] ?>" >
</div>

<div>
    <label for="descriptionInput">Descripción:</label>
    <input type = "text" name = "description" id = "descriptionInput" value="<?= $character['description'] ?>" required>
</div>

<div>
    <label for="healthInput">Puntos de Vida:</label>
    <input type = "number" name = "health" value="100" min="1" id = "healthInput" value="<?= $character['health'] ?>" required>
</div>

<div>
    <label for="strengthInput">Fuerza:</label>
    <input type = "number" name = "strength" value="10" min="1" id = "strengthInput" value="<?= $character['strength'] ?>" required>
</div>

<div>
    <label for="defenseInput">Defensa:</label>
    <input type = "number" name = "defense" value="10" min="1" id = "defenseInput" value="<?= $character['defense'] ?>" required>
</div>

<button type="submit">Actualizar personaje</button>
</form>



</body>
</html>