<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET"); 
header("Access-Control-Allow-Headers: Content-Type"); 
include '../db_connection.php';

if (isset($_GET['id'])) {
    $id_sala = intval($_GET['id']);
    $sql = "SELECT * from salas
    WHERE id_sala = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_sala);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $salas = $result->fetch_assoc();
        echo json_encode($salas);
    } else {
        echo json_encode(['error' => 'Sala não encontrada']);
    }
} else {
    $sql = "SELECT * from salas 
            ORDER BY id_sala
            ";
    $result = $conn->query($sql);

    if ($result) {
        $salas = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($salas);
    } else {
        echo json_encode([]);
    }
}

$conn->close();
?>
