<?php
require_once('../config/db.php');

// ACTUALIZAR un enemigo si llegamos con método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    try {
        $stmt = $db->prepare("UPDATE enemies SET name = :name, description = :description, is_boss = :is_boss, health = :health, strength = :strength, defense = :defense WHERE id = :id");
        $stmt->bindValue(':name', $_POST['name']);
        $stmt->bindValue(':description', $_POST['description']);
        $stmt->bindValue(':is_boss', isset($_POST['is_boss']) ? 1 : 0);
        $stmt->bindValue(':health', $_POST['health']);
        $stmt->bindValue(':strength', $_POST['strength']);
        $stmt->bindValue(':defense', $_POST['defense']);
        $stmt->bindValue(':id', $_POST['id']);
        $stmt->execute();

        header("Location: ../views/enemies/create_enemy.php");
        exit;
    } catch (PDOException $e) {
        echo "Error al actualizar el enemigo: " . $e->getMessage();
    }

}
