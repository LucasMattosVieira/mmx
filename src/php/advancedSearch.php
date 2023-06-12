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
            Titulo LIKE ? AND
            Descricao LIKE ? AND
            Descricao LIKE ? AND
            Descricao LIKE ? AND
            Descricao LIKE ? AND
            Descricao LIKE ? AND
            CodCategoria = (CASE WHEN ? > 0 THEN ? ELSE CodCategoria END) AND
            Preco BETWEEN ? AND (CASE WHEN ? != -1 THEN ? ELSE (SELECT MAX(Preco) FROM Anuncio) END)
        GROUP BY Codigo
        LIMIT 6 OFFSET ?
        SQL;

    $title = $_GET["title"];
    $offset = $_GET["offset"] * 6;
    $description = $_GET["description"];
    $categoryCode = $_GET["category"] ?? 0;
    $minPrice = !empty($_GET["min_price"]) ? $_GET["min_price"] : 0;
    $maxPrice = !empty($_GET["max_price"]) ? $_GET["max_price"] : -1;

    $title = explode(" ", $title);
    $description = explode(" ", $description);

    $statements = [];

    $lengthTitle = count($title);
    $lengthDescr = count($description);

    for ($i = 0; $i < 5; $i++) { //pega as 5 primeiras palavras (trata input com menos de 5)
        if ($i < $lengthTitle) {
            $titleAux = "%" . $title[$i] . "%";
            array_push($statements, $titleAux);
        } else {
            array_push($statements, "%%");
        }
    }

    for ($i = 0; $i < 5; $i++) { //pega as 5 primeiras palavras (trata input com menos de 5)
        if ($i < $lengthDescr) {
            $descrAux = "%" . $description[$i] . "%";
            array_push($statements, $descrAux);
        } else {
            array_push($statements, "%%");
        }
    }

    array_push($statements, $categoryCode); // 2 vezes por causa do WHEN na query
    array_push($statements, $categoryCode);

    array_push($statements, $minPrice);

    array_push($statements, $maxPrice); // 2 vezes por causa do WHEN na query
    array_push($statements, $maxPrice);

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