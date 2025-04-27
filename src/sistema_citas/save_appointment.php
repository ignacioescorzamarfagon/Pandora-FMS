<?php

// BBDD connection data
$host = 'db'; 
$dbname = 'pandoradb';
$username = 'root';
$password = 'root';

header('Content-Type: application/json');

// Get data
$name = trim($_POST['name'] ?? '');
$dni = trim($_POST['dni'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$appointmentType = trim($_POST['appointment_type'] ?? '');

// Server side validation

validateForm($name, $dni, $phone, $email, $appointmentType);

try {
    // BBDD conection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    

    // Check if patient exist
    $stmt = $pdo->prepare("SELECT id FROM patients WHERE dni = :dni");
    $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
    $stmt->execute();
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($patient) {
        $patient_id = $patient['id'];
    } else {
        //Insert new patient
        $stmt = $pdo->prepare("INSERT INTO patients (name, dni, phone, email) VALUES (:name, :dni, :phone, :email)");
        $stmt->execute([
            ':name' => $name,
            ':dni' => $dni,
            ':phone' => $phone,
            ':email' => $email
        ]);
        $patient_id = $pdo->lastInsertId();
    }

    // Find next hour
    $date = new DateTime();
    $date->setTime(10, 0, 0); // Start to 10am

    while (true) {
        $date_str = $date->format('Y-m-d');
        $hour_str = $date->format('H:i:s');

        // Check if there is already an appointment for that date and time
        $stmt = $pdo->prepare("SELECT id FROM appointment WHERE date = :date AND hour = :hour");
        $stmt->execute([
            ':date' => $date_str,
            ':hour' => $hour_str
        ]);

        if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
            // Free hour found
            break;
        }

        // Add an hour
        $date->modify('+1 hour');

        // From 22:00 to 10:00
        if ((int)$date->format('H') >= 22) {
            $date->modify('+1 day');
            $date->setTime(10, 0, 0);
        }
    }

    // Save appointment
    $stmt = $pdo->prepare("INSERT INTO appointment (patient_id, date, hour, appointment_type) VALUES (:patient_id, :date, :hour, :appointmentType)");
    $stmt->execute([
        ':patient_id' => $patient_id,
        ':date' => $date->format('Y-m-d'),
        ':hour' => $date->format('H:i:s'),
        ':appointmentType' => $appointmentType
    ]);

    echo json_encode(['msg' => 'Se ha generado la cita exitosamente.', 'class' => 'success']);

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage(), 'class' => 'error']);
}

function validateForm(string $name, string $dni, string $phone, string $email, string $appointmentType): bool {
    if (empty($name) || empty($dni) || empty($phone) || empty($email) || empty($appointmentType)) {
        echo json_encode(['msg' => 'Todos los campos son requeridos.', 'class' => 'error']);
        die;
    }

    if (strlen($name) < 3) {
        echo json_encode(['msg' => 'El nombre debe de tener al menos 3 caracteres.', 'class' => 'error']);
        die;
    }

    if (!preg_match('/^\d{8}[A-Za-z]$/', $dni)) {
        echo json_encode(['msg' => 'DNI debe de tener 8 caracteres seguidos de una letra.', 'class' => 'error']);
        die;
    }

    if (!preg_match('/^\d{9}$/', $phone)) {
        echo json_encode(['msg' => 'El número de teléfono debe de tener 9 dígitos.', 'class' => 'error']);
        die;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['msg' => 'Formato de email inválido.', 'class' => 'error']);
        die;
    }

    if (!in_array($appointmentType, ['Primera consulta', 'Revisión'])) {
        echo json_encode(['msg' => 'Por favor, selecciona un tipo de cita.', 'class' => 'error']);
        die;
    }

    return true;
}

?>