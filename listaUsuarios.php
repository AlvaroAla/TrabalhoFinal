<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    //Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit();
}

require_once "conexao.php";
require_once "usuario.php";

try {
    $conn = new Conexao();

    $sql = "SELECT * FROM usuarios";
    $stmt = $conn->conexao->prepare($sql);

    $resultado = $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (\PDOException $e) {
    echo "Falha na conexão com o banco de dados: " . $e->getMessage();
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
    <title>Usuários Cadastrados</title>
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
                        <a class="nav-link" href="cadastroUsuarios.php">Cadastre-se</a>
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
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Pesquisar</button>
                </form>
            </div>
        </nav>
    </header>
    <main>
        <div class="container text-center">
            <div class="row">
                <ul class="list-group list-group-horizontal" class="listaVeiculos">
                    <!--<div class="col-lg-2 col-md-3 col-xs-12">
                        <li class="list-group-item" id="item">
                            <img id="fotoPerfil" src="picapauPerfil.png" width="75" height="75" />
                            <h5>Usuário: picapau123</h5>
                            <h6>Email: picapau@ymail.com</h5>
                                <br>
                                <button class="btn btn-outline-danger botaoExcluirUsuario" type="button">Excluir</button>
                        </li>
                    </div>
                    <div class="col-lg-2 col-md-3 col-xs-12">
                        <li class="list-group-item" id="item">
                            <img id="fotoPerfil" src="zeca.png" width="75" height="75" />
                            <h5>Usuário: zecaurubu171</h5>
                            <h6>Email: zeca@ymail.com</h5>
                                <br>
                                <button class="btn btn-outline-danger botaoExcluirUsuario" type="button">Excluir</button>
                        </li>
                    </div>-->
                    <?php
                        foreach ($usuarios as $usuario){ ?>
                            <div class="col-lg-2 col-md-3 col-xs-12">
                                <li class="list-group-item" id="item">
                                    <img src="picapauPerfil.png" width="75" height="75" /> <!-- Certifique-se de usar a imagem do usuário atual -->
                                    <h5>Usuário: <?php echo $usuario["nome"]; ?></h5>
                                    <h6>Email: <?php echo $usuario["email"]; ?></h6>
                                    <br>
                                    <button class="btn btn-outline-danger botaoExcluirUsuario" type="button">Excluir</button>
                                </li>
                            </div>
                    <?php    
                        }
                    ?>
                </ul>
            </div>
        </div>
    </main>
    <footer id="footerListaU">
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