<?php
    require_once "mySQLConnect.php";

    $pdo = mysqlConnect();
    
    $name = $_POST["name"] ?? "";
    $cpf = $_POST["cpf"] ?? "";
    $tel = $_POST["tel"] ?? "";
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    if(trim($name) == "") {
        throw new Exception("Nome não preenchido.");
    }
    if(trim($cpf) == "") {
        throw new Exception("CPF não preenchido.");
    }
    if(trim($tel) == "") {
        throw new Exception("Telefone não preenchido.");
    }
    if(trim($email) == "") {
        throw new Exception("E-mail não preenchido.");
    }
    if(trim($password) == "") {
        throw new Exception("Senha não preenchida.");
    }

    $sql1 = <<<SQL
        SELECT *
        FROM Anunciante
        WHERE Email = ?
        SQL;

    $sql2 = <<<SQL
        INSERT INTO Anunciante(Nome,CPF,Email,SenhaHash,Telefone)
        VALUES(?,?,?,?,?)
        SQL;

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare($sql1);
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        throw new Exception("E-mail já cadastrado.");
    }

    $stmt = $pdo->prepare($sql2);
    $stmt->execute([$name, $cpf, $email, $passwordHash, $tel]);

    $userID = $pdo->lastInsertId();

    session_start();
    $_SESSION["userID"] = $userID;

    header("Location: home.php");
    exit();
?>