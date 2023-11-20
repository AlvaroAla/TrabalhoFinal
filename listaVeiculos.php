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
    <title>Veículos Cadastrados</title>
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
                        <a class="nav-link" href="index.html">Página Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro.html">Cadastre-se</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.html">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="listaVeiculos.html">Itens Cadastrados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sobre.html">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <form class="d-flex" role="search" id="pesquisa">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="busca">
                            <button id="botaoPesquisar" class="btn btn-outline-light" type="submit">Pesquisar item</button>
                        </form>
                    </li>
                    <br>
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
                <ul class="list-group list-group-horizontal" class="listaVeiculos">
                    <div class="col-lg-2 col-md-3 col-xs-6"> <!--1 de 5-->
                        <li id="itensCadastrados" class="list-group-item">
                            <h5 id="modeloLista">Foston S09 Pro</h5>
                            <br>
                            <h5 id="consumoLista">0,3744 km/kWh</h5>
                            <br>
                            <div id="calcularItensCadastrados">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="distanciaCalcularVeiculo">
                                    <label for="distanciaCalcularVeiculo">Distância (em km):</label>
                                </div>
                                <button class="btn btn-outline-success" type="button" id="botaoCalcularItem">Calcular</button>
                            </div>
                            <br>
                            <button class="btn btn-outline-danger botaoExcluir" type="button">Excluir</button>
                            <a href="edicao.html" class="btn btn-outline-warning" tabindex="-1" role="button" id="botaoEditar">Editar</a>
                        </li>
                    </div>
                    <div class="col-lg-2 col-md-3 col-xs-6"> <!--2 de 5-->
                        <li id="itensCadastrados" class="list-group-item">
                            <h5 id="modeloLista">Honda ADV</h5>
                            <h5 id="combustivelLista">Etanol</h5>
                            <h5 id="consumoLista">20 km/l</h5>
                            <br>
                            <div id="calcularItensCadastrados">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="distanciaCalcularVeiculo">
                                    <label for="distanciaCalcularVeiculo">Distância (em km):</label>
                                </div>
                                <button class="btn btn-outline-success" type="button" id="botaoCalcularItem">Calcular</button>
                            </div>
                            <br>
                            <button class="btn btn-outline-danger botaoExcluir" type="button">Excluir</button>
                            <a href="edicao.html" class="btn btn-outline-warning" tabindex="-1" role="button" id="botaoEditar">Editar</a>
                        </li>
                    </div>
                    <div class="col-lg-2 col-md-3 col-xs-6"> <!--3 de 5-->
                        <li id="itensCadastrados" class="list-group-item">
                            <h5 id="modeloLista">J9 Baoshima</h5>
                            <br>
                            <h5 id="consumoLista">1,152 km/kWh</h5>
                            <br>
                            <div id="calcularItensCadastrados">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="distanciaCalcularVeiculo">
                                    <label for="distanciaCalcularVeiculo">Distância (em km):</label>
                                </div>
                                <button class="btn btn-outline-success" type="button" id="botaoCalcularItem">Calcular</button>
                            </div>
                            <br>
                            <button class="btn btn-outline-danger botaoExcluir" type="button">Excluir</button>
                            <a href="edicao.html" class="btn btn-outline-warning" tabindex="-1" role="button" id="botaoEditar">Editar</a>
                        </li>
                    </div>
                    <div class="col-lg-2 col-md-3 col-xs-6"> <!--4 de 5-->
                        <li id="itensCadastrados" class="list-group-item">
                            <h5 id="modeloLista">T-Cross</h5>
                            <h5 id="combustivelLista">Biocombustível</h5>
                            <h5 id="consumoLista">80 km/l</h5>
                            <br>
                            <div id="calcularItensCadastrados">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="distanciaCalcularVeiculo">
                                    <label for="distanciaCalcularVeiculo">Distância (em km):</label>
                                </div>
                                <button class="btn btn-outline-success" type="button" id="botaoCalcularItem">Calcular</button>
                            </div>
                            <br>
                            <button class="btn btn-outline-danger botaoExcluir" type="button">Excluir</button>
                            <a href="edicao.html" class="btn btn-outline-warning" tabindex="-1" role="button" id="botaoEditar">Editar</a>
                        </li>
                    </div>
                    <div class="col-lg-2 col-md-3 col-xs-6"> <!--5 de 5-->
                        <li id="itensCadastrados" class="list-group-item">
                            <h5 id="modeloLista">BYD Dolphin</h5>
                            <br>
                            <h5 id="consumoLista">44,9 km/kWh</h5>
                            <br>
                            <div id="calcularItensCadastrados">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="distanciaCalcularVeiculo">
                                    <label for="distanciaCalcularVeiculo">Distância (em km):</label>
                                </div>
                                <button class="btn btn-outline-success" type="button" id="botaoCalcularItem">Calcular</button>
                            </div>
                            <br>
                            <button class="btn btn-outline-danger botaoExcluir" type="button">Excluir</button>
                            <a href="edicao.html" class="btn btn-outline-warning" tabindex="-1" role="button" id="botaoEditar">Editar</a>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </main>
    <footer id="footerListaV">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <p>Conte-nos como está sendo sua experiência: <a class="link" href="sobre.html">entre em contato</a>.</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>