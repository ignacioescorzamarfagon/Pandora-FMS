<?php

// BBDD connection data
$host = 'db'; 
$dbname = 'pandoradb';
$username = 'root';
$password = 'root';

header('Content-Type: application/json');

try {
    // BBDD conection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['dni'])) {
        $dni = trim($_POST['dni']);

        // Query
        $stmt = $pdo->prepare("SELECT id FROM patients WHERE dni = :dni");
        $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
        $stmt->execute();
        $exists = $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;

        echo json_encode(['exists' => $exists]);

    } else {
        echo json_encode(['exists' => 'false']);
    }

} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de conexión']);
}
?>