<?php
    require_once 'function/conexao.php';
    session_start();
    include 'function/confirmaLogado.php';
    
    $user = $_SESSION['login'];
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
                        <a href="function/deslogar.php"><i class="fa fa-exit "></i>Sair</a>
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
                        
                            <?php            
                                $queryEquipamentos = "SELECT ds_equipamento FROM equipamento GROUP BY ds_equipamento ORDER BY ds_equipamento";
                                $resultadoEquipamento = mysqli_query($conecta, $queryEquipamentos);
                                
                                $queryMarca = "SELECT ds_marca FROM equipamento WHERE ds_marca != '' group by ds_marca ORDER BY ds_marca";
                                $resultadoMarca = mysqli_query($conecta, $queryMarca);
                                
                                $queryModelo = "SELECT ds_modelo FROM equipamento WHERE ds_modelo != '' group by ds_modelo ORDER BY ds_modelo";
                                $resultadoModelo = mysqli_query($conecta, $queryModelo);
                            
                                $queryTecnico = "SELECT * FROM tecnico ORDER BY ds_nome";
                                $resultadoTecnico = mysqli_query($conecta, $queryTecnico);
                            ?>
                            
                            <form action="function/cadastrarsaida.php" method="POST">
                                <label>Equipamento: </label>
                                <div class="form-group">
                                    <select class="form-control" name='equipamento' required>
                                        <option value="" disabled selected>Escolha Equipamento</option>
                                        <?php
                                            while($rowEquipamento = mysqli_fetch_array($resultadoEquipamento)){
                                                echo '<option value="'.$rowEquipamento["ds_equipamento"].'">'.$rowEquipamento["ds_equipamento"].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <label>Marca: </label>
                                <div class="form-group">
                                    <select class="form-control" name="marca">
                                        <option value="">Sem Marca</option>
                                        <?php
                                            while($rowMarca = mysqli_fetch_array($resultadoMarca)){
                                                echo '<option value="'.$rowMarca["ds_marca"].'">'.$rowMarca["ds_marca"].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <label>Modelo: </label>    
                                <div class="form-group">
                                    <select class="form-control" name="modelo">
                                        <option value="">Sem Modelo</option>
                                        <?php
                                            while($rowModelo = mysqli_fetch_array($resultadoModelo)){
                                                    echo '<option value="'.$rowModelo["ds_modelo"].'">'.$rowModelo["ds_modelo"].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <label>Quantidade: </label>
                                <input class="form-control" type="text" name="qtdade" required /><br />
                                <label>MAC: </label>
                                <input class="form-control" type="text" name="mac" /><br />
                                <label>Técnico: </label>
                                <div class="form-group">
                                    <select class="form-control" name="tecnico" required>
                                        <option value="" disabled selected>Técnico</option>
                                        <?php
                                            while($rowTecnico = mysqli_fetch_array($resultadoTecnico)){
                                                echo '<option value="'.$rowTecnico["id_tecnico"].'">'.$rowTecnico["ds_nome"].'</option>';
                                            }
                                        ?>
                                    </select>                            
                                </div>                                
                                <input type="hidden" value="<?php echo $user;?> " name="user" />
                                <input class="btn btn-primary" type="submit" value="Cadastrar" />
                            </form>
                        </div>
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="col-md-6">
                    <?php
                        $querySaida = "SELECT * FROM registro_saida INNER JOIN tecnico ON registro_saida.id_tecnico = tecnico.id_tecnico ORDER BY data DESC;";
                        $resultado = mysqli_query($conecta, $querySaida);                                    
                    ?>
                        <h5>Saídas de Equipamentos</h5>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>                                    
                                    <th>Equipamento</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Quantidade</th>
                                    <th>MAC</th>
                                    <th>Técnico</th>
                                    <th>Data</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                    while ($rowSaida = mysqli_fetch_array($resultado)) {
                                        $data = $rowSaida['data']; 
                                        echo "<tr>";                                            
                                            echo "<td>".$rowSaida['ds_equipamento']."</td>";                            
                                            echo "<td>".$rowSaida['ds_marca']."</td>";
                                            echo "<td>".$rowSaida['ds_modelo']."</td>";
                                            echo "<td>".$rowSaida['qtdade']."</td>";                            
                                            echo "<td>".$rowSaida['mac']."</td>";
                                            echo "<td>".$rowSaida['ds_nome']."</td>";
                                            echo "<td>".date('d/m/Y', strtotime($data))."</td>";
                                             echo "<td><a href='function/excluirSaida.php?id=".$rowSaida['id_saida']."'><i class='glyphicon glyphicon-trash'></i></a></td>";
                                        echo "</tr>";
                                    }
                                    
                                
                                ?>                                    
                            </tbody>
                        </table>
                    </div> 
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


