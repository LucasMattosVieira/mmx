<?php
    require_once "mySQLConnect.php";

    session_start();

    $pdo = mySQLConnect();

    $contato = $_POST["contato"];
    $mensagem = $_POST["mensagem"];
    $adId = $_POST["adId"];

    $sql = <<<SQL
        INSERT INTO Interesse (Contato, Mensagem, CodAnuncio)
        VALUES (?, ?, ?)
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$contato, $mensagem, $adId]);

    header("Location: ../pages/ad.php?id=${adId}&messageSent=true");
    exit();
?>