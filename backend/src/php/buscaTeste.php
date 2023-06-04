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
        WHERE CodAnuncio = Codigo
        LIMIT 6
        SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $result_array = [];

    while ($row = $stmt->fetch()) {
        $result = new Result($row['Codigo'], $row['Titulo'], $row['Descricao'], $row['Preco'], $row['NomeArqFoto']);
        array_push($result_array, $result);
    }

    header('Content-type: application/json');  
    echo json_encode($result_array);
?>