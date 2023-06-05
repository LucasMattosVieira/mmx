<?php
    require_once "conexaoMySQL.php";

    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    if(trim($nome) == "") {}

    if(trim($password) == "") {}

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
?>