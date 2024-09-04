<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $fecha = date('Y-m-d');
    $hora_actual = date('H:i:s');

    // Verificar si ya existe un registro de asistencia para el usuario en el día actual
    $sql_check = "SELECT * FROM asistencia WHERE id_usuario='$id_usuario' AND fecha='$fecha'";
    $result = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result) > 0) {
        $asistencia = mysqli_fetch_assoc($result);

        if (is_null($asistencia['entrada']) && $hora_actual >= '07:00:00' && $hora_actual <= '08:00:00') {
            $sql = "UPDATE asistencia SET entrada='$hora_actual' WHERE id_usuario='$id_usuario' AND fecha='$fecha'";
            mysqli_query($conn, $sql);
            echo "Entrada registrada a tiempo.";
        } elseif (is_null($asistencia['entrada']) && $hora_actual >= '08:01:00' && $hora_actual <= '08:05:00') {
            $sql = "UPDATE asistencia SET entrada='$hora_actual' WHERE id_usuario='$id_usuario' AND fecha='$fecha'";
            mysqli_query($conn, $sql);
            echo "Entrada registrada con retraso.";
        } elseif (is_null($asistencia['salida_comida']) && $hora_actual >= '13:00:00' && $hora_actual <= '16:00:00') {
            $sql = "UPDATE asistencia SET salida_comida='$hora_actual' WHERE id_usuario='$id_usuario' AND fecha='$fecha'";
            mysqli_query($conn, $sql);
            echo "Salida a comida registrada.";
        } elseif (is_null($asistencia['regreso_comida']) && $hora_actual >= '13:00:00' && $hora_actual <= '17:00:00') {
            $sql = "UPDATE asistencia SET regreso_comida='$hora_actual' WHERE id_usuario='$id_usuario' AND fecha='$fecha'";
            mysqli_query($conn, $sql);
            echo "Regreso de comida registrado.";
        } elseif (is_null($asistencia['salida']) && $hora_actual >= '18:00:00' && $hora_actual <= '18:40:00') {
            $sql = "UPDATE asistencia SET salida='$hora_actual' WHERE id_usuario='$id_usuario' AND fecha='$fecha'";
            mysqli_query($conn, $sql);
            echo "Salida registrada.";
        } else {
            echo "Ya has registrado toda tu asistencia por hoy o fuera del horario permitido.";
        }
    } else {
        if ($hora_actual >= '18:00:00' && $hora_actual <= '18:04:00') {
            $sql = "INSERT INTO asistencia (id_usuario, fecha, entrada) VALUES ('$id_usuario', '$fecha', '$hora_actual')";
            mysqli_query($conn, $sql);
            echo "Entrada registrada a tiempo.";
        } elseif ($hora_actual >= '18:01:00' && $hora_actual <= '18:05:00') {
            $sql = "INSERT INTO asistencia (id_usuario, fecha, entrada) VALUES ('$id_usuario', '$fecha', '$hora_actual')";
            mysqli_query($conn, $sql);
            echo "Entrada registrada con retraso.";
        } else {
            echo "No es un tiempo válido para registrar entrada.";
        }
    }

    /*header("Location: home.php");
    exit();*/
}

// Obtener las asistencias del día actual
$fecha_hoy = date('Y-m-d');
$sql_asistencias = "SELECT usuarios.nombre, asistencia.entrada, asistencia.salida_comida, asistencia.regreso_comida, asistencia.salida 
                    FROM asistencia 
                    INNER JOIN usuarios ON asistencia.id_usuario = usuarios.id_usuario 
                    WHERE asistencia.fecha = '$fecha_hoy' 
                    ORDER BY asistencia.id DESC";
$result_asistencias = mysqli_query($conn, $sql_asistencias);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Asistencia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Registrar Asistencia</h2>
    <form method="post" action="home.php">
        <label for="id_usuario">ID Usuario:</label>
        <input type="text" name="id_usuario" required><br>
        <button type="submit">Registrar</button>
    </form>

    <h3>Últimas Asistencias Registradas Hoy</h3>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Entrada</th>
                <th>Salida Comida</th>
                <th>Regreso Comida</th>
                <th>Salida</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = mysqli_fetch_assoc($result_asistencias)): ?>
            <tr>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['entrada'] ?? '---'; ?></td>
                <td><?php echo $fila['salida_comida'] ?? '---'; ?></td>
                <td><?php echo $fila['regreso_comida'] ?? '---'; ?></td>
                <td><?php echo $fila['salida'] ?? '---'; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
