<?php
    require_once "conexaoMySQL.php";

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
            Titulo LIKE ?
        LIMIT 6 OFFSET ?
        SQL;
    
    $title = $_GET["title"];
    $offset = $_GET["offset"] * 6;

    $title = explode(" ", $title);

    $title1 = "%%";
    $title2 = "%%";
    $title3 = "%%";

    $len = count($title);

    if ($len > 0) {
        $title1 = "%" . $title[0] . "%";
        if ($len > 1) {
            $title2 = "%" . $title[1] . "%";
            if ($len > 2) {
                $title3 = "%" . $title[2] . "%";
            }
        }
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title1, $title2, $title3, $offset]);

    $result_array = [];

    while ($row = $stmt->fetch()) {
        $result = new Result($row['Codigo'], $row['Titulo'], $row['Descricao'], $row['Preco'], $row['NomeArqFoto']);
        array_push($result_array, $result);
    }

    header('Content-type: application/json');  
    echo json_encode($result_array);
?>