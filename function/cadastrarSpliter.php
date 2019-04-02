<?php
    require_once 'conexao.php';
    
    $porta = $_POST['porta'];
    $cliente = $_POST['cliente'];
    $caixa = $_POST['caixa'];
    
    
    $query = "INSERT INTO spliter(cod_cliente, id_caixa, porta) values('$porta', '$caixa', '$cliente');";
    
    $insert = mysqli_query($conecta, $query);
    
    header('location:../spliter.php?id='.$caixa.'');
    

?>



