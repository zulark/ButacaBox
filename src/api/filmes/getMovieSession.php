<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
include '../db_connection.php';

if (isset($_GET['id'])) {
    $id_filme = intval($_GET['id']);
    $sql = "SELECT s.id_sessao, s.data, s.hora, salas.nome AS nome_sala, filmes.titulo AS nome_filme, filiais.nome AS nome_filial, s.preco_ingresso 
            FROM sessoes AS s 
            INNER JOIN salas ON s.sala_id = salas.id_sala 
            INNER JOIN filmes ON s.filme_id = filmes.id_filme 
            INNER JOIN filiais ON s.filial_id = filiais.id_filial
            WHERE s.filme_id = ? 
            ORDER BY s.id_sessao";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_filme);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $movie_sessions = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($movie_sessions);
    } else {
        echo json_encode(['error' => 'Sessões não encontradas para o filme com o ID fornecido']);
    }
} else {
    $sql = "SELECT s.id_sessao, s.data, s.hora, salas.nome AS nome_sala, filmes.titulo AS nome_filme, filiais.nome AS nome_filial, s.preco_ingresso 
            FROM sessoes AS s 
            INNER JOIN salas ON s.sala_id = salas.id_sala 
            INNER JOIN filmes ON s.filme_id = filmes.id_filme 
            INNER JOIN filiais ON s.filial_id = filiais.id_filial";
    $result = $conn->query($sql);

    if ($result) {
        $movie_sessions = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($movie_sessions);
    } else {
        echo json_encode([]);
    }
}

$conn->close();
?>
