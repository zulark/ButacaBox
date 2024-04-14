<?php
header("Content-Type: application/json");
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    $id_filme = isset($_GET['id_filme']) ? intval($_GET['id_filme']) : null;

    if ($id_filme === null) {
        echo json_encode(['error' => 'Missing id_filme parameter']);
        http_response_code(400);
        exit;
    }

    if (!isset($data['titulo'], $data['cartaz_filme'], $data['diretor'], $data['genero'], $data['fk_fornecedor_id'])) {
        echo json_encode(['error' => 'Missing required fields']);
        http_response_code(400); 
        exit;
    }
    $titulo = mysqli_real_escape_string($conn, $data['titulo']);
    $cartaz_filme = mysqli_real_escape_string($conn, $data['cartaz_filme']);
    $diretor = mysqli_real_escape_string($conn, $data['diretor']);
    $genero = mysqli_real_escape_string($conn, $data['genero']);
    $fk_fornecedor_id = intval($data['fk_fornecedor_id']);

    $sql = "UPDATE filme SET 
                titulo = '$titulo', 
                cartaz_filme = '$cartaz_filme', 
                diretor = '$diretor', 
                genero = '$genero', 
                fk_fornecedor_id = $fk_fornecedor_id 
            WHERE id_filme = $id_filme";

    if ($conn->query($sql) === TRUE) {
        $updated_movie = [
            'id_filme' => $id_filme,
            'titulo' => $titulo,
            'cartaz_filme' => $cartaz_filme,
            'diretor' => $diretor,
            'genero' => $genero,
            'fk_fornecedor_id' => $fk_fornecedor_id
        ];
        echo json_encode(['message' => 'Filme atualizado com sucesso', 'movie' => $updated_movie]);
    } else {
        echo json_encode(['error' => 'Erro ao atualizar filme', 'sql_error' => $conn->error]);
        http_response_code(500);
    }
} else {
    echo json_encode(['error' => 'Request Inválido']);
    http_response_code(405);
}

$conn->close();
?>
