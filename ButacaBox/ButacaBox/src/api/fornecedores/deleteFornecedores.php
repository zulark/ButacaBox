<?php
header("Content-Type: application/json");
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id_fornecedor = isset($_GET['id']) ? intval($_GET['id']) : null;

    if ($id_fornecedor === null) {
        echo json_encode(['error' => 'id_fornecedor é obrigatório']);
        http_response_code(400); 
        exit;
    }

    $delete_sql = "DELETE FROM fornecedores WHERE id_fornecedor = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id_fornecedor);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['Sessão excluída com sucesso']);
        http_response_code(204); 
    } else {
        echo json_encode(['error' => 'Sessão não encontrada']);
        http_response_code(404); 
    }
} elseif (isset($_GET['id_fornecedor'])) {
    $id_fornecedor = isset($_GET['id_fornecedor']) ? intval($_GET['id_fornecedor']) : null;

    if ($id_fornecedor === null) {
        echo json_encode(['error' => 'id_fornecedor é obrigatório']);
        http_response_code(400); 
        exit;
    }

    $sql = "SELECT * FROM fornecedores WHERE id_fornecedor = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_fornecedor);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $provider = $result->fetch_assoc();
        echo json_encode($provider);
    } else {
        echo json_encode(['error' => 'Sessão não encontrada']);
        http_response_code(404); 
    }
} else {
    $sql = "SELECT * FROM fornecedores";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $providers = [];

        while ($row = $result->fetch_assoc()) {
            $providers[] = $row;
        }

        echo json_encode($providers);
    } else {
        echo json_encode([]);
    }
}

$conn->close();
?>
