<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
include '../db_connection.php';

if (isset($_GET['id'])) {
    $id_filme = intval($_GET['id']);
    $sql = "SELECT s.id_sessao, s.data_sessao, s.hora_sessao, salas.nome AS nome_sala, filmes.titulo AS nome_filme, filiais.nome AS nome_filial, s.preco_ingresso, assento_sala.id_assento, assento_sala.numeracao, IFNULL(assento_sessao.disponibilidade, 1) AS disponibilidade
            FROM sessoes AS s 
            INNER JOIN salas ON s.sala_id = salas.id_sala 
            INNER JOIN filmes ON s.filme_id = filmes.id_filme 
            INNER JOIN filiais ON s.filial_id = filiais.id_filial 
            LEFT JOIN assento_sala ON s.sala_id = assento_sala.sala_id
            LEFT JOIN assento_sessao ON assento_sala.id_assento = assento_sessao.id_assento AND s.id_sessao = assento_sessao.id_sessao
            WHERE s.filme_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_filme);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $sessions = array();
        while ($row = $result->fetch_assoc()) {
            $session_id = $row['id_sessao'];
            if (!isset($sessions[$session_id])) {
                $sessions[$session_id] = array(
                    "id_sessao" => $session_id,
                    "data_sessao" => $row['data_sessao'],
                    "hora_sessao" => $row['hora_sessao'],
                    "nome_sala" => $row['nome_sala'],
                    "nome_filme" => $row['nome_filme'],
                    "nome_filial" => $row['nome_filial'],
                    "preco_ingresso" => $row['preco_ingresso'],
                    "assentos_disponiveis" => array()
                );
            }
            if ($row['id_assento'] !== null) {
                $sessions[$session_id]["assentos_disponiveis"][] = array(
                    "id_assento" => $row['id_assento'],
                    "numeracao" => $row['numeracao'],
                    "disponibilidade" => $row['disponibilidade']
                );
            }
        }
        echo json_encode(array_values($sessions));
    } else {
        echo json_encode(['error' => 'Sessões não encontradas para o filme com o ID fornecido']);
    }
} else {
    $sql = "SELECT s.id_sessao, s.data_sessao, s.hora_sessao, salas.nome AS nome_sala, filmes.titulo AS nome_filme, filiais.nome AS nome_filial, s.preco_ingresso, assento_sala.id_assento, assento_sala.numeracao, IFNULL(assento_sessao.disponibilidade, 1) AS disponibilidade
            FROM sessoes AS s 
            INNER JOIN salas ON s.sala_id = salas.id_sala 
            INNER JOIN filmes ON s.filme_id = filmes.id_filme 
            INNER JOIN filiais ON s.filial_id = filiais.id_filial 
            LEFT JOIN assento_sala ON s.sala_id = assento_sala.sala_id
            LEFT JOIN assento_sessao ON assento_sala.id_assento = assento_sessao.id_assento AND s.id_sessao = assento_sessao.id_sessao";
    $result = $conn->query($sql);

    if ($result) {
        $movie_sessions = array();
        while ($row = $result->fetch_assoc()) {
            $session_id = $row['id_sessao'];
            if (!isset($movie_sessions[$session_id])) {
                $movie_sessions[$session_id] = array(
                    "id_sessao" => $session_id,
                    "data_sessao" => $row['data_sessao'],
                    "hora_sessao" => $row['hora_sessao'],
                    "nome_sala" => $row['nome_sala'],
                    "nome_filme" => $row['nome_filme'],
                    "nome_filial" => $row['nome_filial'],
                    "preco_ingresso" => $row['preco_ingresso'],
                    "assentos_disponiveis" => array()
                );
            }
            if ($row['id_assento'] !== null) {
                $movie_sessions[$session_id]["assentos_disponiveis"][] = array(
                    "id_assento" => $row['id_assento'],
                    "numeracao" => $row['numeracao'],
                    "disponibilidade" => $row['disponibilidade']
                );
            }
        }
        echo json_encode(array_values($movie_sessions));
    } else {
        echo json_encode(['error' => 'Nenhuma sessão encontrada']);
    }
}

$conn->close();
?>
