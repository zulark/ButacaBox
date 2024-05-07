<?php
header("Content-Type: application/json");
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['data_sessao'], $data['hora_sessao'], $data['filme_id'], $data['sala_id'], $data['filial_id'], $data['preco_ingresso'])) {
        echo json_encode(['error' => 'Campos não preenchidos']);    
        http_response_code(400);
        exit;
    }

    $data_sessao = mysqli_real_escape_string($conn, $data['data_sessao']);
    $hora_sessao = mysqli_real_escape_string($conn, $data['hora_sessao']);
    $filme_id = mysqli_real_escape_string($conn, $data['filme_id']);
    $sala_id = mysqli_real_escape_string($conn, $data['sala_id']);
    $filial_id = mysqli_real_escape_string($conn, $data['filial_id']);
    $preco_ingresso = mysqli_real_escape_string($conn, $data['preco_ingresso']);

    $sql = "INSERT INTO sessoes (data_sessao, hora_sessao, filme_id, sala_id, filial_id, preco_ingresso) 
            VALUES ('$data_sessao', '$hora_sessao', '$filme_id', '$sala_id', '$filial_id', '$preco_ingresso')";

    if ($conn->query($sql) === TRUE) {
        $new_session = [
            'data_sessao' => $data_sessao,
            'hora_sessao' => $hora_sessao,
            'filme_id' => $filme_id,
            'sala_id' => $sala_id,
            'filial_id' => $filial_id,
            'preco_ingresso' => $preco_ingresso
        ];
        echo json_encode(['success' => true, 'message' => 'Sessão criado com sucesso', 'session' => $new_session]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Erro ao criar sessão', 'sql_error' => $conn->error]);
        http_response_code(500);
    }
} else {
    echo json_encode(['error' => 'Request Inválido']);
    http_response_code(405);
}

$conn->close();
?>
