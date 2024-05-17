<?php
// Database connection code
include '../db_connection.php';
if (isset($_GET['id'])) {
    $id_filme = intval($_GET['id']);
    $sql = "SELECT 
    se.id_sessao,
    se.data_sessao,
    se.hora_sessao,
    se.filme_id,
    se.sala_id,
    se.filial_id,
    se.preco_ingresso,
    COALESCE(SUM(v.qntd_ingressos), 0) AS ingressos_vendidos,
    s.capacidade,
    (s.capacidade - COALESCE(SUM(v.qntd_ingressos), 0)) AS assentos_disponiveis
FROM 
    sessoes se
LEFT JOIN 
    vendas v ON se.id_sessao = v.id_sessao
JOIN 
    salas s ON se.sala_id = s.id_sala
WHERE se.id_sessao = ?
GROUP BY 
    se.id_sessao, 
    se.data_sessao, 
    se.hora_sessao, 
    se.filme_id, 
    se.sala_id, 
    se.filial_id, 
    se.preco_ingresso, 
    s.capacidade
HAVING 
    assentos_disponiveis >= 0;
";
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
    $sql = "SELECT 
    se.id_sessao,
    se.data_sessao,
    se.hora_sessao,
    se.filme_id,
    se.sala_id,
    se.filial_id,
    se.preco_ingresso,
    COALESCE(SUM(v.qntd_ingressos), 0) AS ingressos_vendidos,
    s.capacidade,
    (s.capacidade - COALESCE(SUM(v.qntd_ingressos), 0)) AS assentos_disponiveis
FROM 
    sessoes se
LEFT JOIN 
    vendas v ON se.id_sessao = v.id_sessao
JOIN 
    salas s ON se.sala_id = s.id_sala
GROUP BY 
    se.id_sessao, 
    se.data_sessao, 
    se.hora_sessao, 
    se.filme_id, 
    se.sala_id, 
    se.filial_id, 
    se.preco_ingresso, 
    s.capacidade
HAVING 
    assentos_disponiveis >= 0;
";
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