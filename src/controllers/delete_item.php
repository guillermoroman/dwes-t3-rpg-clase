<?php
require_once('../config/db.php');
require_once('../model/Item.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    try {
        if (Item::delete($db, $_POST['id'])) {
            header("Location: ../views/items/create_item.php");
            exit;
        } else {
            echo "Error al borrar el ítem.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Método no permitido.";
}
?>