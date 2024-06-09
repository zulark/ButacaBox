<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
include '../db_connection.php';

if (isset($_GET['id'])) {
    $id_setor = intval($_GET['id']);
    $sql = "SELECT id_setor, setores.nome, chefe_id, funcionarios.nome AS nome_chefe 
    FROM setores 
    JOIN funcionarios 
    ON setores.chefe_id = funcionarios.id_funcionario 
    WHERE id_setor = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_setor);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $setor = $result->fetch_assoc();
        echo json_encode($setor);
    } else {
        echo json_encode(['error' => 'Setor não encontrado']);
    }
} else {
    $sql = "SELECT id_setor, setores.nome, chefe_id, funcionarios.nome AS nome_chefe 
    FROM setores 
    JOIN funcionarios 
    ON setores.chefe_id = funcionarios.id_funcionario 
    ORDER BY id_setor";
    $result = $conn->query($sql);

    if ($result) {
        $setores = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($setores);
    } else {
        echo json_encode([]);
    }
}

$conn->close();
?>
