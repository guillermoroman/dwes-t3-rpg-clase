<?php
require_once("../../config/db.php");
require_once("../../model/Item.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    try {
        $stmt = $db->prepare("SELECT * FROM items WHERE id = :id");
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    try {
        $stmt = $db->prepare("UPDATE items SET name = :name, description = :description, type = :type, effect = :effect, image = :image WHERE id = :id");
        $stmt->bindValue(':name', $_POST['name']);
        $stmt->bindValue(':description', $_POST['description']);
        $stmt->bindValue(':type', $_POST['type']);
        $stmt->bindValue(':effect', $_POST['effect']);
        $stmt->bindValue(':image', $_POST['image']);
        $stmt->bindValue(':id', $_POST['id']);
        $stmt->execute();

        header("Location: create_item.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ítem</title>
</head>
<body>
<h1>Editar Ítem</h1>
<form action="../../controllers/update_item.php" method="POST">
    <input type="hidden" name="id" value="<?= $item['id'] ?>">
    <div>
        <label for="nameInput">Nombre:</label>
        <input type="text" name="name" id="nameInput" value="<?= $item['name'] ?>" required>
    </div>
    <div>
        <label for="descriptionInput">Descripción:</label>
        <input type="text" name="description" id="descriptionInput" value="<?= $item['description'] ?>" required>
    </div>
    <div>
        <label for="typeInput">Tipo:</label>
        <input type="text" name="type" id="typeInput" value="<?= $item['type'] ?>" required>
    </div>
    <div>
        <label for="effectInput">Efecto:</label>
        <input type="text" name="effect" id="effectInput" value="<?= $item['effect'] ?>">
    </div>
    <div>
        <label for="imageInput">Imagen:</label>
        <input type="text" name="image" id="imageInput" value="<?= $item['image'] ?>">
    </div>
    <button type="submit">Actualizar ítem</button>
</form>
</body>
</html>