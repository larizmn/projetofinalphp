<?php
class Validacao{

  public static function validarNome($v){
    $exp = "/^[a-zA-Z ]{2,100}$/";
    return preg_match($exp,$v);
  }

}
