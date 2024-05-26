<?php
include '../db_connection.php';
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rawData = file_get_contents(('php://input'));
    $data = json_decode($rawData, true);

    if ($data === null) {
        echo json_encode(['error' => 'Invalid JSON data']);
        http_response_code(400);
        exit;
    }

    if (!isset($data['id_sessao'], $data['id_usuario'], $data['qntd_ingressos'], $data['valor_venda'], $data['filial_id'])) {
        echo json_encode(['error' => 'Campos não preenchidos']);
        http_response_code(400);
        exit;
    }

    $id_sessao = intval($data['id_sessao']);
    $id_usuario = intval($data['id_usuario']);
    $valor_venda = (float) $data['valor_venda'];
    $filial_id = intval($data['filial_id']);
    $qntd_ingressos = intval($data['qntd_ingressos']);

    $sql_check_availability = "SELECT salas.capacidade - COALESCE(SUM(vendas.qntd_ingressos), 0) AS assentos_disponiveis
                               FROM sessoes
                               JOIN salas ON sessoes.sala_id = salas.id_sala
                               LEFT JOIN vendas ON sessoes.id_sessao = vendas.id_sessao
                               WHERE sessoes.id_sessao = ?
                               GROUP BY salas.capacidade";
    $stmt_check_availability = $conn->prepare($sql_check_availability);
    $stmt_check_availability->bind_param("i", $id_sessao);
    $stmt_check_availability->execute();
    $result_check_availability = $stmt_check_availability->get_result();
    $row_check_availability = $result_check_availability->fetch_assoc();
    $assentos_disponiveis = $row_check_availability['assentos_disponiveis'] ?? 0;

    if ($assentos_disponiveis >= $qntd_ingressos) {
        $sql = 'INSERT INTO vendas (id_sessao, id_usuario, valor_venda, filial_id, qntd_ingressos)
                VALUES (?, ?, ?, ?, ?)';

        $conn->begin_transaction();

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iisii", $id_sessao, $id_usuario, $valor_venda, $filial_id, $qntd_ingressos);

            if ($stmt->execute()) {
                $sql_update_assentos = "UPDATE sessoes SET assentos_vendidos = assentos_vendidos + ? WHERE id_sessao = ?";
                $stmt_update_assentos = $conn->prepare($sql_update_assentos);
                $stmt_update_assentos->bind_param("ii", $qntd_ingressos, $id_sessao);
                $stmt_update_assentos->execute();

                $conn->commit();

                $venda = [
                    'id_sessao' => $id_sessao,
                    'id_usuario' => $id_usuario,
                    'valor_venda' => $valor_venda,
                    'filial_id' => $filial_id,
                    'qntd_ingressos' => $qntd_ingressos
                ];
                echo json_encode(['success' => true, 'message' => 'Venda realizada com sucesso', 'venda' => $venda]);
            } else {
                $conn->rollback();
                echo json_encode(['success' => false, 'message' => 'Ocorreu um problema ao realizar a venda', 'sql_error' => $conn->error]);
                http_response_code(500);
            }
        } catch (mysqli_sql_exception $e) {
            $conn->rollback();
            if ($e->getCode() === 45000) {
                echo json_encode(['error' => 'Quantidade de ingressos vendidos excede a capacidade da sala']);
                http_response_code(400);
            } else {
                echo json_encode(['error' => 'Ocorreu um erro no servidor', 'sql_error' => $e->getMessage()]);
                http_response_code(500);
            }
        }
    } else {
        echo json_encode(['error' => 'Nenhum assento disponível']);
        http_response_code(400);
    }
} else {
    echo json_encode(['error' => 'Request inválido']);
    http_response_code(405);
}

$conn->close();
?>