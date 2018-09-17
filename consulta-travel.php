<?php
require_once "dao/traveldao.class.php";
require_once "modelo/travel.class.php";
require_once "util/helper.class.php";

$travelDAO = new TravelDAO();
$travel = $travelDAO->buscarTravel();
//var_dump($travel);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Consulta de viagens</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <h1 class="jumbotron bg-info">Consulta de viagens!</h1>

    <nav class="navbar navbar-expand-lg navbar-light bg-light center">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro-travel.php">Cadastro de Viagens</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="consulta-travel.php">Consulta de viagens<span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>

    <h2>Busca personalizada:</h2>

    <form name="filtroviagens" method="post" action="">
      <div class="row">
        <div class="form-group col-md-6">
          <input type="text" name="txtfiltro" placeholder="Digite o que deseja pesquisar" class="form-control">
        </div>
        <div class="form-group col-md-6">
          <select class="form-control mx-auto" name="selfiltro">
            <option value="selecione">Selecione</option>
            <option value="codigo">Código</option>
            <option value="titulo">Título</option>
            <option value="local">Local</option>
            <option value="preco">Preço</option>
            <option value="partida">Partida</option>
            <option value="acomodacao">Acomodação</option>
          </select>
        </div>
      </div>
    <div class="form-group col-md-6">
      <input type="submit" name="pesquisar" value="pesquisar" class="btn btn-secondary mx-auto" style="width: 200px;">
    </div>
    </form>

    <?php
    if(isset($_SESSION['msg'])){
      helper::h2($_SESSION['msg']);
      unset($_SESSION['msg']);
    }

    //filtro

    if(isset($_POST['pesquisar'])){
      $filtro = $_POST['selfiltro'];
      $pesquisar = $_POST['txtfiltro'];

      $qtdErros=0;
      if($filtro == "selecione" || $pesquisar == ""){
        $travel = $travelDAO->buscarTravel();
        $qtdErros++;
      }//fecha o role do filtro irmao

    if($qtdErros == 0){
      $query = "";
      if($filtro == 'codigo'){
        $query = "where idPacote =" .$pesquisar;
      }else if($filtro == 'titulo'){
        $query = "where nomePacote ='".$pesquisar."'";
      }else if($filtro == 'local'){
        $query = "where cidade ='".$pesquisar."'";
      }else if($filtro == 'preco'){
        $query = "where valor ='".$pesquisar;
      }else if($filtro == 'partida'){
        $query = "where data ='".$pesquisar;
      }else if($filtro == 'acomodacao'){
        $query = "where hotel ='".$pesquisar."'";
      }//fecha else if
      //var_dump($query);
      $travel = $travelDAO->filtrarTravel($query);
    }//fecha if $qtdErros
  }//pesquisar

  if(count($travel) == 0){
    Helper::alert("Sem dados!");
    echo "<h2>WITHOUT DATES!</h2>";
    die();
  }
    ?>

    <h2>Nossos pacotes:</h2>

    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
          <th>Código</th>
          <th>Nome</th>
          <th>Cidade</th>
          <th>Valor</th>
          <th>Data</th>
          <th>Hotel</th>
          <th>Alterar</th>
          <th>Excluir</th>
        </thead>
        <tfoot>
          <th>Código</th>
          <th>Nome</th>
          <th>Cidade</th>
          <th>Valor</th>
          <th>Data</th>
          <th>Hotel</th>
          <th>Alterar</th>
          <th>Excluir</th>
        </tfoot>
        <tbody>
          <?php
        foreach ($travel as $t){
          echo "<tr>";
            echo "<td>".$t->idPacote."</td>";
            echo "<td>".$t->nomePacote."</td>";
            echo "<td>".$t->cidade."</td>";
            echo "<td>".$t->valor."</td>";
            echo "<td>".$t->data."</td>";
            echo "<td>".$t->hotel."</td>";
          echo "<td><a href='alterar-travel.php?id=$t->idPacote'><button type='button' class='btn btn-info'><span class='glyphicon glyphicon-remove'></span> Alterar</button></a></td>";
          echo "<td><a href='consulta-travel.php?id=$t->idPacote'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span> Excluir</button></a></td>";
          echo "</tr>";
        }
           ?>
        </tbody>
      </table>
    </div>
 </div>
</div>
<?php
if(isset($_GET['id'])){
    $travelDAO->deletarTravel($_GET['id']);
    $_SESSION['msg']="Pacote excluido com sucesso!";
    //header("location:consulta-travel.php");
    unset($_GET['id']);
  }
 ?>
</body>
</html>
