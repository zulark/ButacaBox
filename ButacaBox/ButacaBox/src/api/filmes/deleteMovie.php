<?php
header("Content-Type: application/json");
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id_filme'])) {
    $id_filme = isset($_GET['id_filme']) ? intval($_GET['id_filme']) : null;

    if ($id_filme === null) {
        echo json_encode(['error' => 'id_filme é obrigatório']);
        http_response_code(400); 
        exit;
    }

    $check_sql = "SELECT * FROM filmes WHERE id_filme = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $id_filme);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows === 0) {
        echo json_encode(['error' => 'Filme não encontrado']);
        http_response_code(404); 
        exit;
    }

    $delete_sql = "DELETE FROM filmes WHERE id_filme = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $id_filme);
    $delete_stmt->execute();

    if ($delete_stmt->affected_rows > 0) {
        echo json_encode(['success' => 'Filme excluído com sucesso']);
        http_response_code(204); 
    } else {
        echo json_encode(['error' => 'Erro ao excluir o filme']);
        http_response_code(500); 
    }
} elseif (isset($_GET['id_filme'])) {
    $id_filme = isset($_GET['id_filme']) ? intval($_GET['id_filme']) : null;

    if ($id_filme === null) {
        echo json_encode(['error' => 'id_filme é obrigatório']);
        http_response_code(400); 
        exit;
    }

    $sql = "SELECT * FROM filmes WHERE id_filme = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_filme);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
        echo json_encode($movie);
    } else {
        echo json_encode(['error' => 'Filme não encontrado']);
        http_response_code(404); 
    }
} else {
    $sql = "SELECT * FROM filmes";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $movies = [];

        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }

        echo json_encode($movies);
    } else {
        echo json_encode([]);
    }
}

$conn->close();
?>
