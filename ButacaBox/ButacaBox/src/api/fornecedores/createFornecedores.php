<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: POST"); 
header("Access-Control-Allow-Headers: Content-Type"); 
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['nome'], $data['email'], $data['telefone'])) {
        echo json_encode(['error' => 'Campos não preenchidos']);
        http_response_code(400);
        exit;
    }

    $nome = mysqli_real_escape_string($conn, $data['nome']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $telefone = mysqli_real_escape_string($conn, $data['telefone']);


    $sql = "INSERT INTO fornecedores (nome, telefone, email) 
            VALUES ('$nome', '$telefone', '$email')";

    if ($conn->query($sql) === TRUE) {
        $new_room = 
        [
            'nome' => $nome,
            'telefone' => $telefone,
            'email' => $email
        ];
        echo json_encode(['success' => true, 'message' => 'Fornecedor adicionada com sucesso', 'room' => $new_room]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Erro ao adicionar fornecedor', 'sql_error' => $conn->error]);
        http_response_code(500);
    }
} else {
    echo json_encode(['error' => 'Request Inválido']);
    http_response_code(405);
}

$conn->close();
?>
