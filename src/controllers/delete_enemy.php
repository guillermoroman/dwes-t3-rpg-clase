<?php
require_once('../config/db.php');
require_once('../model/Enemy.php');

if ($_SERVER['REQUEST_METHOD']==='POST'){

    if(!isset($_POST['id']) || empty($_POST['id'])){
        die ("No se ha recibido un ID");
    }

    try{
        $enemy = new Enemy($db);
        if (Enemy::delete($db, $_POST['id'])){
            header('Location: ../views/characters/create_enemy.php');
            exit;
        } else{
            echo "Error al borrar";
        }
    } catch (PDOException $e){
        die ("Error al borrar" . $e->getMessage());
    }

} else {
    die ("Método no permitido");
}
