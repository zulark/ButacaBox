<?php
header("Content-Type: application/json");
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id_sessao = isset($_GET['id']) ? intval($_GET['id']) : null;

    if ($id_sessao === null) {
        echo json_encode(['error' => 'ID é obrigatório']);
        http_response_code(400);
        exit;
    }

    $update_fields = [];

    if (isset($data['data_sessao'])) {
        $data_sessao = mysqli_real_escape_string($conn, $data['data_sessao']);
        $update_fields[] = "data_sessao = '$data_sessao'";
    }
    if (isset($data['hora_sessao'])) {
        $hora_sessao = mysqli_real_escape_string($conn, $data['hora_sessao']);
        $update_fields[] = "hora_sessao = '$hora_sessao'";
    }
    if (isset($data['filme_id'])) {
        $filme_id = mysqli_real_escape_string($conn, $data['filme_id']);
        $update_fields[] = "filme_id = '$filme_id'";
    }
    if (isset($data['sala_id'])) {
        $sala_id = mysqli_real_escape_string($conn, $data['sala_id']);
        $update_fields[] = "sala_id = '$sala_id'";
    }
    if (isset($data['filial_id'])) {
        $filial_id = mysqli_real_escape_string($conn, $data['filial_id']);
        $update_fields[] = "filial_id = '$filial_id'";
    }
    if (isset($data['preco_ingresso'])) {
        $preco_ingresso = mysqli_real_escape_string($conn, $data['preco_ingresso']);
        $update_fields[] = "preco_ingresso = '$preco_ingresso'";
    }

    $update_sql = "UPDATE sessoes SET " . implode(", ", $update_fields) . " WHERE id_sessao = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $id_sessao);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['message' => 'Sessão atualizada com sucesso']);
    } else {
        echo json_encode(['error' => 'Erro ao atualizar sessão']);
        http_response_code(500);
    }
} else {
    echo json_encode(['error' => 'Request Inválido']);
    http_response_code(405);
}

$conn->close();
?>
