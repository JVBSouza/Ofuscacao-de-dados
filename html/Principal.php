<!DOCTYPE html>
<html class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Principal</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="../html/css/header.css">
    <link rel="stylesheet" href="../html/css/footer.css"> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            //Botões
            let frase;
            $('#bt_string').click(function() {
                var texto = $('#text').val();
                fn_traduz_percent(texto);
                fn_traduz_char(frase);
                fn_traduz_ampersan(frase);
                $('#result').html("Texto traduzido: " + frase);
            });

            // Funções

            function fn_traduz_percent(texto) {
                // var texto = $('#text').val();
                // alert("antes ajax");
                $.ajax({
                    url: 'ler_percent.php',
                    data: {
                        text: texto
                    },
                    timeout: 1200000,
                    async: false,
                    type: 'POST',
                    dataType: 'json',
                    success: function(retorno) {
                        if (retorno.sucesso == 'true') {
                            // alert(retorno.traduzido);
                            // $('#result').html("texto traduzido: " + retorno.traduzido);
                            frase = retorno.traduzido;
                        } else {
                            alert('erro');
                        }
                    }
                });
            }

            function fn_traduz_char(texto) {
                // var texto = $('#text').val();
                // alert(texto);
                $.ajax({
                    url: 'ler_char.php',
                    data: {
                        text: texto
                    },
                    timeout: 1200000,
                    async: false,
                    type: 'POST',
                    dataType: 'json',
                    success: function(retorno) {
                        if (retorno.sucesso == 'true') {
                            // alert(retorno.traduzido);
                            // $('#result').html("texto traduzido: " + retorno.traduzido);
                            frase = retorno.traduzido;
                        } else {
                            alert('erro');
                        }
                    }
                });
            }

            function fn_traduz_ampersan(texto) {
                // var texto = $('#text').val();
                // alert("antes ajax");
                $.ajax({
                    url: 'ler_ampersan.php',
                    data: {
                        text: texto
                    },
                    timeout: 1200000,
                    async: false,
                    type: 'POST',
                    dataType: 'json',
                    success: function(retorno) {
                        if (retorno.sucesso == 'true') {
                            // alert(retorno.traduzido);
                            // $('#result').html("texto traduzido: " + retorno.traduzido);
                            alert(frase);
                            frase = retorno.traduzido;
                            alert(frase);
                        } else {
                            alert('erro');
                        }
                    }
                });
            }

            function fn_traduz_arq_percent() {
                // alert("antes ajax");
                $.ajax({
                    url: 'ler_percent.php',
                    data: {
                        text: texto
                    },
                    timeout: 1200000,
                    async: false,
                    type: 'POST',
                    dataType: 'json',
                    success: function(retorno) {
                        if (retorno.sucesso == 'true') {
                            // alert(retorno.traduzido);
                            $('#result').html("Texto traduzido: " + retorno.traduzido);
                        } else {
                            alert('erro');
                        }
                    }
                });
            }
        });
    </script>
    <link rel="stylesheet" href="../html/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,600&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="
    background-color: #000000d9;
">
        <a class="navbar-brand" href="#">Desofuscador de dados</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" href="index.html">Home <span class="sr-only">(Página atual)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="Principal.php">Principal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sobre.html">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="contato.html">Contato</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="jumbotron">
        <div class="corpo">
            <div class="desc">
                <h3>Desofuscador</h3>
                <p>Esta plataforma torna legível logs de servidores Web que sofrem ataque de
                    ofuscamento em suas URL's</p>
            </div>





            <div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Linha de texto:</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="text" placeholder="Linha de Texto">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="bt_string">Carregar</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Arquivo:</label>
                    <!-- <div class="input-group mb-3"> -->
                        <form action="upload.php" method="post" name="enviar" id="enviar" enctype="multipart/form-data" target="iframeUpload" class="input-group mb-3">
                            <input type="file" name="arq[]" class="form-control" id="arq">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit" id="bt_file" >Carregar</button>
                            </div>
                        </form>
                    <!-- </div> -->
                </div>
            </div>
            <!-- <div class="container-form enviar">
             <form action="ler_percent.php" method="post" name="enviar" id="enviar" enctype="multipart/form-data" target="iframeUpload">
            <div class="form-group">
                <label for="url">Linha de texto:</label>
                <input type="text" name="text" class="form-control" id="text" style="width:600px">
            </div>
            <button type="button" class="btn" id="bt_string">Carregar</button>
             </form>
        </div>

        <div class="container-form enviar">
            <form action="upload.php" method="post" name="enviar" id="enviar" enctype="multipart/form-data" target="iframeUpload">
            <div class="form-group">
                <label for="text">Arquivo:</label>
                <input type="file" name="arq[]" class="form-control" id="arq" style="width:650px">
            </div>
            <button type="submit" class="btn" id="bt_file">Carregar</button>
            </form>
        </div>-->

            <!-- <div id="resultado" class="resultado" onload="result()">
            <h3>Resultado</h3>
            <input type="text" value='URL traduzida'>
        </div> -->

            <div><span id="result"></span></div>
            <div class="container-resultado">
                <iframe name="iframeUpload" id="iframeUpload"></iframe>
                <!-- <input type="text" name="text" class="form-control" id="result" style="width:600px"> -->
            </div>
        </div>
    </div>
    <div class="footer">

    </div>
</body>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->

</html>

<style>
    .resultado {
        display: none;
        background-color: red;
    }

    .desc {
        padding: 5px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    .body {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .enviar {
        display: flex;
        flex-direction: row;
        height: 100%;
        padding: 5px;
    }

    .btn {
        margin: 0px 5px;
        color: white;
        border-color: white;
    }

    #arq, #text {
        height: 44px;
    }

    #iframeUpload {
        height: 500px;
        width: 780px;
        margin: 10px 10px;
        background-color: #CACFD4;
    }
</style>