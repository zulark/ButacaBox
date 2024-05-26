<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: POST"); 
header("Access-Control-Allow-Headers: Content-Type"); 
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['nome'], $data['capacidade'])) {
        echo json_encode(['error' => 'Campos não preenchidos']);
        http_response_code(400);
        exit;
    }

    $nome = mysqli_real_escape_string($conn, $data['nome']);
    $capacidade = intval($data['capacidade']);


    $sql = "INSERT INTO salas (nome, capacidade) 
            VALUES ('$nome', '$capacidade')";

    if ($conn->query($sql) === TRUE) {
        $new_room = 
        [
            'nome' => $nome,
            'capacidade' => $capacidade
        ];
        echo json_encode(['success' => true, 'message' => 'Sala adicionada com sucesso', 'room' => $new_room]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Erro ao adicionar sala', 'sql_error' => $conn->error]);
        http_response_code(500);
    }
} else {
    echo json_encode(['error' => 'Request Inválido']);
    http_response_code(405);
}

$conn->close();
?>
