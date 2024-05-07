<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
include '../db_connection.php';

if (isset($_GET['id'])) {
    $id_sessao = intval($_GET['id']);
    $sql = "SELECT s.*, assento_sala.id_assento, assento_sala.numeracao, assento_sala.disponibilidade
            FROM sessoes AS s 
            INNER JOIN assento_sala ON s.sala_id = assento_sala.sala_id
            WHERE s.id_sessao = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_sessao);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $session = $result->fetch_assoc();
        $session['assentos_disponiveis'] = array();

        while ($row = $result->fetch_assoc()) {
            $session['assentos_disponiveis'][] = array(
                "id_assento" => $row['id_assento'],
                "numeracao" => $row['numeracao'],
                "disponibilidade" => $row['disponibilidade']
            );
        }

        echo json_encode($session);
    } else {
        echo json_encode(['error' => 'Esta sessão está indisponível']);
    }
} else {
    $sql = "SELECT s.id_sessao, s.data_sessao, s.hora_sessao, salas.nome AS nome_sala, filmes.titulo AS nome_filme, filiais.nome AS nome_filial, s.preco_ingresso 
        FROM sessoes AS s 
        INNER JOIN filmes ON s.filme_id = filmes.id_filme 
        INNER JOIN salas ON s.sala_id = salas.id_sala 
        INNER JOIN filiais ON s.filial_id = filiais.id_filial";
    $result = $conn->query($sql);

    if ($result) {
        $sessions = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($sessions);
    } else {
        echo json_encode([]);
    }
}

$conn->close();
?>
