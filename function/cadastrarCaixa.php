<?php
    require_once 'conexao.php';
    
    $caixa = $_POST['caixa'];
    $endereco = $_POST['endereco'];
    $tipo = $_POST['tipo'];
    $splitter = $_POST['splitter'];
    
    $query = "INSERT INTO caixa(ds_caixa, ds_endereco, tipo, splitter) values('$caixa', '$endereco', $tipo, $splitter);";
    
    $insert = mysqli_query($conecta, $query);
    
    header('location:../caixa.php');
    

?>


