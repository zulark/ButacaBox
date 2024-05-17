<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

include '../db_connection.php';

function getAvailableSeats($conn, $id_sessao, $capacidade_sala) {
    $sql_check_availability = "SELECT COALESCE(SUM(qntd_ingressos), 0) AS assentos_ocupados FROM vendas WHERE id_sessao = ?";
    $stmt_check_availability = $conn->prepare($sql_check_availability);
    $stmt_check_availability->bind_param("i", $id_sessao);
    $stmt_check_availability->execute();
    $result_check_availability = $stmt_check_availability->get_result();
    $row_check_availability = $result_check_availability->fetch_assoc();
    $assentos_ocupados = $row_check_availability['assentos_ocupados'] ?? 0;

    return $capacidade_sala - $assentos_ocupados;
}

if (isset($_GET['id'])) {
    $id_filme = intval($_GET['id']);
    $sql = "SELECT s.id_sessao, s.data_sessao, s.hora_sessao, salas.nome AS nome_sala, salas.capacidade AS capacidade_sala, filmes.titulo AS nome_filme, filiais.id_filial, filiais.nome AS nome_filial, s.preco_ingresso
            FROM sessoes AS s 
            INNER JOIN salas ON s.sala_id = salas.id_sala 
            INNER JOIN filmes ON s.filme_id = filmes.id_filme 
            INNER JOIN filiais ON s.filial_id = filiais.id_filial 
            WHERE s.filme_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_filme);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $sessions = array();
        while ($row = $result->fetch_assoc()) {
            $assentos_disponiveis = getAvailableSeats($conn, $row['id_sessao'], $row['capacidade_sala']);
            $sessions[] = array(
                "id_sessao" => $row['id_sessao'],
                "id_filial" => $row['id_filial'],
                "nome_filial" => $row['nome_filial'],
                "nome_sala" => $row['nome_sala'],
                "capacidade_sala" => $row['capacidade_sala'],
                "assentos_disponiveis" => $assentos_disponiveis,
                "data_sessao" => $row['data_sessao'],
                "hora_sessao" => $row['hora_sessao'],
                "nome_filme" => $row['nome_filme'],
                "preco_ingresso" => $row['preco_ingresso']
            );
        }
        echo json_encode($sessions);
    } else {
        echo json_encode(['error' => 'Sessões não encontradas para o filme com o ID fornecido']);
    }
} else {
    $sql = "SELECT s.id_sessao, s.data_sessao, s.hora_sessao, salas.nome AS nome_sala, salas.capacidade AS capacidade_sala, filmes.titulo AS nome_filme, filiais.id_filial, filiais.nome AS nome_filial, s.preco_ingresso
            FROM sessoes AS s 
            INNER JOIN salas ON s.sala_id = salas.id_sala 
            INNER JOIN filmes ON s.filme_id = filmes.id_filme 
            INNER JOIN filiais ON s.filial_id = filiais.id_filial";
    $result = $conn->query($sql);
    if ($result) {
        $movie_sessions = array();
        while ($row = $result->fetch_assoc()) {
            $assentos_disponiveis = getAvailableSeats($conn, $row['id_sessao'], $row['capacidade_sala']);
            $movie_sessions[] = array(
                "id_sessao" => $row['id_sessao'],
                "id_filial" => $row['id_filial'],
                "nome_filial" => $row['nome_filial'],
                "nome_sala" => $row['nome_sala'],
                "capacidade_sala" => $row['capacidade_sala'],
                "assentos_disponiveis" => $assentos_disponiveis,
                "data_sessao" => $row['data_sessao'],
                "hora_sessao" => $row['hora_sessao'],
                "nome_filme" => $row['nome_filme'],
                "preco_ingresso" => $row['preco_ingresso']
            );
        }
        echo json_encode($movie_sessions);
    } else {
        echo json_encode(['error' => 'Nenhuma sessão encontrada']);
    }
}
$conn->close();
?>
