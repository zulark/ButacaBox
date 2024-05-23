<?php
header("Content-Type: application/json");
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id_funcionario = isset($_GET['id']) ? intval($_GET['id']) : null;

    if ($id_funcionario === null) {
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
    if (isset($data['senha'])) {
        $senha = mysqli_real_escape_string($conn, $data['senha']);
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $update_fields[] = "senha = '$senha_hash'";
    }
    if (isset($data['salario_base'])) {
        $salario_base = mysqli_real_escape_string($conn, (string) (float) $data['salario_base']);
        $update_fields[] = "salario_base = '$salario_base'";
    }
    if (isset($data['filial_id'])) {
        $filial_id = mysqli_real_escape_string($conn, $data['filial_id']);
        $update_fields[] = "filial_id = '$filial_id'";
    }
    $update_sql = "UPDATE funcionarios SET " . implode(", ", $update_fields) . " WHERE id_funcionario = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $id_funcionario);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['message' => 'Funcionario atualizado com sucesso']);
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
