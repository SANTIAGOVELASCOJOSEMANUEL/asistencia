<?php
include 'db.php';

$sql = "SELECT u.id_usuario, u.nombre, a.fecha, a.entrada, a.salida_comida, a.regreso_comida, a.salida
        FROM usuarios u
        LEFT JOIN asistencia a ON u.id_usuario = a.id_usuario
        ORDER BY u.id_usuario, a.fecha";
$result = mysqli_query($conn, $sql);

$usuarios = [];
while ($row = mysqli_fetch_assoc($result)) {
    $usuarios[$row['id_usuario']]['nombre'] = $row['nombre'];
    $usuarios[$row['id_usuario']]['asistencias'][$row['fecha']] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Asistencia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Reporte de Asistencia</h2>
    <table>
        <thead>
            <tr>
                <th>ID Usuario</th>
                <th>Nombre</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
                <th>Sábado</th>
                <th>Domingo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $id_usuario => $usuario) : ?>
                <tr>
                    <td><?php echo $id_usuario; ?></td>
                    <td><?php echo $usuario['nombre']; ?></td>
                    <?php for ($i = 0; $i < 7; $i++) : ?>
                        <?php
                        $fecha = date('Y-m-d', strtotime("-$i day"));
                        $asistencia = isset($usuario['asistencias'][$fecha]) ? $usuario['asistencias'][$fecha] : null;
                        ?>
                        <td>
                            <?php if ($asistencia) : ?>
                                <div>Entrada: <?php echo $asistencia['entrada']; ?></div>
                                <div>Salida Comida: <?php echo $asistencia['salida_comida']; ?></div>
                                <div>Regreso Comida: <?php echo $asistencia['regreso_comida']; ?></div>
                                <div>Salida: <?php echo $asistencia['salida']; ?></div>
                            <?php else : ?>
                                <div>No asistencia</div>
                            <?php endif; ?>
                        </td>
                    <?php endfor; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
