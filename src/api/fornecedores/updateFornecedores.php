<?php
header("Content-Type: application/json");
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id_fornecedor = isset($_GET['id']) ? intval($_GET['id']) : null;

    if ($id_fornecedor === null) {
        echo json_encode(['error' => 'ID é obrigatório']);
        http_response_code(400);
        exit;
    }

    $update_fields = [];

    if (isset($data['nome'])) {
        $nome = mysqli_real_escape_string($conn, $data['nome']);
        $update_fields[] = "nome = '$nome'";
    }
    if (isset($data['email'])) {
        $email = mysqli_real_escape_string($conn, $data['email']);
        $update_fields[] = "email = '$email'";
    }
    if (isset($data['telefone'])) {
        $telefone = mysqli_real_escape_string($conn, $data['telefone']);
        $update_fields[] = "telefone = '$telefone'";
    }
    $update_sql = "UPDATE fornecedores SET " . implode(", ", $update_fields) . " WHERE id_fornecedor = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $id_fornecedor);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['message' => 'Fornecedor atualizado com sucesso']);
    } else {
        echo json_encode(['error' => 'Erro ao atualizar funcionario']);
        http_response_code(500);
    }
} else {
    echo json_encode(['error' => 'Request Inválido']);
    http_response_code(405);
}

$conn->close();
?>
