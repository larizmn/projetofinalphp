<?php
require_once "conexaobanco.class.php";
class TravelDAO{
  private $conexao = null;

  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }

  public function __destruct(){}

  public function cadastrarTravel($trav){
    try {
      $stat = $this->conexao->prepare
      ("insert into pacoteviagem(idPacote,nomePacote,cidade,valor,data,hotel)values(null,?,?,?,?,?)");

      $stat->bindValue(1, $trav->nomePacote);
      $stat->bindValue(2, $trav->cidade);
      $stat->bindValue(3, $trav->valor);
      $stat->bindValue(4, $trav->data);
      $stat->bindValue(5, $trav->hotel);

      $stat->execute();
    } catch (PDOException $e) {
      echo "Erro ao cadastrar Travel";
    }//fecha catch
  }//fecha cadastrar travel

  public function buscarTravel(){
    try {
      $stat = $this->conexao->query("select * from pacoteviagem");
      $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Travel');
      return $array;
    } catch (PDOException $e) {
      echo "Erro ao buscar!";
    }//fecha catch
  }//fecha buscar

  public function deletarTravel($id){
    try {
      $stat = $this->conexao->prepare("delete from pacoteviagem where idPacote = ?");
      $stat->bindValue(1,$id);
      $stat->execute();
    } catch (PDOException $e) {
      echo "Erro ao deletar!" .$e;
    }//Fecha trycatch
  }//fecha deletar

  public function filtrarTravel($query){
    try {
      $stat = $this->conexao->query("select * from pacoteviagem ".$query);
      $array = $stat->fetchAll(PDO::FETCH_CLASS,'travel');
      return $array;
    } catch (PDOException $e) {
      echo "Erro ao filtrar maluco!" .$e;
    }//fecha catch
  }//fecha filtrar

  public function alterarTravel($trav){
    try {
      $stat = $this->conexao->prepare("update pacoteviagem set nomePacote=?, cidade=?, valor=?, data=?, hotel=?");

      $stat->bindValue(1, $trav->nomePacote);
      $stat->bindValue(2, $trav->cidade);
      $stat->bindValue(3, $trav->valor);
      $stat->bindValue(4, $trav->data);
      $stat->bindValue(5, $trav->hotel);
      $stat->execute();
    } catch (PDOException $e) {
      echo "Erro ao alterar o pacote!";
      exit;
    }//fecha catchzin
  }//fecha alterar dessa caralha

}//fecha classe
