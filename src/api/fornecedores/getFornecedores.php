<?php
header("Content-Type: application/json");
include '../db_connection.php';

if (isset($_GET['id'])) {
    $id_fornecedor = intval($_GET['id']);
    $sql = "SELECT * from fornecedores
            WHERE id_fornecedor = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_fornecedor);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $fornecedores = $result->fetch_assoc();
        echo json_encode($fornecedores);
    } else {
        echo json_encode(['error' => 'Fornecedor não encontrado']);
    }
} else {
    $sql = "SELECT * from fornecedores
            ORDER BY id_fornecedor";
    $result = $conn->query($sql);

    if ($result) {
        $fornecedores = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($fornecedores);
    } else {
        echo json_encode([]);
    }
}

$conn->close();
?>