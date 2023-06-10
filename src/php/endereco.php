<?php


class Endereco
{
  public $estado;
  public $bairro;
  public $cidade;

  function __construct($bairro, $cidade,$estado)
  {
    $this->estado = $estado;
    $this->bairro = $bairro;
    $this->cidade = $cidade;
  }
}


if ($cep == '38400-100')
    $endereco = new Endereco('MG', 'Centro', 'Uberlândia');
  else if ($cep == '38400-200')
    $endereco = new Endereco('MG', 'Fundinho', 'Uberlândia');
  else
    $endereco = new Endereco('', '', '');

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($endereco);
    

?>