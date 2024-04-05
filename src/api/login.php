<?php
include 'db_connection.php';
$sql = "SELECT * FROM funcionario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $funcionario = [];

    while ($row = $result->fetch_assoc()) {
        $funcionario[] = $row;
    }

    echo json_encode($funcionario);
} else {
    echo json_encode([]);
}

$conn->close();
?>