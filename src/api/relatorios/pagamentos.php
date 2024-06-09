<?php
header("Content-Type: application/json");
include '../../api/db_connection.php';

$filial_id = isset($_POST['filial_id']) ? $_POST['filial_id'] : '';
$sql = "
SELECT
    fi.id_filial,
    fi.nome,
    SUM(fu.salario_base) AS valor_total_pagamentos
FROM
    filiais fi
JOIN
    funcionarios fu ON fi.id_filial = fu.filial_id
WHERE
    1=1
";

if ($filial_id != '') {
    $sql .= " AND fi.id_filial = " . $conn->real_escape_string($filial_id);
}

$sql .= "
GROUP BY
    fi.id_filial,
    fi.nome
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
