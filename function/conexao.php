<?php 

$conecta = mysqli_connect('127.0.0.1', 'root', '', 'controle', '3306');

if(!$conecta){
    print 'Não foi possivel conectar ao banco de dados.';
}
?>
