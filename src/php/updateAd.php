<?php
    require_once "../php/mySQLConnect.php";

    $pdo = mysqlConnect();

    $adID = $_POST["adID"] ?? "";
    $title = $_POST["title"] ?? "";
    $descr = $_POST["descr"] ?? "";
    $category = $_POST["category"] ?? "";
    $price = $_POST["price"] ?? "";
    $cep = $_POST["cep"] ?? "";
    $bairro = $_POST["bairro"] ?? "";
    $cidade = $_POST["cidade"] ?? "";
    $estado = $_POST["estado"] ?? "";

    if(isset($_POST["title"])) {
        if(!empty($_FILES["image"]["name"][0])) {

            $sqlF1 = <<<SQL
                DELETE FROM Foto
                WHERE CodAnuncio = ?
                SQL;

            $stmt = $pdo->prepare($sqlF1);
            $stmt->execute([$adID]);

            $targetDir = "../images/";

            $images = scandir($targetDir);

            foreach($images as $image) {
                if(strpos($image,"picture_$adID") !== false) {
                    unlink($targetDir . $image);
                }
            }

            $images = [];
            $uploaded = $_FILES["image"];

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

            $sqlF2 = <<<SQL
                INSERT INTO Foto (CodAnuncio, NomeArqFoto)
                VALUES (?,?) 
                SQL;

            $stmt = $pdo->prepare($sqlF2);

            foreach($images as $image){
                $stmt->execute([$adID,$image]);
            }
        }
    }

    $sql = <<<SQL
        UPDATE Anuncio
        SET Titulo = ?, Descricao = ?, Preco = ?, CEP = ?, Bairro = ?, 
            Cidade = ?, Estado = ?, CodCategoria = ?
        WHERE Codigo = ?
        SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title,$descr,$price,$cep,$bairro,$cidade,$estado,$category,$adID]);

    header("Location: ../pages/ad.php?id=$adID");
    exit();
?>