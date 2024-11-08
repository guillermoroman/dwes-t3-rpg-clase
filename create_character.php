<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tu personaje</title>
</head>
<body>
    <h1>Crea tu personaje</h1>
    <form action = "save_character.php" method = "POST">
        <label for="nameInput">Nombre:</label>
        <input type = "text" name = "name" id = "nameInput">
        <label for="descriptionInput">Descripción:</label>
        <input type = "text" name = "description" id = "descriptionInput">
        <button type="submit">Crear personaje</button>
<!--
    ATRIBUTOS DE <input>
    name = "name": se usará en el servidor para capturar el valor ingresado ($_POST['name'])
	
    id = "nameInput": permite asociar el campo con el label (for="name") y también permite seleccionarlo en JavaScript o CSS.

-->
    </form>
    
</body>
</html>