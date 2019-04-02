<?php
    require_once 'conexao.php';
    
    $tecnico = $_POST['tecnico'];
    
    $query = "INSERT INTO tecnico(ds_nome) values('$tecnico');";
    $insert = mysqli_query($conecta, $query);
    
    header('location:../cadastroTecnico.php');
    

?>

