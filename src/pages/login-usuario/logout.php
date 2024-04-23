<?php

if (!isset($_SESSION)) {
    session_start();
}

session_destroy();

header("Location: http://127.0.0.1/ButacaBox/ButacaBox/src/pages/index.php");

?>