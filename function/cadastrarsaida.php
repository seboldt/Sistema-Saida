<?php
    require_once 'conexao.php';
    
    function formatarData($data){
      $rData = implode("-", array_reverse(explode("/", trim($data))));
      return $rData;
    }
    
    
    $equipamento = $_POST['equipamento'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $qtdade = $_POST['qtdade'];
    $mac = $_POST['mac'];
    $tecnico = $_POST['tecnico'];
    $dataCadastro = date("d/m/Y");
    $user = $_POST['user'];
    
    echo $dataFinal = formatarData($dataCadastro); 
    
    $query = "INSERT INTO registro_saida(ds_equipamento, ds_marca, ds_modelo, qtdade, mac, id_tecnico, data, usuario) values('$equipamento', '$marca', '$modelo', $qtdade, '$mac', $tecnico, '$dataFinal', '$user');";
    
    $insert = mysqli_query($conecta, $query);
    
    header('location:../cadastrarSaida.php');
    

?>

