<?php
    require_once "mySQLConnect.php";

    $pdo = mysqlConnect();

    
    class Result {
        public $code;
        public $titleResult;
        public $descr;
        public $price;
        public $picture;
        
        function __construct($code, $titleResult, $descr, $price, $picture) {
            $this->code = $code;
            $this->titleResult = $titleResult;
            $this->descr = $descr;
            $this->price = $price;
            $this->picture = $picture;
        }
    }

    $sql = <<<SQL
        SELECT Codigo, Titulo, Descricao, Preco, NomeArqFoto
        FROM Anuncio, Foto
        WHERE CodAnuncio = Codigo AND
            Titulo LIKE ? AND
            Titulo LIKE ? AND
            Titulo LIKE ? AND
            Titulo LIKE ? AND
            Titulo LIKE ?
        GROUP BY Codigo
        LIMIT 6 OFFSET ?
        SQL;
    
    $title = $_GET["title"];
    $offset = $_GET["offset"] * 6;

    $title = explode(" ", $title);

    $statements = [];

    $length = count($title);

    for ($i = 0; $i < 5; $i++) { //pega as 5 primeiras palavras (trata input com menos de 5)
        if ($i < $length) {
            $titleAux = "%" . $title[$i] . "%";
            array_push($statements, $titleAux);
        } else {
            array_push($statements, "%%");
        }
    }

    array_push($statements, $offset);

    $stmt = $pdo->prepare($sql);
    $stmt->execute($statements);

    $result_array = [];

    while ($row = $stmt->fetch()) {
        $result = new Result($row['Codigo'], 
                            htmlspecialchars($row['Titulo']), 
                            htmlspecialchars($row['Descricao']), 
                            $row['Preco'], 
                            htmlspecialchars($row['NomeArqFoto']));

        array_push($result_array, $result);
    }

    header('Content-type: application/json');  
    echo json_encode($result_array);
?>