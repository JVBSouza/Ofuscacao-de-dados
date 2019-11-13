<!DOCTYPE html>
<html class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Principal</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../html/css/header.css">
    <link rel="stylesheet" href="../html/css/footer.css">

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
                $('#result').html("texto traduzido: " + frase);
            });

            // $('#bt_file').click(function() {
            //     fn_traduz_arq_percent();
            // });

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
                            $('#result').html("texto traduzido: " + retorno.traduzido);
                        } else {
                            alert('erro');
                        }
                    }
                });
            }
        });
    </script>

</head>

<body>
    <div class="header">
        <h1>Desofuscador de dados</h1>
        <p> Segurança acima de tudo</p>
    </div>
    <div class="navbar">
        <a href="index.html">Home</a>
        <a href="Principal.php" class="active">Principal</a>
        <a href="sobre.html">Sobre</a>
        <a href="contato.html" class="right">Contato</a>
    </div>
    <div class="corpo">
        <div class="desc">
            <h3>Desofuscador</h3>
            <p>Esta plataforma torna legível logs de servidores Web que sofrem ataque de
ofuscamento em suas URL's</p>
        </div>
        <div class="container-form enviar">
            <!-- <form action="ler_percent.php" method="post" name="enviar" id="enviar" enctype="multipart/form-data" target="iframeUpload"> -->
            <div class="form-group">
                <label for="url">Linha de texto:</label>
                <input type="text" name="text" class="form-control" id="text" style="width:600px">
            </div>
            <button type="button" class="btn" id="bt_string">Carregar</button>
            <!-- </form> -->
        </div>

        <div class="container-form enviar">
            <form action="upload.php" method="post" name="enviar" id="enviar" enctype="multipart/form-data" target="iframeUpload">
            <div class="form-group">
                <label for="text">Arquivo:</label>
                <input type="file" name="arq[]" class="form-control" id="arq" style="width:650px">
            </div>
            <button type="submit" class="btn" id="bt_file">Carregar</button>
            <!-- </form> -->
        </div>

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
    <div class="footer">

    </div>
</body>

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
    }

    #iframeUpload {
        height: 500px;
        width: 780px;
        margin: 10px 10px;
    }
</style>