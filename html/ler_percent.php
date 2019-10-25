<?php
include 'conecta_sql.php';

$text_array = str_split($_POST["text"]);

$blocks = array();

$teste = "";
$code = 0;
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

//Criar e executar sql statement que procura cada bloco de string no $blocks no banco
//Se achar -> substitui aquele bloco pelo caracter respondente
//vai ter que ser um for each, então já da pra ir concatenando direto com .= em uma variavel


// echo $teste;
// var_dump($text_array);
var_dump($blocks);
echo "<br><br>";

// foreach ($blocks as $char) {
//     echo $char;
// }
$fim = "";
foreach ($blocks as $key => $str) {
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
        $str = $char[0];
    }
    $fim .= $str;
}

echo $fim;
