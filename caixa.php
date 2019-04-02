<?php
    require_once 'function/conexao.php';
        session_start();
    include 'function/confirmaLogado.php';
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
                            <form action="function/cadastrarCaixa.php" method="POST">
                                <label>Nome Caixa: </label>
                                <input class="form-control" type="text" name="caixa" required /><br />
                                <label>Endereço Caixa: </label>
                                <input class="form-control" type="text" name="endereco"  /><br />
                                <div class="form-group">
                                    <label>Tipo: </label>
                                    <select class="form-control" name='tipo' required>
                                        <option value="1" selected>Conectorizada</option> 
                                        <option value="2" selected>Fusionada</option>
                                    </select>
                                </div>
                                <div>
                                <label>Splitter</label>
                                <select class="form-control" name='splitter' required>
                                        <option value="8" selected>1x8</option> 
                                        <option value="16" selected>1x16</option>
                                    </select>
                                </div><br />
                                <input class="btn btn-primary" type="submit" value="Cadastrar" />
                            </form>
                        </div>
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="col-md-6">
                    <?php
                        $queryTecnico = "SELECT * FROM caixa ORDER BY ds_caixa;";
                        $resultado = mysqli_query($conecta, $queryTecnico);            
                    ?>
                        <h5>Equipamentos Cadastrados</h5>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>                                    
                                    <th>Nome</th>
                                    <th>Endereço</th>
                                    <th>Tipo</th>
                                    <th>Splitter</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        echo "<tr>";
                                            echo "<td>".$row['ds_caixa']."</td>";                           
                                            echo "<td>".$row['ds_endereco']."</td>";
                                            
                                            if($row['tipo'] == 1){
                                                $tipo = 'Conectorizada';
                                            }
                                            else{
                                                $tipo = 'Fusionada';
                                            }
                                            
                                            echo "<td>".$tipo."</td>";
                                            
                                            if($row['splitter'] == 8){
                                                $splitter = "1x8";
                                            }
                                            else{
                                                $splitter = "1x16";
                                            }
                                            
                                            echo "<td>$splitter</td>";
                                            
                                            echo "<td><a href='spliter.php?id=".$row['id_caixa']."'>Ver Caixa</a></td>";
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



