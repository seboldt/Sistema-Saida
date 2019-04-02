<?php 
    require_once 'conexao.php';

    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $tec = $_POST['tec'];
    
    $query = "UPDATE registro_saida SET codigo='$codigo' WHERE id_saida=$id";
    
    $insert = mysqli_query($conecta, $query);
    
    
    header('location:../retornoTecnico.php');
?>

