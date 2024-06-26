<?php
header("Content-Type: application/json");
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['nome'], $data['email'], $data['senha'], $data['filial_id'], $data['salario_base'], $data['setor_id'])) {
        echo json_encode(['error' => 'Campos não preenchidos']);
        http_response_code(400);
        exit;
    }
    $nome = mysqli_real_escape_string($conn, $data['nome']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $senha = mysqli_real_escape_string($conn, $data['senha']);
    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
    $filial_id = intval($data['filial_id']);
    $setor_id = intval($data['setor_id']);
    $salario_base = mysqli_real_escape_string($conn, (string) (float) $data['salario_base']);

    $sql = "INSERT INTO funcionarios (nome, email, senha, filial_id, setor_id, salario_base) 
            VALUES ('$nome', '$email', '$senhaCriptografada', '$filial_id', '$setor_id', '$salario_base')";

    if ($conn->query($sql) === TRUE) {
        $new_employee = [
            'nome' => $nome,
            'email' => $email,
            'senha' => $senhaCriptografada,
            'filial_id' => $filial_id,
            'setor_id' => $setor_id,
            'salario_base' => $salario_base
        ];
        echo json_encode(['success' => true, 'message' => 'Funcionário criado com sucesso', 'employee' => $new_employee]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Erro ao criar funcionário', 'sql_error' => $conn->error]);
        http_response_code(500);
    }
} else {
    echo json_encode(['error' => 'Request Inválido']);
    http_response_code(405);
}
$conn->close();
?>