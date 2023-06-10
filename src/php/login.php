<?php

    require_once "mySQLConnect.php";

    $pdo = mysqlConnect();  

    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    if(trim($email) == "") {
        throw new Exception("E-mail não preenchido.");
    }

    if(trim($password) == "") {
        throw new Exception("Senha não preenchida.");
    }

    $sql = <<<SQL
        SELECT SenhaHash, Codigo
        FROM Anunciante
        WHERE Email = ?
        SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    
    $result = $stmt->fetch();
    
    if(password_verify($password, $result["SenhaHash"])) {
        session_start();
        $_SESSION["userID"] = $result["Codigo"];

        header("Location: home.php");
        exit();
        
    } else {
        throw new Exception("Senha incorreta.");
    }
?>