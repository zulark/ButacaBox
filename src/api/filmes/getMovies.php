    <?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");
    include '../db_connection.php';

    if (isset($_GET['id'])) {
        $id_filme = intval($_GET['id']);
        $sql = "SELECT id_filme, titulo, cartaz_filme, diretor, genero, duracao, fornecedor_id, status_filme, descricao, youtube_url, 
        fornecedores.nome AS fornecedor 
        FROM filmes 
        INNER JOIN fornecedores ON filmes.fornecedor_id = fornecedores.id_fornecedor
        WHERE id_filme = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_filme);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $movie = $result->fetch_assoc();
            echo json_encode($movie);
        } else {
            echo json_encode(['error' => 'Filme não encontrado']);
        }
    } else {
        $sql = "SELECT id_filme, titulo, cartaz_filme, diretor, genero, duracao, fornecedor_id, status_filme, descricao, youtube_url, 
        fornecedores.nome AS fornecedor 
        FROM filmes 
        INNER JOIN fornecedores ON filmes.fornecedor_id = fornecedores.id_fornecedor
        ORDER BY id_filme";
        $result = $conn->query($sql);

        if ($result) {
            $movies = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($movies);
        } else {
            echo json_encode([]);
        }
    }

    $conn->close();
    ?>