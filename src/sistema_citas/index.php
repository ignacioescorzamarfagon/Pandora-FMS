<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reserva tu Cita - Clínica de Psicología</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="form-container">
        <h1>Reserva tu Cita</h1>
        <form id="appointment_form">
            
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" >

            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" >

            <label for="phone">Teléfono:</label>
            <input type="text" id="phone" name="phone" >

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" >

            <label for="appointment_type">Tipo de Cita:</label>
            <select id="appointment_type" name="appointment_type" >
                <option value="Primera consulta">Primera consulta</option>
                <!-- "Revisión" will only appear if the DNI exists -->
            </select>

            <button type="submit">Reservar Cita</button>

            <div id="msg"></div>

        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/functions.js"></script>
</body>
</html>