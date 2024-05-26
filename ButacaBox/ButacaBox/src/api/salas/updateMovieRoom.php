<?php
header("Content-Type: application/json");
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id_sala = isset($_GET['id']) ? intval($_GET['id']) : null;

    if ($id_sala === null) {
        echo json_encode(['error' => 'ID é obrigatório']);
        http_response_code(400);
        exit;
    }

    $update_fields = [];

    if (isset($data['nome'])) {
        $nome = mysqli_real_escape_string($conn, $data['nome']);
        $update_fields[] = "nome = '$nome'";
    }
    if (isset($data['capacidade'])) {
        $capacidade = intval($data['capacidade']);
        $update_fields[] = "capacidade = '$capacidade'";
    }
    $update_sql = "UPDATE salas SET " . implode(", ", $update_fields) . " WHERE id_sala = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $id_sala);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['message' => 'Sala atualizada com sucesso']);
    } else {
        echo json_encode(['error' => 'Erro ao atualizar aala']);
        http_response_code(500);
    }
} else {
    echo json_encode(['error' => 'Request Inválido']);
    http_response_code(405);
}

$conn->close();
?>
