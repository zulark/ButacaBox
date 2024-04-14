<?php
header("Content-Type: application/json");
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['titulo'], $data['cartaz_filme'], $data['diretor'], $data['genero'], $data['fornecedor_id'], $data['descricao'])) {
        echo json_encode(['error' => 'Campos não preenchidos']);
        http_response_code(400);
        exit;
    }

    $max_id_query = "SELECT MAX(id_filme) AS max_id FROM filmes";
    $result = $conn->query($max_id_query);
    $row = $result->fetch_assoc();
    $new_movie_id = $row['max_id'] + 1;

    $titulo = mysqli_real_escape_string($conn, $data['titulo']);
    $cartaz_filme = mysqli_real_escape_string($conn, $data['cartaz_filme']);
    $diretor = mysqli_real_escape_string($conn, $data['diretor']);
    $genero = mysqli_real_escape_string($conn, $data['genero']);
    $fornecedor_id = intval($data['fornecedor_id']);
    $descricao = mysqli_real_escape_string($conn, $data['descricao']);

    $sql = "INSERT INTO filmes (titulo, cartaz_filme, diretor, genero, fornecedor_id, descricao) 
            VALUES ('$titulo', '$cartaz_filme', '$diretor', '$genero', $fornecedor_id, '$descricao')";

    if ($conn->query($sql) === TRUE) {
        $new_movie = [
            'titulo' => $titulo,
            'cartaz_filme' => $cartaz_filme,
            'diretor' => $diretor,
            'genero' => $genero,
            'fornecedor_id' => $fornecedor_id,
            'descricao' => $descricao
        ];
        echo json_encode(['message' => 'Filme criado com sucesso', 'movie' => $new_movie]);
    } else {
        echo json_encode(['error' => 'Erro ao criar filme', 'sql_error' => $conn->error]);
        http_response_code(500);
    }
} else {
    echo json_encode(['error' => 'Request Inválido']);
    http_response_code(405);
}

$conn->close();
?>
