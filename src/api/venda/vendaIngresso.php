<?php
session_start(); // Inicie a sessão no início do script

header("Content-Type: application/json");
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se o usuário está logado
    if (!isset($_SESSION['id_usuario'])) {
        echo json_encode(['error' => 'Usuário não logado']);
        http_response_code(401);
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['id_sessao'], $data['id_assento'], $data['data_venda'], $data['valor_venda'], $data['filial_id'])) {
        echo json_encode(['error' => 'Campos não preenchidos']);
        http_response_code(400);
        exit;
    }

    $id_assento = mysqli_real_escape_string($conn, $data['id_assento']);
    $id_sessao = mysqli_real_escape_string($conn, $data['id_sessao']);
    $data_venda = mysqli_real_escape_string($conn, $data['data_venda']);
    $id_usuario = intval($data['id_usuario']);
    $valor_venda = mysqli_real_escape_string($conn, $data['valor_venda']);
    $filial_id = intval($data['filial_id']);

    $sql = "INSERT INTO vendas (id_sessao, id_assento, id_usuario, data_venda, valor_venda, filial_id) 
            VALUES ('$id_sessao', '$id_assento', '$id_usuario', '$data_venda', '$valor_venda', '$filial_id')";

    if ($conn->query($sql) === TRUE) {
        $venda = [
            'id_sessao' => $id_sessao,
            'id_assento' => $id_assento,
            'id_usuario' => $id_usuario,
            'data_venda' => $data_venda,
            'filial_id' => $filial_id,
        ];
        echo json_encode(['success' => true, 'message' => 'Venda realizada com sucesso', 'venda' => $venda]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Erro ao realizar venda', 'sql_error' => $conn->error]);
        http_response_code(500);
    }
} else {
    echo json_encode(['error' => 'Request Inválido']);
    http_response_code(405);
}

$conn->close();
?>
