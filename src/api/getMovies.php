<?php
header("Content-Type: application/json");
include 'db_connection.php';

if (isset($_GET['id_filme'])) {
    $id_filme = mysqli_real_escape_string($conn, $_GET['id_filme']);

    $sql = "SELECT * FROM filme WHERE id_filme = $id_filme";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
        echo json_encode($movie);
    } else {
        echo json_encode(['error' => 'Filme não encontrado']);
    }
} else {
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
}

$conn->close();
?>
