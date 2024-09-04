<!DOCTYPE html>
<html lang="es">  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>    
    <header>
        <h1>Registro de Asistencia</h1>      
    </header>    
    <nav>
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Registrar Asistencia</a></li>
            <li><a href="#">Ver Asistencias</a></li>
            <li><a href="#">Configuración</a></li>
       </ul>
    </nav>
    <main>
        <section class="registro">
            <h2>Registrar Asistencia</h2>
            <form action="#" method="post" class="registro-form">
                <label for="id">ID de Usuario:</label>
                <input type="text" id="id" name="id" required>
                
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                
                <label for="hora">Hora de Entrada:</label>
                <input type="time" id="hora" name="hora" required>
                
                <button type="submit">Registrar</button>
            </form>
        </section>
        <aside>
            <h3>Últimos Registros</h3>
            <ul>
                <li>ID: 1234 - Juan Pérez - 08:02</li>
                <li>ID: 5678 - Ana Gómez - 08:04</li>
                <li>ID: 9101 - Luis García - 08:06</li>
            </ul>
        </aside>
    </main>
    <footer>
        <p>&copy; 2024 Sistema de Registro de Asistencia</p>
    </footer>
</body>  
</html>

