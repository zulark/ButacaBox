<?php

if (!isset($_SESSION)) {
    session_start();
}

$accepted_roles = [1, 2];
if (!isset($_SESSION['id_funcionario'])) {
    die("Você não pode acessar esta página porque não está logado.<p><a href=\"http://127.0.0.1/ButacaBox/ButacaBox/src/pages/login-funcionario/login.php\">Entrar</a></p>");
}
if (!isset($_SESSION['setor_id']) || !in_array($_SESSION['setor_id'], $accepted_roles)) {
    die("Sua conta não tem autorização para entrar no sistema.<p><a href=\"http://127.0.0.1/ButacaBox/ButacaBox/src/pages/login-funcionario/login.php\">Entrar</a></p>");
}
?>