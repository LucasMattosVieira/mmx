<?php
    require_once "mySQLConnect.php";
    $pdo = mySQLConnect();
 
   
     //$adId = $_GET["id"]; perguntar depois
     $cep = $_POST['cep'] ?? '';
     $bairro = $_POST['bairro'] ?? '';
     $cidade = $_POST['cidade'] ?? '';
     $estado = $_POST['estado'] ?? '';
     $categoria = $_POST['categoria'] ?? '';
     $descricao = $_POST['descricao'] ?? '';
     $titulo = $_POST['titulo'] ?? '';
     $preco = $_POST['preco'] ?? '';
 
 
 
 $sql = <<<SQL
 
 INSERT INTO Anuncio (Titulo, Descricao,Preco,CEP,Bairro,Cidade,Estado)
 VALUES ('$titulo', '$descricao','$preco','$cep','$bairro','$cidade','$estado')   
 
 
 SQL;
 $pdo->exec($sql);
?>