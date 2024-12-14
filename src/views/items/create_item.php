<?php
require_once("../../config/db.php");
require_once("../../model/Item.php");

$items = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $item = new Item($db);
        $item->setName($_POST['name']);
        $item->setDescription($_POST['description']);
        $item->setType($_POST['type']);
        $item->setEffect($_POST['effect']);
        $item->setImage($_POST['image'] ?? null);

        if ($item->save()) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Error al crear el ítem.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

try {
    $stmt = $db->query("SELECT * FROM items");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al leer la base de datos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tu ítem</title>
</head>
<body>
<h1>Crea tu ítem</h1>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
    <div>
        <label for="nameInput">Nombre:</label>
        <input type="text" name="name" id="nameInput" required>
    </div>
    <div>
        <label for="descriptionInput">Descripción:</label>
        <input type="text" name="description" id="descriptionInput" required>
    </div>
    <div>
        <label for="typeInput">Tipo:</label>
        <input type="text" name="type" id="typeInput" required>
    </div>
    <div>
        <label for="effectInput">Efecto:</label>
        <input type="text" name="effect" id="effectInput">
    </div>
    <div>
        <label for="imageInput">Imagen:</label>
        <input type="text" name="image" id="imageInput">
    </div>
    <button type="submit">Crear ítem</button>
</form>

<h1>Lista de ítems</h1>
<table>
    <thead>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Tipo</th>
        <th>Efecto</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" width="50"></td>
            <td><?= $item['name'] ?></td>
            <td><?= $item['description'] ?></td>
            <td><?= $item['type'] ?></td>
            <td><?= $item['effect'] ?></td>
            <td>
                <form action="edit_item.php" method="GET">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <button type="submit">Editar</button>
                </form>
                <form action="../../controllers/delete_item.php" method="POST">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <button type="submit">Borrar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>