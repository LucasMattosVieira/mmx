<?php
    require_once "mySQLConnect.php";

    session_start();

    $pdo = mySQLConnect();

    $userID = $_SESSION["userID"];

    $contato = $_POST["contato"];
    $mensagem = $_POST["mensagem"];

    $sql = <<<SQL
        INSERT INTO Interesse (Contato, Mensagem, CodAnuncio)
        VALUES (?, ?, ?)
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$contato, $mensagem, $userID]);

    echo "Mensagem enviada com sucesso!";
?>