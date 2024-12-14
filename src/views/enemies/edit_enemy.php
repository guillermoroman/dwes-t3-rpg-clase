<?php
require_once("../../config/db.php");

// CARGAR un enemigo si llegamos con método GET
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    try {
        $stmt = $db->prepare("SELECT * FROM enemies WHERE id = :id");
        $stmt->bindValue(':id', $_POST['id']);
        $stmt->execute();
        $enemy = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al cargar el enemigo: " . $e->getMessage();
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Enemigo</title>
</head>
<body>
<h1>Editar Enemigo</h1>
<form action="../../controllers/update_enemy.php" method="POST">
    <input type="hidden" name="id" value="<?= $enemy['id'] ?>">
    <div>
        <label for="nameInput">Nombre:</label>
        <input type="text" name="name" id="nameInput" value="<?= $enemy['name'] ?>" required>
    </div>
    <div>
        <label for="descriptionInput">Descripción:</label>
        <input type="text" name="description" id="descriptionInput" value="<?= $enemy['description'] ?>" required>
    </div>
    <div>
        <label for="isBossInput">Es jefe:</label>
        <input type="checkbox" name="is_boss" id="isBossInput" <?= $enemy['is_boss'] ? 'checked' : '' ?>>
    </div>
    <div>
        <label for="healthInput">Puntos de Vida:</label>
        <input type="number" name="health" id="healthInput" value="<?= $enemy['health'] ?>" min="1" required>
    </div>
    <div>
        <label for="strengthInput">Fuerza:</label>
        <input type="number" name="strength" id="strengthInput" value="<?= $enemy['strength'] ?>" min="1" required>
    </div>
    <div>
        <label for="defenseInput">Defensa:</label>
        <input type="number" name="defense" id="defenseInput" value="<?= $enemy['defense'] ?>" min="1" required>
    </div>
    <button type="submit">Actualizar enemigo</button>
</form>
</body>
</html>