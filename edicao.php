<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    //Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit();
}

if (isset($_POST["consumoeletricidade"]) || isset($_POST["consumomedio"])) {
    require_once "conexao.php";
    require_once "usuario.php";

    try {
        $conn = new Conexao();

        $email = $_SESSION['email'];

        $sql = "SELECT cpf FROM usuarios WHERE email = ?";
        $stmt = $conn->conexao->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();

        //Obtendo o resultado da consulta
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            $idUsuario = $resultado['cpf']; //idUsuario = cpf na tabela usuarios e cpfdono na tabela itens

            $sql = "SELECT * FROM itens WHERE cpfdono = ?";
            $stmt = $conn->conexao->prepare($sql);
            $stmt->bindParam(1, $idUsuario);
            $stmt->execute();

            //consulta para recuperar o id do item

            $consumoEletricidade = $_POST["consumoeletricidade"] ?? null;
            $consumoMedio = $_POST["consumomedio"] ?? null;

            if ($consumoEletricidade || $consumoMedio) {
                $sql = "UPDATE itens SET consumomedio = ? AND consumoeletricidade = ?  WHERE iditem = ?";

                $stmt = $conn->conexao->prepare($sql);

                $tipoConsumoEnergia = ($consumoEletricidade) ? "energiaPerfil" : null;
                $tipoConsumoCombustivel = ($consumoMedio) ? "combustivelPerfil" : null;

                $stmt->bindParam(1, $consumoMedio);
                $stmt->bindParam(2, $consumoEletricidade);
                $stmt->bindParam(3, $idItem);

                if ($stmt->execute()) {
                    echo "Item editado com sucesso!";
                    //Redirecionamento para a lista de itens
                    header("Location: listaVeiculos.php");
                    exit();
                } else {
                    $errorInfo = $stmt->errorInfo();
                    echo "Erro ao editar item. Por favor, tente novamente. Error: " . $errorInfo[2];
                }
            } else {
                echo "Parâmetros inválidos para edição de item.";
            }
        } else {
            echo "Usuário não encontrado ou problema ao obter o ID do usuário.";
        }
    } catch (\PDOException $e) {
        echo "Falha na conexão com o banco de dados: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="TF2.css">
    <script type="text/javascript" src="code.jquery.com_jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="TF2.js"></script>
    <script type="text/javascript" src="bootstrap.bundle.js"></script>
    <script src="cdnjs.cloudflare.com_ajax_libs_moment.js_2.15.1_moment.min.js"></script>
    <script src="cdnjs.cloudflare.com_ajax_libs_bootstrap-datetimepicker_4.7.14_js_bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="cdnjs.cloudflare.com_ajax_libs_bootstrap-datetimepicker_4.7.14_css_bootstrap-datetimepicker.min.css">
    <title>Editar</title>
</head>

<body>
    <header class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-custom">
            <a class="navbar-brand" href="index.php">DCS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Página Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastroUsuario.php">Cadastre-se</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="listaVeiculos.php">Itens Cadastrados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sobre.php">Sobre</a>
                    </li>
                    <li class="nav-item" id="imagemLogin">
                        <img id="fotoPerfil" src="picapauPerfil.png" width="40 " height="40" />
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="container text-center">
            <div class="row">
                <div class="col-3"> <!--1 de 3-->
                </div>
                <div class="col-lg-6 col-md-6 col-xs-8"> <!--2 de 3-->
                    <form id="formEditarVeiculo">
                        <h4>Editar veículo:</h4>
                        <div class="form-check">
                            <p>Meu veículo utiliza:</p>
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="energiaEdicao">
                            <label class="form-check-label" for="energiaEdicao">Energia</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="combustivelEdicao">
                            <label class="form-check-label" for="combustivelEdicao">Combustível</label>
                        </div>
                        <div class="form-floating" id="tipoCombustivelEdicaoDiv">
                            <select class="form-select" name=>
                                <option selected>Selecione um COMBUSTÍVEL SUSTENTÁVEL</option>
                                <option value="1">Biocombustível</option>
                                <option value="2">Etanol</option>
                                <option value="3">GNV (Gás Natural Veicular)</option>
                            </select>
                            <label for="floatingSelect" id="labelSelect">Tipo de Combustível:</label>
                        </div>
                        <br>
                        <div class="form-floating mb-3" id="consumoCombustivelEdicao">
                            <input type="number" class="form-control" id="inputConsumoCombustivelEdicao" placeholder="" step=".01">
                            <label for="inputConsumoCombustivelEdicao">Consumo Médio (km/l):</label>
                        </div>
                        <div class="form-floating mb-3" id="consumoEletricidadeEdicao">
                            <input type="number" class="form-control" id="inputConsumoEletricidadeEdicao" placeholder="" step=".01">
                            <label for="inputConsumoEletricidadeEdicao">Consumo de Eletricidade (km/kWh):</label>
                        </div>
                        <button type="submit" class="btn btn-secondary">Editar</button>
                        <div id="alertas">
                            <div class="alert alert-danger display d-none" role="alert" id="alerta1"></div>
                            <div class="alert alert-danger display d-none" role="alert" id="alerta2"></div>
                            <div class="alert alert-danger display d-none" role="alert" id="alerta3"></div>
                        </div>
                    </form>
                </div>
                <div class="col-3"> <!--3 de 3-->
                </div>
            </div>
        </div>
    </main>
    <footer id="footerEdicao">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <p>Conte-nos como está sendo sua experiência: <a class="link" href="sobre.php">entre em contato</a>.</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>