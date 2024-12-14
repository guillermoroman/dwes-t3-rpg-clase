<?php

require_once("../../config/db.php");
require_once("../../model/Character.php");

// Guardar un personaje si llegamos con método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $character = new Character($db);
    $character->setName($_POST['name'])
        ->setDescription($_POST['description'])
        ->setHealth($_POST['health'])
        ->setStrength($_POST['strength'])
        ->setDefense($_POST['defense']);

    if ($character->save()) {
        echo "Se ha guardado el personaje";
    } else {
        echo "Error al guardar el personaje";
    }
}