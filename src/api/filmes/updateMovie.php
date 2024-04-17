<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type");

include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id_filme = isset($_GET['id_filme']) ? intval($_GET['id_filme']) : null;

    if ($id_filme === null) {
        echo json_encode(['error' => 'ID do filme é obrigatório']);
        http_response_code(400);
        exit;
    }

    $update_fields = [];

    // Validate and sanitize input data
    if (isset($data['titulo'])) {
        $titulo = mysqli_real_escape_string($conn, $data['titulo']);
        $update_fields[] = "titulo = '$titulo'";
    }
    if (isset($data['cartaz_filme'])) {
        $cartaz_filme = mysqli_real_escape_string($conn, $data['cartaz_filme']);
        $update_fields[] = "cartaz_filme = '$cartaz_filme'";
    }
    if (isset($data['diretor'])) {
        $diretor = mysqli_real_escape_string($conn, $data['diretor']);
        $update_fields[] = "diretor = '$diretor'";
    }
    if (isset($data['genero'])) {
        $genero = mysqli_real_escape_string($conn, $data['genero']);
        $update_fields[] = "genero = '$genero'";
    }
    if (isset($data['duracao'])) {
        $duracao = intval($data['duracao']);
        $update_fields[] = "duracao = $duracao";
    }
    if (isset($data['fornecedor_id'])) {
        $fornecedor_id = intval($data['fornecedor_id']);
        $update_fields[] = "fornecedor_id = $fornecedor_id";
    }
    if (isset($data['descricao'])) {
        $descricao = mysqli_real_escape_string($conn, $data['descricao']);
        $update_fields[] = "descricao = '$descricao'";
    }

    if (empty($update_fields)) {
        echo json_encode(['error' => 'Nenhum dado fornecido para atualização']);
        http_response_code(400);
        exit;
    }

    $update_sql = "UPDATE filmes SET " . implode(", ", $update_fields) . " WHERE id_filme = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $id_filme);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Filme atualizado com sucesso']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Nenhum dado foi atualizado ou ID do filme não encontrado']);
        http_response_code(404); // Consider using 404 status code for resource not found
    }
} else {
    echo json_encode(['error' => 'Método de requisição inválido']);
    http_response_code(405);
}

$conn->close();
?>
