<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Cadastro de Viagem</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <h1 class="jumbotron bg-info">Cadastro de viagem!</h1>

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
            <a class="nav-link" href="cadastro-travel.php">Cadastro de Viagem<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="consulta-travel.php">Consulta de Viagem</a>
          </li>
        </ul>
      </div>
    </nav>

    <form name="cadTravel" method="post" action="">
      <div class="form-group">
        <input type="text" name="txtnome" placeholder="Nome do pacote" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" name="txtcidade" placeholder="Cidade" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" name="numvalor" placeholder="Valor" class="form-control">
      </div>
      <div class="form-group">
        <input type="date" name="date" placeholder="Data" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" name="txthotel" placeholder="Nome do hotel" class="form-control">
      </div>
      <div class="form-group">
        <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">
        <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
      </div>
    </form>

    <?php
    if(isset($_POST['cadastrar'])){
    include_once "modelo/travel.class.php";
    include_once "dao/traveldao.class.php";
    include_once "util/padronizacao.class.php";
    include_once "util/validacao.class.php";
    include_once "util/helper.class.php";

    $qtdErros=0;
    if(!validacao::validarNome($_POST['txtnome'])){
      $qtdErros++;
      Helper::alert("Nome do pacote inválido!");
    }//fecha if de validação

    $trav = new Travel();

    if($qtdErros==0){
    $trav->nomePacote = padronizacao::padronizarMaiMin($_POST['txtnome']);
    $trav->cidade = padronizacao::padronizarMaiMin($_POST['txtcidade']);
    $trav->valor = $_POST['numvalor'];
    $trav->data = $_POST['date'];
    $trav->hotel = padronizacao::padronizarMaiMin($_POST['txthotel']);

    //echo $trav; teste

    $travelDAO = new TravelDAO();
    $travelDAO->cadastrarTravel($trav);

    Helper::alert("Viagem cadastrada com sucesso");
    unset($_POST);
  }//fecha if qtd erros
  }//fecha if cadastrar
    ?>

  </div>
</body>
</html>
