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
    f.titulo AS nome_filme,
    se.sala_id,
    sa.nome AS nome_sala,
    se.filial_id,
    fi.nome AS nome_filial,
    se.preco_ingresso,
    COALESCE(SUM(v.qntd_ingressos), 0) AS ingressos_vendidos,
    (SELECT capacidade FROM salas WHERE id_sala = se.sala_id) AS capacidade,
    (SELECT capacidade - COALESCE(SUM(qntd_ingressos), 0) FROM vendas WHERE id_sessao = se.id_sessao) AS assentos_disponiveis
FROM 
    sessoes se
LEFT JOIN 
    vendas v ON se.id_sessao = v.id_sessao
JOIN 
    salas sa ON se.sala_id = sa.id_sala
JOIN 
    filmes f ON se.filme_id = f.id_filme
JOIN 
    filiais fi ON se.filial_id = fi.id_filial
WHERE se.id_sessao = ?
GROUP BY 
    se.id_sessao, 
    se.data_sessao, 
    se.hora_sessao, 
    se.filme_id, 
    se.sala_id, 
    se.filial_id, 
    se.preco_ingresso";
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
    f.titulo AS nome_filme,
    se.sala_id,
    sa.nome AS nome_sala,
    se.filial_id,
    fi.nome AS nome_filial,
    se.preco_ingresso,
    COALESCE(SUM(v.qntd_ingressos), 0) AS ingressos_vendidos,
    (SELECT capacidade FROM salas WHERE id_sala = se.sala_id) AS capacidade,
    (SELECT capacidade - COALESCE(SUM(qntd_ingressos), 0) FROM vendas WHERE id_sessao = se.id_sessao) AS assentos_disponiveis
FROM 
    sessoes se
LEFT JOIN 
    vendas v ON se.id_sessao = v.id_sessao
JOIN 
    salas sa ON se.sala_id = sa.id_sala
JOIN 
    filmes f ON se.filme_id = f.id_filme
JOIN 
    filiais fi ON se.filial_id = fi.id_filial
GROUP BY 
    se.id_sessao, 
    se.data_sessao, 
    se.hora_sessao, 
    se.filme_id, 
    se.sala_id, 
    se.filial_id, 
    se.preco_ingresso";
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
