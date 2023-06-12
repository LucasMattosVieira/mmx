<?php
  require_once "../php/mySQLConnect.php";

  $pdo = mysqlConnect();

  class Endereco
  {
    public $estado;
    public $bairro;
    public $cidade;

    function __construct($bairro, $cidade,$estado)
    {
      $this->bairro = $bairro;
      $this->cidade = $cidade;
      $this->estado = $estado;
    }
  }

  $cep = $_GET["cep"] ?? '';

  $sql = <<<SQL
    SELECT Bairro, Cidade, Estado
    FROM EnderecosAJAX
    WHERE CEP = ?
    SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$cep]);

  if($row = $stmt->fetch()) {
    $endereco = new Endereco($row["Bairro"],$row["Cidade"],$row["Estado"]);
  } else {
    $endereco = new Endereco('', '', '');
  }

  header('Content-Type: application/json');
  echo json_encode($endereco);
?>