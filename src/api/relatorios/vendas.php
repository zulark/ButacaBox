<?php
header("Content-Type: application/json");
include '../../api/db_connection.php';

$filial_id = isset($_POST['filial_id']) ? $_POST['filial_id'] : '';
$periodo = isset($_POST['periodo']) ? $_POST['periodo'] : '';
$ano = isset($_POST['ano']) ? $_POST['ano'] : '';
$mes = isset($_POST['mes']) ? $_POST['mes'] : '';

$conn->query("SET lc_time_names = 'pt_BR'");

$sql = "
SELECT
    f.id_filial,
    f.nome,
    DATE_FORMAT(s.data_sessao, '%Y-%m') AS periodo,
    SUM(v.valor_venda) AS valor_total_vendas,
    SUM(v.qntd_ingressos) AS total_ingressos_vendidos
FROM
    filiais f
JOIN
    sessoes s ON f.id_filial = s.filial_id
JOIN
    vendas v ON s.id_sessao = v.id_sessao
WHERE
    1=1
";

if ($filial_id != '') {
    $sql .= " AND f.id_filial = " . $conn->real_escape_string($filial_id);
}

if ($ano != '') {
    $sql .= " AND YEAR(s.data_sessao) = " . $conn->real_escape_string($ano);
}

if ($mes != '') {
    $sql .= " AND MONTH(s.data_sessao) = " . $conn->real_escape_string($mes);
}

$sql .= "
GROUP BY
    f.id_filial,
    f.nome,
    DATE_FORMAT(s.data_sessao, '%Y-%m')
ORDER BY
    periodo DESC
";

$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();
echo json_encode($data);
?>
