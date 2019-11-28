<?php
include 'conecta_sql.php';
set_time_limit(60);

$arq_caminho = getcwd() . "\\uploads\\";
if (!(is_dir($arq_caminho))) {
    (mkdir($arq_caminho, 0777));
}
chdir($arq_caminho);
if (isset($_FILES)) {
    // echo "<pre>";
    // print_r($_FILES);
    // echo "</pre>";
    $i = 0;
    //$msg = array( );
    $arquivos = array(array());
    foreach ($_FILES as $key => $info) {
        foreach ($info as $key => $dados) {
            for ($i = 0; $i < sizeof($dados); $i++) {
                $arquivos[$i][$key] = $info[$key][$i];
            }
        }
    }
    foreach ($arquivos as $file) {
        if ($file['name'] != '') {
            $arquivoTmp = $file['tmp_name'];
            $arquivo = $file['name'];
            move_uploaded_file($arquivoTmp, $arq_caminho . $arquivo);
        } else {
            echo "Arquivo vazio ou não informado.";
        }
    }
    echo "Upload feito!";
} else {
    echo "Problemas na carga dos arquivos.\n";
}

$lines = file($_FILES['arq']['name'][0]);

// echo "<pre>";
// print_r($lines);
// echo "</pre>";
$lines_translated_percent = array();
$lines_translated_char = array();
$lines_translated_ampersan = array();

foreach ($lines as $chave => $value) {
    // echo "chave: " . $chave;
    // $slash = addslashes($value);
    // $text_array = str_split($slash);
    $text_array = str_split($value);
    $code = 0;
    $blocks = array();
    foreach ($text_array as $key => $char) {
        
        if ($char != "%" && $code <= 0) {
            array_push($blocks, $char);
        } elseif ($char == "%") {
            if ($text_array[$key + 1] == "%" || $text_array[$key + 2] == "%") {
                array_push($blocks, $char);
            } else {
                $code = 3;
                array_push($blocks, "%" . $text_array[$key + 1] . $text_array[$key + 2]);
            }
        }
        $code--;
    }

    $fim = "";
    foreach ($blocks as $key => $str) {
        // echo "<br> key: " . $key . " char: " . $str;
        $str = addslashes($str);
        $sql = "SELECT * FROM percent WHERE valencia ='" . $str . "'";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $num_reg = count($rows);
        if ($num_reg > 0) {
            $char = "";
            foreach ($rows as $rs) {
                $char = $rs['bloco'];
            }
            $str = $char;
        }
        $fim .= $str;
    }

    array_push($lines_translated_percent, $fim);
    // $lines_translated_percent
}

// echo "<pre>";
// print_r($lines_translated_percent);
// echo "</pre>";

foreach ($lines_translated_percent as $key => $value) {
    $text_array = str_split($value);
    $code = 0;
    $blocks = array();

    foreach ($text_array as $key => $value) {
        if ($value != "c" && $code <= 0) {
            array_push($blocks, $value);
            // array_push($blocks, " ");
        } elseif ($value == "c") {
            if ($text_array[$key + 1] == "h" && $text_array[$key + 2] == "a" && $text_array[$key + 3] == "r" && $text_array[$key + 4] == "(") {
                if ($text_array[$key + 7] == ")") {
                    array_push($blocks, "char(" . $text_array[$key + 5] . $text_array[$key + 6] . ")");
                    $code = 8;
                } else if ($text_array[$key + 8] == ")") {
                    array_push($blocks, "char(" . $text_array[$key + 5] . $text_array[$key + 6] . $text_array[$key + 7] . ")");
                    $code = 9;
                } else {
                    array_push($blocks, $value);
                }
            } else {
                array_push($blocks, $value);
            }
            // array_push($blocks, " ");
        }
        $code--;
    }

    $fim = "";
    foreach ($blocks as $key => $str) {
        $str = addslashes($str);
        $sql = "SELECT * FROM char_code WHERE valencia ='" . $str . "'";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $num_reg = count($rows);
        if ($num_reg > 0) {
            $char = "";
            foreach ($rows as $rs) {
                $char = $rs['bloco'];
            }
            $str = $char[0];
        }
        $fim .= $str;
    }

    array_push($lines_translated_char, $fim);
}

// echo "<pre>";
// print_r($lines_translated_char);
// echo "</pre>";

foreach ($lines_translated_char as $key => $value) {
    $text_array = str_split($value);
    $code = 0;
    $word = "";
    $blocks = array();

    foreach ($text_array as $key => $value) {
        if ($value != "&" && $code == 0) {
            $word .= $value;
        } elseif ($value == "&") {

            array_push($blocks, $word);
            $code = 1;
            $word = "&";
        } elseif ($value == ";" && $code == 1) {
            $word .= $value;
            array_push($blocks, $word);
            $code = 0;
            $word = "";
        } elseif ($value != "&" && $code == 1) {
            $word .= $value;
        }
        // echo $value." ".$code." ".$word."<br>";
    }
    array_push($blocks, $word);

    $fim = "";
    foreach ($blocks as $key => $str) {
        $str = addslashes($str);
        $sql = "SELECT * FROM ampersan WHERE valencia ='" . $str . "'";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $num_reg = count($rows);
        if ($num_reg > 0) {
            $char = "";
            foreach ($rows as $rs) {
                $char = $rs['bloco'];
            }
            $str = $char[0];
        }
        $fim .= $str;
    }
    array_push($lines_translated_ampersan, $fim);
}

// echo "<pre>";
// print_r($lines_translated_ampersan);
// echo "</pre>";

$handle = fopen("file2.txt", "w");
fwrite($handle, pack("CCC",0xef,0xbb,0xbf));

foreach ($lines_translated_ampersan as $key => $value) {
    fwrite($handle, $value);
}
fclose($handle);

// header('Content-Type: application/octet-stream');
// header('Content-Disposition: attachment; filename=' . basename('file.txt'));
// header('Expires: 0');
// header('Cache-Control: must-revalidate');
// header('Pragma: public');
// header('Content-Length: ' . filesize('file.txt'));
// readfile('file.txt');

echo "<a href='uploads/file2.txt'>clique aqui para baixar</a>";
