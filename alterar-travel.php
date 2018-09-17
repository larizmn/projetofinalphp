<?php
// error_reporting (6143);
if(isset($_GET['id'])){
  include_once "modelo/travel.class.php";
  include_once "dao/traveldao.class.php";
  $travelDAO = new TravelDAO();
  $query = "where idPacote = ".$_GET['id'];
  $travel = $travelDAO->filtrarTravel($query);
  $travel = $travel[0];
  /*var_dump($travel);
  echo $travel;*/
}else{
  /*header("location:index.php");*/
}


if(isset($_POST['alterar'])){
  include_once "modelo/travel.class.php";
  include_once "dao/traveldao.class.php";
  include_once "util/padronizacao.class.php";
  include_once "util/helper.class.php";
  include_once "util/validacao.class.php";

  $qtdErros=0;
  if(!Validacao::validarNome($_POST['txtnomePacote'])){
    $qtdErros++;
    Helper::alert("Nome do pacote invalido!");
  }

  if($qtdErros < 1){
    $travel = new Travel();
    $travel->idPacote = $travel->idPacote;
    $travel->nomePacote = padronizacao::padronizarMaiMin($_POST['txtnomePacote']);
    $travel->cidade = padronizacao::padronizarMaiMin($_POST['txtcidade']);
    $travel->valor = $_POST['numvalor'];
    $travel->data = $_POST['data'];
    $travel->hotel = padronizacao::padronizarMaiMin($_POST['txthotel']);
    //echo $travel;
    // var_dump($travel);
    $travelDAO = new TravelDAO();
    $travelDAO->alterarTravel($travel);
    Helper::alert("Pacote alterado com sucesso!");
    unset($_POST);
  }
}
 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Alterar pacote</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <h1 class="jumbotron bg-info">Página de alteração</h1>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro-travel.php">Cadastro de Viagem</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="consulta-travel.php">Consulta de Viagem<span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>

    <form name="cadTravel" method="post" action="">
      <div class="form-group">
        <input type="text" name="txtnomePacote" placeholder="Nome pacote" class="form-control" value="<?php echo $travel->nomePacote; ?>">
      </div>
      <div class="form-group">
        <input type="text" name="txtcidade" placeholder="Cidade" class="form-control" value="<?php echo $travel->cidade; ?>">
      </div>
      <div class="form-group">
        <input type="text" name="numvalor" placeholder="Valor" class="form-control" value="<?php echo $travel->valor; ?>">
      </div>
      <div class="form-group">
        <input type="date" name="data" placeholder="Data" class="form-control" value="<?php echo $travel->data; ?>">
      </div>
      <div class="form-group">
        <input type="text" name="txthotel" placeholder="Nome do hotel" class="form-control" value="<?php echo $travel->hotel; ?>">
      </div>
      <div class="form-group">
        <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
        <input type="reset" name="limpar" value="Limpar" class="btn btn-danger">
      </div>
    </form>

</body>
</html>
