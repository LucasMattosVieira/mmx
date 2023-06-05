<?php
    require_once "mySQLConnect.php";

    $pdo = mysqlConnect();

    
    class Result {
        public $code;
        public $title_r;
        public $descr;
        public $price;
        public $picture;
        
        function __construct($code, $title_r, $descr, $price, $picture) {
            $this->code = $code;
            $this->title_r = $title_r;
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
        LIMIT 6 OFFSET ?
        SQL;
    
    $title = $_GET["title"];
    $offset = $_GET["offset"] * 6;

    $title = explode(" ", $title);

    $statements = [];

    $len = count($title);

    for ($i = 0; $i < 5; $i++) { //pega as 5 primeiras palavras (trata input com menos de 5)
        if ($i < $len) {
            $title = "%" . $title[$i] . "%";
            array_push($statements, $title);
        } else {
            array_push($statements, "%%");
        }
    }

    array_push($statements, $offset);

    $stmt = $pdo->prepare($sql);
    $stmt->execute($statements);

    $result_array = [];

    while ($row = $stmt->fetch()) {
        $result = new Result($row['Codigo'], $row['Titulo'], $row['Descricao'], $row['Preco'], $row['NomeArqFoto']);
        array_push($result_array, $result);
    }

    header('Content-type: application/json');  
    echo json_encode($result_array);
?>