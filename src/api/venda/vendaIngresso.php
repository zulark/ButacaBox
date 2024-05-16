<?php
include '../db_connection.php';
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rawData = file_get_contents(('php://input'));
    $data = json_decode($rawData, true);
    if ($data === null) {
        echo json_encode(['error' => 'invalid JSON data']);
        http_response_code(400);
        exit;
    }
    if (!isset($data['id_sessao'], $data['id_usuario'], $data['qntd_ingressos'], $data['valor_venda'], $data['filial_id'])) {
        echo json_encode(['error' => 'Campos não preenchidos']);
        http_response_code(400);
        exit;
    }

    $id_sessao = mysqli_real_escape_string($conn, $data['id_sessao']);
    $id_usuario = intval($data['id_usuario']);
    $valor_venda = mysqli_real_escape_string($conn, (string) (float) $data['valor_venda']);
    $filial_id = intval($data['filial_id']);
    $qntd_ingressos = intval($data['qntd_ingressos']);

    $sql = 'INSERT INTO vendas (id_sessao, id_usuario, valor_venda, filial_id, qntd_ingressos) 
                VALUES (?, ?, ?, ?, ?)';

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisii", $id_sessao, $id_usuario, $valor_venda, $filial_id, $qntd_ingressos);

        if ($stmt->execute()) {
            $venda = [
                'id_sessao' => $id_sessao,
                'id_usuario' => $id_usuario,
                'valor_venda' => $valor_venda,
                'filial_id' => $filial_id,
                'qntd_ingressos' => $qntd_ingressos
            ];
            echo json_encode(['success' => true, 'message' => 'Venda realizada com sucesso', 'venda' => $venda]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Ocorreu um problema ao realizar a venda', 'sql_error' => $conn->error]);
            http_response_code(500);
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() === 45000) { // Custom SQLSTATE used in the trigger
            echo json_encode(['error' => 'Quantidade de ingressos vendidos excede a capacidade da sala']);
            http_response_code(400);
        } else {
            echo json_encode(['error' => 'Ocorreu um erro no servidor', 'sql_error' => $e->getMessage()]);
            http_response_code(500);
        }
    }

} else {
    echo json_encode(['error' => 'Request inválido']);
    http_response_code(405);
}
$conn->close();
?>