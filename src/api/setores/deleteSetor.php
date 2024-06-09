<?php
header("Content-Type: application/json");
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id_setor = isset($_GET['id']) ? intval($_GET['id']) : null;

    if ($id_setor === null) {
        echo json_encode(['error' => 'id_setor é obrigatório']);
        http_response_code(400); 
        exit;
    }

    $delete_sql = "DELETE FROM setores WHERE id_setor = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id_setor);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['Setor excluido com sucesso']);
        http_response_code(204); 
    } else {
        echo json_encode(['error' => 'Setor não encontrado']);
        http_response_code(404); 
    }
} elseif (isset($_GET['id_setor'])) {
    $id_setor = isset($_GET['id_setor']) ? intval($_GET['id_setor']) : null;

    if ($id_setor === null) {
        echo json_encode(['error' => 'ID é obrigatório']);
        http_response_code(400); 
        exit;
    }

    $sql = "SELECT * FROM setores WHERE id_setor = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_setor);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();
        echo json_encode($room);
    } else {
        echo json_encode(['error' => 'Setor não encontrado']);
        http_response_code(404); 
    }
} else {
    $sql = "SELECT * FROM setores";
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
