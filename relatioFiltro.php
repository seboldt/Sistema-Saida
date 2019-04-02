<?php
    require_once 'function/conexao.php';
        session_start();
    include 'function/confirmaLogado.php';
    $tec = $_POST['filtroTecnico'];
    
    if($tec == 0){
        header('location:relatorio.php');
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Estoque Beltrãonet</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><i class="fa fa-square-o "></i>&nbsp;Estoque</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">See Website</a></li>
                        <li><a href="#">Open Ticket</a></li>
                        <li><a href="#">Report Bug</a></li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center user-image-back">
                        <img src="caixa.jpg" class="img-responsive" />
                     
                    </li>
                    <li>
                        <a href="home.php"><i class="fa fa-desktop "></i>Home</a>
                    </li>                    
                    <li>
                        <a href="retornoTecnico.php"><i class="fa fa-table "></i>Baixa de Equipamentos</a>
                    </li>
                    <li>
                        <a href="cadastrarEquipamento.php"><i class="fa fa-edit "></i>Cadastrar Equipamento</a>
                    </li>            
                    <li>
                        <a href="cadastrarSaida.php"><i class="fa fa-edit "></i>Cadastrar Saída</a>
                    </li>
                    <li>
                        <a href="cadastroTecnico.php"><i class="fa fa-edit "></i>Cadastrar Técnico</a>
                    </li>

                    <li>
                        <a href="relatorio.php"><i class="fa fa-table "></i>Relatório de Baixas</a>
                    </li>                    
                    <li>
                        <a href="function/deslogar.php"><i class="fa fa-table "></i>Sair</a>
                    </li>                    
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Estoque Beltrãonet</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <form action="relatioFiltro.php" method="POST">
                                <label>Filtrar por Técnico: </label>
                                <div class="form-group">
                                    <select class="form-control" name='filtroTecnico' required>
                                        <option value="0" selected>Técnicos</option>
                                        <?php
                                            $queryTeste = "SELECT * FROM tecnico";
                                            $resul = mysqli_query($conecta, $queryTeste);
                                            while ($r = mysqli_fetch_array($resul)) {
                                                echo "<option value='".$r['id_tecnico']."'>".$r['ds_nome']."</option>";
                                            }                            
                                        ?>
                                    </select>
                                </div>
                                <input class="btn btn-primary" type="submit" value="Filtrar" />
                            </form>
                        </div>
                    </div>
                </div>
                
               <div class="row">
                    <div class="col-md-6">
                        <?php
                            $queryTecnico = "SELECT * FROM registro_saida INNER JOIN tecnico ON registro_saida.id_tecnico = tecnico.id_tecnico WHERE registro_saida.id_tecnico=$tec AND registro_saida.codigo is NOT NULL ORDER BY data DESC;";
                            $resultado = mysqli_query($conecta, $queryTecnico);             
                        ?>
                        
                        <h5>Baixa de Equipamentos</h5>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Equipamento</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Quantidade</th>
                                    <th>MAC</th>
                                    <th>Tecnico</th>
                                    <th>Data</th>
                                    <th>Código Cliente</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while ($row = mysqli_fetch_array($resultado)) {        
                                        $data = $row['data'];
                                        echo "<tr>";
                                        echo "<td>".$row['ds_equipamento']."</td>";                            
                                        echo "<td>".$row['ds_marca']."</td>";
                                        echo "<td>".$row['ds_modelo']."</td>";
                                        echo "<td>".$row['qtdade']."</td>";
                                        echo "<td>".$row['mac']."</td>";
                                        echo "<td>".$row['ds_nome']."</td>";
                                        echo "<td>".date('d/m/Y', strtotime($data))."</td>";
                                        
                                        if($row['codigo'] == NULL){
                                            echo "<td>------</td>";
                                            echo "<td></td>"; 
                                        }else{
                                            echo "<td>".$row['codigo']."</td>";
                                            echo "<td></td>";
                                        }
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
               </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>


</body>
</html>


