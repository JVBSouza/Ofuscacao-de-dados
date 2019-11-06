<?php
include 'conecta_sql.php';

$text_array = str_split($_POST["text"]);

// var_dump($text_array);

$blocks = array();

$code = 0;
$word ="";
echo "<br>";
foreach ($text_array as $key => $value) {
    if ($value != "&" && $code == 0) {
        $word .= $value;
    } elseif ($value == "&") {
        
        array_push($blocks,$word);
        $code = 1;
        $word = "&";
    } elseif ($value == ";" && $code == 1){
        $word .= $value;
        array_push($blocks,$word);
        $code = 0;
        $word = "";
    } elseif ($value != "&" && $code == 1){
        $word .= $value;
    }
    // echo $value." ".$code." ".$word."<br>";
}
array_push($blocks,$word);

var_dump($blocks);

$fim = "";
foreach ($blocks as $key => $str) {
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

echo '{"sucesso":"true", "traduzido":"' . $fim . '"}';
