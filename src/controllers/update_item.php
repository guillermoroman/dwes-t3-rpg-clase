<?php

require_once("../../config/db.php");
require_once("../../model/Item.php");

// Verificar si se llegó con el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Crear una instancia de Item
        $item = new Item($db);
        $item->setId($_POST['id'])
            ->setName($_POST['name'])
            ->setDescription($_POST['description'])
            ->setType($_POST['type'])
            ->setEffect($_POST['effect'])
            ->setImage($_POST['image']);

        // Actualizar el ítem en la base de datos
        $stmt = $db->prepare("UPDATE items SET name = :name, description = :description, type = :type, effect = :effect, image = :image WHERE id = :id");
        $stmt->bindValue(':name', $item->getName());
        $stmt->bindValue(':description', $item->getDescription());
        $stmt->bindValue(':type', $item->getType());
        $stmt->bindValue(':effect', $item->getEffect());
        $stmt->bindValue(':image', $item->getImage());
        $stmt->bindValue(':id', $item->getId());

        if ($stmt->execute()) {
            echo "El ítem se ha actualizado correctamente.";
        } else {
            echo "Error al actualizar el ítem.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Método no permitido.";
}

?>