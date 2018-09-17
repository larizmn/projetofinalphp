<?php
class Travel{
  private $idPacote;
  private $nomePacote;
  private $cidade;
  private $valor;
  private $data;
  private $hotel;

  public function __construct(){}
  public function __destruct(){}

  public function __get($a){return $this->$a;}
  public function __set($a,$v){$this->$a = $v;}

  public function __toString(){
    return nl2br("Código: $this->idPacote
                  Nome: $this->nomePacote
                  Cidade: $this->cidade
                  Valor R$: $this->valor
                  Data: $this->data
                  Hote: $this->hotel");
  }

}//fecha classe
