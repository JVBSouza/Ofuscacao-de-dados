<?php
// $target_dir = "uploads/";
// echo $target_dir;
// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// $uploadOk = 1;
// // Check if file already exists
// if (file_exists($target_file)) {
//     echo "Arquivo já existe!";
//     $uploadOk = 0;
// }

// // Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000) {
//     echo "Arquivo acima do permitido!";
//     $uploadOk = 0;
// }

// // Allow certain file formats
// if($imageFileType != "txt" ) {
//     echo "Tipo de arquivo proibido. Apenas arquivos TXT";
//     $uploadOk = 0;
// }

// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//     echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//         echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
//     } else {
//         echo "Sorry, there was an error uploading your file.";
//     }
// }

$arq_caminho = getcwd() . "\\uploads\\";
if (!(is_dir($arq_caminho)))
{
    (mkdir($arq_caminho,0777));
}
chdir($arq_caminho);
if(isset($_FILES))
{
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";
    $i = 0;
    //$msg = array( );
    $arquivos = array( array( ) );
    foreach(  $_FILES as $key=>$info ) {
        foreach( $info as $key=>$dados ) {
            for( $i = 0; $i < sizeof( $dados ); $i++ ) {
                $arquivos[$i][$key] = $info[$key][$i];
            }
        }
    }
    foreach( $arquivos as $file ) {
        if( $file['name'] != '')
        {
            $arquivoTmp = $file['tmp_name'];
            $arquivo = $file['name'];
            move_uploaded_file( $arquivoTmp, $arq_caminho. $arquivo ); 
        }
        else{
            echo "Arquivo vazio ou não informado.";
        }
    }
    
}
else
{
    echo "Problemas na carga dos arquivos.\n";
}