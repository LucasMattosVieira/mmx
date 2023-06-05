<?php
    require_once "conexaoMySQL.php";
    
	$pdo = mysqlConnect();  

    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    if(trim($nome) == "") {
        throw new Exception("E-mail não preenchido.");
    }

    if(trim($password) == "") {
        throw new Exception("Senha não preenchida.")
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = <<<SQL
		SELECT SenhaHash 
        FROM Anunciante
        WHERE Email = ?
    SQL;
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    
    $result = $stmt->fetch();
    
    header("Content-type: application/json");
    
    if(result[0]["SenhaHash"] == $password) {
        $_SESSION["email"] = $email;
        
    } else {
        
    }
?>
























