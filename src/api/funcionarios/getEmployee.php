<?php
header("Content-Type: application/json");
include '../db_connection.php';

if (isset($_GET['id'])) {
    $id_funcionario = intval($_GET['id']);
    $sql = "SELECT f.id_funcionario, f.nome, email, filial_id, setor_id, salario_base, 
            filiais.nome AS nome_filial, setores.nome AS nome_setor
            FROM funcionarios AS f
            INNER JOIN filiais ON f.filial_id = filiais.id_filial
            INNER JOIN setores ON f.setor_id = setores.id_setor
            WHERE f.id_funcionario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_funcionario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $funcionario = $result->fetch_assoc(); 
        echo json_encode($funcionario);
    } else {
        echo json_encode(['error' => 'Funcionario não encontrado']);
    }
} else {
    $sql = "SELECT f.id_funcionario, f.nome, email, filial_id, setor_id, salario_base,
            filiais.nome AS nome_filial, setores.nome AS nome_setor
            FROM funcionarios AS f
            INNER JOIN filiais ON f.filial_id = filiais.id_filial
            INNER JOIN setores ON f.setor_id = setores.id_setor
            ORDER BY f.id_funcionario";
    $result = $conn->query($sql);

    if ($result) {
        $funcionarios = $result->fetch_all(MYSQLI_ASSOC); 
        echo json_encode($funcionarios);
    } else {
        echo json_encode([]);
    }
}

$conn->close();
?>
