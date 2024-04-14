<?php
header("Content-Type: application/json");
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id_filme = isset($_GET['id_filme']) ? intval($_GET['id_filme']) : null;

    if ($id_filme === null) {
        echo json_encode(['error' => 'id_filme é obrigatório']);
        http_response_code(400); 
        exit;
    }

    $delete_sql = "DELETE FROM filme WHERE id_filme = $id_filme";

    if ($conn->query($delete_sql) === TRUE) {
        echo json_encode(['message' => 'Filme excluído com sucesso']);
    } else {
        echo json_encode(['error' => 'Erro ao deletar o filme: ', 'sql_error' => $conn->error]);
        http_response_code(500); 
    }
} elseif (isset($_GET['id_filme'])) {
    $id_filme = mysqli_real_escape_string($conn, $_GET['id_filme']);

    $sql = "SELECT * FROM filme WHERE id_filme = $id_filme";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
        echo json_encode($movie);
    } else {
        echo json_encode(['error' => 'Filme não encontrado']);
    }
} else {
    $sql = "SELECT * FROM filme";
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
