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

    <script>
    </script>

</head>

<body>
    <div class="header">
        <h1>Título do site aqui</h1>
        <p>Sub texto aqui</p>
    </div>
    <div class="navbar">
        <a href="index.html">Home</a>
        <a href="Principal.html" class="active">Principal</a>
        <a href="sobre.html">Sobre</a>
        <a href="contato.html" class="right">contato</a>
    </div>
    <div class="corpo">
        <div class="desc">
            <h3>Descrição da ferramenta</h3>
            <p>texto</p>
        </div>
        <div class="container-form">
            <form action="ler_percent.php" method="post" name="enviar" id="enviar" enctype="multipart/form-data" target="iframeUpload">
                <div class="form-group">
                    <label for="url">Arquivo:</label>
                    <input type="text" name="text" class="form-control" id="text" style="width:600px">
                </div>
                <button type="submit" class="btn btn-secondary">Carregar</button>
            </form>
        </div>

        <!-- <div id="resultado" class="resultado" onload="result()">
            <h3>Resultado</h3>
            <input type="text" value='URL traduzida'>
        </div> -->

        <div class="container-iframe">
            <iframe name="iframeUpload" id="iframeUpload"></iframe>
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
    }

    .body {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    #enviar {
        display: flex;
        flex-direction: row;
        height: 100%;
        padding: 5px;
    }

    #iframeUpload {
        height: 100px;
        width: 1200px;
        margin: 10px 10px;
    }
</style>