<?php
header("Content-Type: application/json");
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id_sessao = isset($_GET['id']) ? intval($_GET['id']) : null;

    if ($id_sessao === null) {
        echo json_encode(['error' => 'id_sessao é obrigatório']);
        http_response_code(400); 
        exit;
    }

    $delete_sql = "DELETE FROM sessoes WHERE id_sessao = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id_sessao);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['Sessão excluída com sucesso']);
        http_response_code(204); 
    } else {
        echo json_encode(['error' => 'Sessão não encontrada']);
        http_response_code(404); 
    }
} elseif (isset($_GET['id_sessao'])) {
    $id_sessao = isset($_GET['id_sessao']) ? intval($_GET['id_sessao']) : null;

    if ($id_sessao === null) {
        echo json_encode(['error' => 'id_sessao é obrigatório']);
        http_response_code(400); 
        exit;
    }

    $sql = "SELECT * FROM funcionarios WHERE id_sessao = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_sessao);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
        echo json_encode($employee);
    } else {
        echo json_encode(['error' => 'Sessão não encontrada']);
        http_response_code(404); 
    }
} else {
    $sql = "SELECT * FROM sessoes";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $employees = [];

        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }

        echo json_encode($employees);
    } else {
        echo json_encode([]);
    }
}

$conn->close();
?>
