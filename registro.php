<?php
include 'db.php';

function generarID() {
    $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $id = '';
    for ($i = 0; $i < 6; $i++) {
        $id .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $id;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = generarID();
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $puesto = $_POST['puesto'];

    $sql = "INSERT INTO usuarios (id_usuario, nombre, edad, puesto) VALUES ('$id_usuario', '$nombre', $edad, '$puesto')";
    if (mysqli_query($conn, $sql)) {
        echo "Usuario registrado con ID: " . $id_usuario;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Registrar Usuario</h2>
    <form method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>
        <label for="edad">Edad:</label>
        <input type="number" name="edad" required><br>
        <label for="puesto">Puesto:</label>
        <input type="text" name="puesto" required><br>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
