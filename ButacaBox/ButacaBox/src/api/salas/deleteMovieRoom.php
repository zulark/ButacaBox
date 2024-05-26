<?php
header("Content-Type: application/json");
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id_sala = isset($_GET['id']) ? intval($_GET['id']) : null;

    if ($id_sala === null) {
        echo json_encode(['error' => 'id_sala é obrigatório']);
        http_response_code(400); 
        exit;
    }

    $delete_sql = "DELETE FROM salas WHERE id_sala = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id_sala);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['Sala excluida com sucesso']);
        http_response_code(204); 
    } else {
        echo json_encode(['error' => 'Sala não encontrada']);
        http_response_code(404); 
    }
} elseif (isset($_GET['id_sala'])) {
    $id_sala = isset($_GET['id_sala']) ? intval($_GET['id_sala']) : null;

    if ($id_sala === null) {
        echo json_encode(['error' => 'id_sala é obrigatório']);
        http_response_code(400); 
        exit;
    }

    $sql = "SELECT * FROM salas WHERE id_sala = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_sala);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();
        echo json_encode($room);
    } else {
        echo json_encode(['error' => 'sala não encontrado']);
        http_response_code(404); 
    }
} else {
    $sql = "SELECT * FROM salas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $rooms = [];

        while ($row = $result->fetch_assoc()) {
            $rooms[] = $row;
        }

        echo json_encode($rooms);
    } else {
        echo json_encode([]);
    }
}

$conn->close();
?>
