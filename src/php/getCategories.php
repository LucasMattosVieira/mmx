<?php
    require_once "mySQLConnect.php";

    $pdo = mysqlConnect();

    $sql = <<<SQL
        SELECT Codigo, Nome
        FROM Categoria
        SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $categories = [];

    while ($row = $stmt->fetch()) {
        $result = array(
                    'code' => $row['Codigo'],
                    'name' => $row['Nome']
                    );

        array_push($categories, $result);
    }


    header('Content-type: application/json');  
    echo json_encode($categories);
?>