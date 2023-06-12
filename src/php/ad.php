<?php
    require_once "mySQLConnect.php";

    session_start();

    $pdo = mySQLConnect();
    
    $userID = $_SESSION["userID"];

    $cep = $_POST['cep'] ?? '';
    $bairro = $_POST['bairro'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $estado = $_POST['estado'] ?? '';
    $categoria = $_POST['category'] ?? '';
    $descricao = $_POST['descr'] ?? '';
    $titulo = $_POST['title'] ?? '';
    $preco = $_POST['price'] ?? '';
 
    $categoria = (int)$categoria;

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

    $targetDir = "../images/";
    $images = [];
    $uploaded = $_FILES["image"];

    if(isset($_POST["title"])) {  
        
        // $count = count($uploaded["name"]);

        // for($i = 0; $i < $count; $i++){

        //     $imageName = $uploaded["name"][$i];

        //     $targetFile = $targetDir . $imageName;

        //     move_uploaded_file($uploaded["tmp_name"][$i], $targetFile);

        //     array_push($images, $imageName);
        // }

        foreach($uploaded["name"] as $index=>$file){

            $path = $uploaded["name"][$index];
            $aux = explode(".",$path);
            $imageName = "picture_" . $adID . "_" . $index . "." . end($aux);

            $targetFile = $targetDir . $imageName;

            $check = getimagesize($uploaded["tmp_name"][$index]);

            if($check === false) {
                throw new Exception("Arquivo não é uma imagem");
            }

            if (!move_uploaded_file($uploaded["tmp_name"][$index], $targetFile)) {
                throw new Exception("Upload falhou.");
            }

            $images[] = $imageName;
        }


    }

    $stmt = $pdo->prepare($sql2);

    foreach($images as $image){
        $stmt->execute([$adID,$image]);
    }



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

    header("Location: ../pages/myAds.php");
    exit();

?>