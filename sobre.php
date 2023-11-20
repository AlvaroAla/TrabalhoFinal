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
        <script src ="cdnjs.cloudflare.com_ajax_libs_moment.js_2.15.1_moment.min.js"></script> 
        <script src ="cdnjs.cloudflare.com_ajax_libs_bootstrap-datetimepicker_4.7.14_js_bootstrap-datetimepicker.min.js"></script>  
        <link rel ="stylesheet" href ="cdnjs.cloudflare.com_ajax_libs_bootstrap-datetimepicker_4.7.14_css_bootstrap-datetimepicker.min.css">
        <title>Criadores</title>
    </head>
    <body>
        <header class="container-fluid">
            <nav class="navbar navbar-expand-lg bg-custom">
                <a class="navbar-brand" href="index.html">DCS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Página Principal</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="cadastro.html">Cadastre-se</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="perfil.html">Perfil</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="listaVeiculos.html">Itens Cadastrados</a></li>
                        <li class="nav-item">
                            <a class="nav-link active" href="sobre.html">Sobre</a></li>
                        <?php
                            if(isset($_SESSION["login"]) && $_SESSION["login"] == "1" && isset($_SESSION["usuario"])){
                        ?>
                        <li class="nav-item" id="imagemLogin">
                            <img id="fotoPerfil" src="picapauPerfil.png" width="40 " height="40" />
                        </li>
                        <?php    
                            } else {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.html" id="iconeLogin">Login</a>
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
                    <div class="col-3"> <!--1 de 3-->
                    </div>
                    <div class="col-md-6 col-xs-12" id="sobre"> <!--2 de 3-->
                        <h1>Sobre o site</h1>
                        <article>
                            <p>Este site foi criado pelos alunos Álvaro Ala Moraes Borges e Andressa Oliveira Bernardes
                                para um trabalho da disciplina de Programação Para Internet, ministrada pelo professor Rafael Dias Araújo, da Faculdade
                                de Computação, na Universidade Federal de Uberlândia.</p>
                        </article>
                        <br>
                        <article>
                            <h5>Para mais informações, entre em contato conosco pelos emails:</h5>
                            <p id="pArticleSobre">Álvaro Ala Moraes Borges: alvaro.borges@ufu.br</p>
                            <p id="pArticleSobre">Andressa Oliveira Bernardes: andressa.bernardes@ufu.br</p>
                        </article>
                    </div>
                    <div class="col-3"> <!--3 de 3-->
                    </div>
                </div>
            </div>  
        </main>
        <footer id="footerSobre">
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