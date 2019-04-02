<?php
    require_once 'conexao.php';
    
    $equipamento = $_POST['equipamento'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    
    
    $query = "INSERT INTO equipamento(ds_equipamento, ds_marca, ds_modelo) values('$equipamento', '$marca', '$modelo');";
    
    $insert = mysqli_query($conecta, $query);
    
    header('location:../cadastrarEquipamento.php');
    

?>

