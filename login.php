<?php
session_start();

if (isset($_POST["email"]) && isset($_POST["senha"])) {
    require_once "conexao.php";
    require_once "usuario.php";

    $conn = new Conexao();

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->conexao->prepare($sql);

    $stmt->bindParam(1, $_POST["email"]);

    $resultado = $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $rs = $stmt->fetch(PDO::FETCH_OBJ);

        //comparando a senha fornecida com a senha no banco de dados (criptografada)
        if (md5($_POST["senha"]) == $rs->senha) {
            $usuario = new Usuario();
            $usuario->setEmail($rs->email);
            $usuario->setSenha($rs->senha);

            $_SESSION['email'] = $usuario->getEmail();
            $_SESSION['usuario'] = true;

            $_SESSION["login"] = "1";
            $_SESSION["usuario"] = $usuario;
            header("Location: index.php");
        } else {
            echo "Senha inválida.";
        }
    } else {
        echo "Usuário e/ou senha inválidos";
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
    <title>Login</title>
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
                    <li class="nav-item">
                        <a class="nav-link active" href="login.html" id="iconeLogin">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="container text-center">
            <div class="row">
                <div class="col-4 dicas"> <!--1 de 3-->
                </div>
                <div class="col-lg-4 col-md-6 col-xs-4"> <!--2 de 3-->
                    <form id="formLogin" action="login.php" method="POST">
                        <h4>Fazer login</h4>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email1" placeholder="name@example.com" name="email">
                            <label for="email1">Email:</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="senha1" placeholder="Password" name="senha">
                            <label for="senha1">Senha:</label>
                        </div>
                        <button type="submit" class="btn btn-secondary">Logar</button>
                        <div id="alertas">
                            <div class="alert alert-danger display d-none" role="alert" id="alerta1"></div>
                            <div class="alert alert-danger display d-none" role="alert" id="alerta2"></div>
                        </div>
                    </form>
                </div>
                <div class="col-4"> <!--3 de 3-->
                </div>
            </div>
        </div>
    </main>
    <footer id="footerLogin">
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