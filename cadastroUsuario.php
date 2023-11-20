<?php
session_start();

if (
    isset($_POST["modelo"]) && isset($_POST["dtnasc"]) && isset($_POST["cpf"]) && isset($_POST["telefone"]) &&
    isset($_POST["email"]) && isset($_POST["senha"]) && isset($_POST["confirmacaoSenha"])
) {
    require_once "conexao.php";
    require_once "usuario.php";
    try {
        $conn = new Conexao();

        $sql = "SELECT * FROM usuarios WHERE cpf = ?";
        $stmt = $conn->conexao->prepare($sql);

        $stmt->bindParam(1, $_POST["cpf"]);

        $resultado = $stmt->execute();

        if ($stmt->rowCount() == 1) {
            echo "Já existe um usuário cadastrado com esse cpf.";
        } else {
            $sql = "INSERT INTO usuarios (nome, dtnasc, cpf, telefone, email, senha) values (?, ?, ?, ?, ?, md5(?))";
            $stmt = $conn->conexao->prepare($sql);

            $stmt->bindParam(1, $_POST["nome"]);
            $stmt->bindParam(2, $_POST["dtnasc"]);
            $stmt->bindParam(3, $_POST["cpf"]);
            $stmt->bindParam(4, $_POST["telefone"]);
            $stmt->bindParam(5, $_POST["email"]);
            $stmt->bindParam(6, $_POST["senha"]);

            if ($resultado = $stmt->execute()) {
                $usuario = new usuario();
                echo "Cadastro realizado com sucesso!";
                $_SESSION["login"] = "1";
                $_SESSION["usuario"] = $usuario;
                header("Location: index.php");
            } else {
                $errorInfo = $stmt->errorInfo();
                echo "Erro ao cadastrar usuário. Por favor, tente novamente. Error: " . $errorInfo[2];
            }
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
    <!--<script type="text/javascript" src="TF2.js"></script>-->
    <script type="text/javascript" src="bootstrap.bundle.js"></script>
    <script src="cdnjs.cloudflare.com_ajax_libs_moment.js_2.15.1_moment.min.js"></script>
    <script src="cdnjs.cloudflare.com_ajax_libs_bootstrap-datetimepicker_4.7.14_js_bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="cdnjs.cloudflare.com_ajax_libs_bootstrap-datetimepicker_4.7.14_css_bootstrap-datetimepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <title>Cadastre-se</title>
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
                        <a class="nav-link active" href="cadastroUsuario.php">Cadastre-se</a>
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
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" id="iconeLogin">Login</a>
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
                            <h6>Aprenda a carregar a bateria (veículos elétricos)</h6>
                            <p>Essa dica está relacionada aos modos de carregamento da bateria. Algumas fabricantes
                                disponibilizam formas diferentes de restabelecer a energia do veículo. Conheça todos esses
                                modos e saiba utilizá-los corretamente. Há veículos que possuem um modo de carregamento rápido,
                                mas que causa um desgaste prematuro às células da bateria. Por isso, só deve ser usado em caso
                                de emergências.</p>
                        </li>
                        <br>
                        <li class="list-group-item" id="dicaCombustivel">
                            <h6>Evite encher demais o tanque (veículos que utilizam combustível)</h6>
                            <p>A questão aqui é o peso no carro. Quanto mais pesado o veículo estiver, mais combustível ele
                                irá gastar.</p>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12"> <!--2 de 3-->
                    <form id="formCadastro" action="cadastroUsuario.php" method="POST">
                        <h4>Formulário de cadastro</h4>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nome" placeholder="" name="nome">
                            <label for="nome">Nome Completo:</label>
                        </div>
                        <div class="input-group date">
                            <label for="dtnasc" class="col-1 col-form-label">Data de Nascimento:</label>
                            <div class="col-5">
                                <div class="input-group date">
                                    <input type="date" class="form-control" id="date" name="dtnasc" />
                                    <span class="input-group-append">
                                        <span class="input-group-text bg-light d-block">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="cpf" placeholder="555.555.555-55" name="cpf">
                            <label for="cpf">CPF:</label>
                            <div id="cpf" class="form-text">Coloque seu CPF no formato 555.555.555-55</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="telefone" placeholder="+99 (99) 999999999" name="telefone">
                            <label for="telefone">Telefone:</label>
                            <div id="cpf" class="form-text">Coloque seu telefone no formato +55 (55) 555555555 (+prefixo (DDD) número)</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="emailCadastro" placeholder="name@example.com" name="email">
                            <label for="emailCadastro">Email:</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="senhaCadastro" placeholder="Password" name="senha">
                            <label for="senhaCadastro">Senha:</label>
                        </div>
                        <br>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="senhaConfirmacao" placeholder="Password" name="confirmacaoSenha">
                            <label for="senhaConfirmacao">Confirme Sua Senha:</label>
                        </div>
                        <button type="submit" class="btn btn-secondary">Cadastrar</button>
                        <div id="alertas">
                            <div class="alert alert-danger display d-none" role="alert" id="alerta1"></div>
                            <div class="alert alert-danger display d-none" role="alert" id="alerta2"></div>
                            <div class="alert alert-danger display d-none" role="alert" id="alerta3"></div>
                            <div class="alert alert-danger display d-none" role="alert" id="alerta4"></div>
                            <div class="alert alert-danger display d-none" role="alert" id="alerta5"></div>
                            <div class="alert alert-danger display d-none" role="alert" id="alerta6"></div>
                            <div class="alert alert-danger display d-none" role="alert" id="alerta7"></div>
                            <div class="alert alert-warning display d-none" role="alert" id="alerta8"></div>
                            <div class="alert alert-danger display d-none" role="alert" id="alerta9"></div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-12 col-xs-6"> <!--3 de 3-->
                    <ul>
                        <li class="list-group-item" id="dicaEnergia">
                            <h6>Conheça as diferentes funções do automóvel (veículos elétricos)</h6>
                            <p>A maioria dos veículos elétricos possui o que é chamado de modo Eco. Essa função também limita a
                                aceleração instantânea do automóvel ao mesmo tempo que diminui a potência do ar-condicionado —
                                um combo perfeito para aumentar a autonomia.</p>
                        </li>
                        <br>
                        <li class="list-group-item" id="dicaCombustivel">
                            <h6>Mantenha as janelas fechadas na estrada (veículos que utilizam combustível)</h6>
                            <p>A posição das janelas do veículo afeta a sua aerodinâmica. Isso significa que será necessário
                                mais esforço para ele se movimentar quando estiver com as janelas abertas em uma velocidade
                                elevada. Quanto mais esforço, maior é o consumo de combustível.</p>
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