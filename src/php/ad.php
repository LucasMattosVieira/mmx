<?php
    require_once "mySQLConnect.php";

    session_start();

    $pdo = mySQLConnect();
    
    $userID = $_SESSION["userID"];

    $targetDir = "../images/";
    $targetFile = $targetDir . basename($_FILES["imagem"]["name"]);

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["imagem"]["tmp_name"]);
        if($check === false) {
            throw new Exception("Arquivo não é uma imagem");
        }
    }

    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $targetFile)) {
        echo "Sucesso.";
    } 
    else {
        throw new Exception("Upload falhou.");
    }

    $cep = $_POST['cep'] ?? '';
    $bairro = $_POST['bairro'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $estado = $_POST['estado'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $titulo = $_POST['titulo'] ?? '';
    $preco = $_POST['preco'] ?? '';
    $imagem = basename($_FILES["imagem"]["name"]);
 
    $sql1 = <<<SQL
        INSERT INTO Anuncio (Titulo, Descricao, Preco, CEP, Bairro, Cidade,
                            Estado, CodCategoria, CodAnunciante)
        VALUES (?,?,?,?,?,?,?,?,?)
        SQL;

    $sql2 = <<<SQL
        INSERT INTO Foto (CodAnuncio, NomeArqFoto)
        VALUES (?,?)
        SQL;

    $stmt = $pdo->prepare($sql1);
    $stmt->execute([$titulo,$descricao,$preco,$cep,$bairro,$cidade,
                    $estado,$categoria,$userID]);

    $adID = $pdo->lastInsertId();

    $stmt = $pdo->prepare($sql2);
    $stmt->execute([$adID,$imagem]);

    # adiciona o cep se nao estiver salvo
    $sql3 = <<<SQL
        SELECT *
        FROM EnderecosAJAX
        WHERE CEP = ?
        SQL;

    $sql4 = <<<SQL
        INSERT INTO EnderecosAJAX
        VALUES (?,?,?,?)
        SQL;

    $stmt = $pdo->prepare($sql3);
    $stmt->execute([$cep]);

    if ($stmt->rowCount() == 0) {
        $stmt = $pdo->prepare($sql4);
        $stmt->execute([$cep,$bairro,$cidade,$estado]);
    }

    header("Location: createAd.php");
    exit();

?>