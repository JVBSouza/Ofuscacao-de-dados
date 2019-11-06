<?php
include 'conecta_sql.php';

$text_array = str_split($_POST["text"]);

$blocks = array();

$code = 0;
// $word ="";

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
echo '{"sucesso":"true", "traduzido":"' . $fim . '"}';
