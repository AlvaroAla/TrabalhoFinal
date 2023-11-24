<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    //Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit();
}

if (isset($_POST["modelo"]) && (isset($_POST["consumoeletricidade"]) || isset($_POST["consumomedio"]))) {
    require_once "conexao.php";
    require_once "usuario.php";
    require_once "item.php";
    /*require_once "itemenergia.php";
    require_once "itemcombustivel.php";*/

    try {
        $conn = new Conexao();

        if (isset($_SESSION["email"])) {
            $email = $_SESSION["email"];

            $sql = "SELECT cpf FROM usuarios WHERE email = ?";
            $stmt = $conn->conexao->prepare($sql);
            $stmt->bindParam(1, $email);
            $stmt->execute();

            //Obtendo o resultado da consulta
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                $idUsuario = $resultado['cpf']; //idUsuario = cpf na tabela usuarios e cpfdono na tabela itens

                $modelo = $_POST["modelo"] ?? null;
                $consumoEletricidade = $_POST["consumoeletricidade"] ?? null;
                $consumoMedio = $_POST["consumomedio"] ?? null;

                if ($modelo && ($consumoEletricidade || $consumoMedio)) {
                    $sql = "INSERT INTO itens (modelo, consumomedio, consumoeletricidade, cpfdono, tipoconsumoenergia, tipoconsumocombustivel) 
                                VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->conexao->prepare($sql);

                    $tipoConsumoEnergia = ($consumoEletricidade) ? "energiaPerfil" : null;
                    $tipoConsumoCombustivel = ($consumoMedio) ? "combustivelPerfil" : null;

                    $stmt->bindParam(1, $modelo);
                    $stmt->bindParam(2, $consumoMedio);
                    $stmt->bindParam(3, $consumoEletricidade);
                    $stmt->bindParam(4, $idUsuario);
                    $stmt->bindParam(5, $tipoConsumoEnergia);
                    $stmt->bindParam(6, $tipoConsumoCombustivel);

                    if ($stmt->execute()) {
                        $item = new Item();
                            echo "Item cadastrado com sucesso!";
                            //Redirecionamento para o perfil
                            header("Location: perfil.php");
                            exit();
                        /*if($consumoMedio == null){
                            $itemcombustivel = new ItemCombustivel();
                            echo "Item cadastrado com sucesso!";
                            //Redirecionamento para o perfil
                            header("Location: perfil.php");
                            exit();
                        }else{
                            $itemcombustivel = new ItemCombustivel();
                            echo "Item cadastrado com sucesso!";
                            //Redirecionamento para o perfil
                            header("Location: perfil.php");
                            exit();
                        }*/
                    } else {
                        $errorInfo = $stmt->errorInfo();
                        echo "Erro ao cadastrar item. Por favor, tente novamente. Error: " . $errorInfo[2];
                    }
                } else {
                    echo "Parâmetros inválidos para inserção de item.";
                }
            } else {
                echo "Usuário não encontrado ou problema ao obter o ID do usuário.";
            }
        } else {
            // Se 'email' não estiver definido na sessão
            echo "Variável de sessão 'email' não está definida.";
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
    <title>Perfil</title>
</head>

<body>
    <header class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-custom">
            <a class="navbar-brand" href="index.php>DCS</a>
                <button class=" navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" href="perfil.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">Perfil</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#editarPerfil">Editar Perfil</a></li>
                                <li><a class="dropdown-item" href="#cadastraVeiculo">Veículos</a></li>
                                <li><a class="dropdown-item" href="#listaUsuarios">Lista de Usuários</a></li>
                                <li><a class="dropdown-item" href="#sairSistema">Sair do sistema</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listaVeiculos.php">Itens Cadastrados</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sobre.php">Sobre</a>
                        </li>
                        <li class="nav-item" id="imagemLogin">
                            <img id="fotoPerfil" src="picapauPerfil.png" width="40 " height="40" />
                        </li>
                    </ul>
                </div>
        </nav>
    </header>
    <main>
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-xs-6"> <!--1 de 3-->
                    <ul>
                        <li class="list-group-item" id="dicaEnergia">
                            <h6>Aprenda a usar a frenagem regenerativa (veículos elétricos)</h6>
                            <p>Boa parte dos modelos de automóveis elétricos possui o que é chamado de frenagem regenerativa,
                                um mecanismo capaz de gerar uma pequena quantidade de energia a partir do veículo que começa a
                                parar. Nos automóveis que possuem esse sistema, é possível usar a frenagem regenerativa para
                                carregar parcialmente a bateria do veículo. Portanto, se o seu carro possui essa função,
                                ative-a e aprenda a utilizá-la corretamente para aumentar ainda mais a autonomia de sua bateria.</p>
                        </li>
                        <br>
                        <br>
                        <li class="list-group-item" id="dicaCombustivel">
                            <h6>Abandone o hábito de “aquecer o motor” (veículos que utilizam combustível)</h6>
                            <p>Mesmo com a modernização dos veículos, muitos continuam com o hábito de esquentar o motor
                                antes de dar a partida, acelerando antes de engatar a marcha, que deve ser abolido porque
                                aumenta o consumo e acelera o desgaste de componentes.</p>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12" id="perfil"> <!--2 de 3-->
                    <h2 id="editarPerfil">Editar Perfil</h3>
                        <br>
                        <img id="fotoPerfil" src="picapauPerfil.png" width="175" height="175" />
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Alterar foto de perfil:</label>
                            <input class="form-control" type="file" id="alterarFoto">
                        </div>
                        <br>
                        <h2 id="cadastraVeiculo">Veículos</h2>
                        <form id="formPerfil" action="" method="POST">
                            <h4>Cadastrar um novo veículo:</h4>
                            <div class="form-check">
                                <p>Meu veículo utiliza:</p>
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="energiaPerfil">
                                <label class="form-check-label" for="energiaPerfil">Energia</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="combustivelPerfil">
                                <label class="form-check-label" for="combustivelPerfil">Combustível</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="modeloPerfil" placeholder="" name="modelo">
                                <label for="modeloPerfil">Modelo do veículo:</label>
                            </div>
                            <div class="form-floating" id="tipoCombustivelPerfilDiv">
                                <select class="form-select">
                                    <option selected>Selecione um COMBUSTÍVEL SUSTENTÁVEL</option>
                                    <option value="1">Biocombustível</option>
                                    <option value="2">Etanol</option>
                                    <option value="3">GNV (Gás Natural Veicular)</option>
                                </select>
                                <label for="floatingSelect" id="labelSelect">Tipo de Combustível:</label>
                            </div>
                            <br>
                            <div class="form-floating mb-3" id="consumoCombustivelPerfil">
                                <input type="number" class="form-control" id="inputConsumoCombustivelPerfil" placeholder="" step=".01" name="consumomedio">
                                <label for="inputConsumoCombustivelPerfil">Consumo Médio (km/l):</label>
                            </div>
                            <div class="form-floating mb-3" id="consumoEletricidadePerfil">
                                <input type="number" class="form-control" id="inputConsumoEletricidadePerfil" placeholder="" step=".01" name="consumoeletricidade">
                                <label for="inputConsumoEletricidadePerfil">Consumo de Eletricidade (km/kWh):</label>
                            </div>
                            <button type="submit" class="btn btn-secondary">Cadastrar</button>
                            <div id="alertas">
                                <div class="alert alert-danger display d-none" role="alert" id="alerta1"></div>
                                <div class="alert alert-danger display d-none" role="alert" id="alerta2"></div>
                                <div class="alert alert-danger display d-none" role="alert" id="alerta3"></div>
                                <div class="alert alert-danger display d-none" role="alert" id="alerta4"></div>
                            </div>
                        </form>
                        <br>
                        <h5>Veículos já existentes:</h5>
                        <h7><a class="link" href="listaVeiculos.php" target="_blank">Listar, editar ou excluir veículos
                                cadastrados</a></h7>
                        <br>
                        <h2 id="listaUsuarios">Usuários</h2>
                        <h7><a class="link" href="listaUsuarios.php" target="_blank">Listar ou excluir usuários cadastrados
                            </a></h7>
                        <br>
                        <h2 id="sairSistema" name="logout">Sair do Sistema</h2>
                        <a href="index.php" class="btn btn-danger" tabindex="-1" role="button" id="botaoSair">Sair</a>
                        <br>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
                            // Destroi a sessão
                            session_destroy();
                            // Redireciona para a página de login
                            header("Location: login.php");
                            exit();
                        }
                        ?>
                </div>
                <div class="col-lg-3 col-md-12 col-xs-6"> <!--3 de 3-->
                    <ul>
                        <li class="list-group-item" id="dicaEnergia">
                            <h6>Velocidade alta é vilã da autonomia do carro elétrico</h6>
                            <p>Em carros movidos com gasolina ou etanol e diesel, colocar marcha alta é uma forma de
                                consumir menos combustível por quilômetro rodado, mesmo em velocidades muito maiores. A
                                quinta velocidade em 120 km/h consome bem menos do que a segunda, em 40 km/h. No carro
                                elétrico é o contrário. A arrancada consome menos, mas a velocidade limite de estradas,
                                perto dos seus 120 km/h, é onde o veículo mais vai gastar mais a bateria. Na cidade o
                                consumo é compensado pela regeneração dos freios, algo inexistente na rodovia.</p>
                        </li>
                        <br>
                        <li class="list-group-item" id="dicaCombustivel">
                            <h6>Mantenha uma velocidade constante (veículos que utilizam combustível)</h6>
                            <p>Oscilações envolvendo acelerações e frenagens bruscas aumentam o consumo de combustível, por
                                isso, devem ser evitadas.</p>
                        </li>
                        <br>
                        <br>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <footer id="footerPerfil">
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