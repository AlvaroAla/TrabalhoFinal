<?php
session_start();
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
    <title>Página Principal</title>
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
                        <a class="nav-link active" href="index.php">Página Principal</a>
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
                    <?php
                    if (isset($_SESSION["login"]) && $_SESSION["login"] == "1" && isset($_SESSION["usuario"])) {
                    ?>
                        <li class="nav-item" id="imagemLogin">
                            <img id="fotoPerfil" src="picapauPerfil.png" width="40 " height="40" />
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php" id="iconeLogin">Login</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="container text-center">
            <div class="row">
                <div class="col"> <!--1 de 2-->
                    <article>
                        <h1>O que a plataforma faz?</h1>
                        <p><br>Ajudar os usuários a calcular a quantidade de combustível/energia necessária para percorrer
                            uma determinada distância. Ela fornece informações sobre o consumo de combustível ou energia com
                            base no tipo de veículo terrestre (carro, moto, patinete elétrico, etc.), a distância a ser
                            percorrida e outros fatores como preço do combustível e consumo médio.</p>
                    </article>
                </div>
                <div class="col"> <!--2 de 2-->
                    <article>
                        <h1>Qual a finalidade da plataforma?</h1>
                        <p>Ajudar a promover a conscientização sobre o consumo responsável de energia e combustíveis. Nossa
                            plataforma tem relação com o <a class="link" href="https://brasil.un.org/pt-br/sdgs/7" target="_blank">ODS 7 - “Energia Acessível e Limpa”</a>, alinhando-se com a meta de assegurar
                            o acesso a fontes de energia confiáveis, sustentáveis, modernas e a preços acessíveis.</p>
                    </article>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-12 col-xs-6"> <!--1 de 3-->
                    <ul>
                        <li class="list-group-item" id="dicaGeral">
                            <h6>Acelere o automóvel de forma suave</h6>
                            <p>Acelerar ou frear com muita força desnecessariamente não contribui para uma boa autonomia do seu
                                veículo. Acelere suavemente o seu automóvel. Assim, você irá contribuir para a saúde da
                                bateria/economia do combustível e dirigir de forma mais defensiva, o que também é mais seguro.</p>
                        </li>
                        <br>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12" id="abaixoCalculadora"> <!--2 de 3-->
                    <form id="formCalculadora" action="" method="POST">
                        <h4 id="calculadora">Calculadora</h4>
                        <div class="form-check">
                            <p>O seu veículo utiliza:</p>
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="energiaCalculadora">
                            <label class="form-check-label" for="energiaCalculadora">Energia</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="combustivelCalculadora">
                            <label class="form-check-label" for="combustivelCalculadora">Combustível</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="distanciaCalculadora" placeholder="" name="distancia">
                            <label for="distanciaCalculadora">Distância (em km):</label>
                        </div>
                        <br>
                        <div class="form-floating mb-3" id="consumoCombustivelCalculadora">
                            <input type="number" class="form-control" id="inputConsumoCombustivelCalculadora" placeholder="" step=".01" name="consumocombustivel">
                            <label for="inputConsumoCombustivelCalculadora">Consumo Médio (km/l):</label>
                        </div>
                        <div class="form-floating mb-3" id="consumoEletricidadeCalculadora">
                            <input type="number" class="form-control" id="inputConsumoEletricidadeCalculadora" placeholder="" step=".01" name="consumoenergia">
                            <label for="inputConsumoEletricidadeCalculadora">Consumo de Eletricidade (km/kWh):</label>
                        </div>
                        <button type="submit" class="btn btn-secondary">Calcular</button>
                        <div id="alertas">
                            <div class="alert alert-danger display d-none" role="alert" id="alerta1"></div>
                            <div class="alert alert-danger display d-none" role="alert" id="alerta2"></div>
                            <div class="alert alert-danger display d-none" role="alert" id="alerta3"></div>
                        </div>
                    </form>
                    <?php
                    $distancia = isset($_POST["distancia"]);
                    if ($distancia !== null) {
                        if (isset($_POST["consumocombustivel"])) {
                            $consumo = $_POST["consumocombustivel"];
                            $combustivel = $distancia / $consumo;
                            echo "Você terá que colocar " . $combustivel . " litros de combustível para percorrer a distância desejada.";
                        } elseif (isset($_POST["consumoenergia"])) {
                            $consumo = $_POST["consumoenergia"];
                            $energia = $distancia / $consumo;
                            echo "Você terá que carregar " . $energia . " quilowatt-hora para percorrer a distância desejada.";
                        } else {
                            echo "Por favor, preencha os campos corretamente.";
                        }
                    }
                    ?>
                </div>
                <div class="col-lg-3 col-md-12 col-xs-6"> <!--3 de 3-->
                    <br>
                    <br>
                    <ul>
                        <li class="list-group-item" id="dicaGeral">
                            <h6>Cuidado com o excesso de carga</h6>
                            <p>Mais uma dica que vale para qualquer veículo: tome cuidado com o excesso de carga. Um carro mais
                                leve precisa gastar menos energia/combustível para rodar. Isso significa que carga extra ou
                                desnecessária fará com que a bateria/o combustível do seu carro esgote/acabe mais rapidamente.</p>
                        </li>
                        <br>
                        <br>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <p>Cadastre-se na nossa plataforma para ter uma melhor experiência!</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>