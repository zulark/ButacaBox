<?php
include 'db_connection.php';
$sql = "SELECT * FROM filme";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $movies = [];

    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }

    echo json_encode($movies);
} else {
    echo json_encode([]);
}

$conn->close();
?>