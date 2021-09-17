<?php
	require '../PHP/conexao.php';
	global $pdo;
  	session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/CSS/home.css">
</head>
<body>

                <?php
                    if(is_array($_SESSION) && isset($_SESSION['errosReportados'])){
                        $erros = $_SESSION['errosReportados'];
                        foreach ($erros as $erro) {
                            echo $erro;
                            echo "<br>";
                        }
                    }

                    if (is_array($_SESSION) && isset($_SESSION['cadastroRealizado'])){
                        $sucesso = $_SESSION['cadastroRealizado'];
                        echo $sucesso;
                    }

                    if (is_array($_SESSION) && isset($_SESSION['camposForm'])){
                        $campos = $_SESSION['camposForm'];
                    }
                    session_unset();
                ?>

    <h1> Fluxos </h1>
	<table id="tabelaF">
        <thead>
           <form method="post" action="home.php" >
                <tr>
                    <th><input class="form-control" name="nomeF" id="nomeF" placeholder="Nome do fluxo" na  me="nomeF"></th>
                    <th><button type="submit" class="btn btn-primary">Buscar</button></th>
                </tr>
                <tr>
                    <th>Nome</th>
                    <th>Rotina</th>
                    <th>Data de Cria&ccedil;&atilde;o</th>
                    <th>Status Texto</th>
                    <th>Status Passos</th>
                    <th>Produ&ccedil;&atilde;o</th>
                    <th>Desenvolvimento</th>
                </tr>   
           </form>

        </thead>
        <tbody>
        <?php
                if (isset(($_POST['nomeF']))){
                    $pesquisaF = addslashes($_POST['nomeF']);
                    $_POST['nomeF'] = "";
                }else{
                    $pesquisaF = "";
                }

        $consultaF = $pdo->query("SELECT idFluxos, dataCriacao, nome, rotina, revisaoTexto, revisaoPassos, ambienteProd, ambienteDev FROM fluxos WHERE nome LIKE '%". $pesquisaF ."%' OR rotina LIKE '%". $pesquisaF ."%' ");

        while ($linhaF = $consultaF->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td>
                            <?php echo $linhaF['nome']; ?>
                        </td>
                        <td>
                            <?php echo $linhaF['rotina']; ?>
                        </td>
                        <td>
                            <?php $date = new DateTime($linhaF['dataCriacao']); echo $date->format('d/m/Y'); ?>
                        </td>
                        <td>
                            <?php if ($linhaF['revisaoTexto'] == "TRUE"){ echo '<div class=revisado>'.'Revisado'.'</div>' ;} else { echo '<div class=pendente>'.'Pendente'.'</div>';} ?>
                        </td>
                        <td>
                            <?php if ($linhaF['revisaoPassos'] == "TRUE"){ echo '<div class=revisado>'.'Revisado'.'</div>' ;} else { echo '<div class=pendente>'.'Pendente'.'</div>';} ?>
                        </td>
                        <td>
                            <?php if ($linhaF['ambienteProd'] == "TRUE"){ echo 'Sim' ;} else { echo 'N&atilde;o';} ?>
                        </td>
                        <td>
                            <?php if ($linhaF['ambienteDev'] == "TRUE"){ echo 'Sim' ;} else { echo 'N&atilde;o';} ?>
                        </td>
                        <td>
                            <form action="editar-fluxo.php">
                                <input type="hidden" name="idFluxos" value="<?php echo $linhaF['idFluxos'];?>">
                                <div class="btn-editar-fluxos">  
                                    <button class="input-botão">Editar Fluxo</button>
                                </div>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="../PHP/deletarF.php">
                                <input type="hidden" name="idFluxos" value="<?php echo $linhaF['idFluxos'];?>">
                                <div class="btn-deletar-fluxos">
                                    <button class="input-botão" onclick="return confirm('Tem certeza que deseja deletar este fluxo?');">Deletar Fluxo</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
        </tbody>
    </table>

    <br>

    <form action="cadastrar-fluxo.php">
        <div class="btn-cadastrar-fluxo">
            <button class="input-botão">Cadastrar Fluxo</button>
        </div>
    </form>

    <br>

    <h1> Menus </h1>
    <table id="tabelaM">
        <thead>
           <form method="post" action="home.php" >
                <tr>
                    <th><input class="form-control" name="nomeM" id="nomeM" placeholder="Nome do menu" na  me="nomeM"></th>
                    <th><button type="submit" class="btn btn-primary">Buscar</button></th>
                </tr>
                <tr>
                    <th>Nome</th>
                    <th>Rotina</th>
                    <th>Data de Cria&ccedil;&atilde;o</th>
                    <th>Status Texto</th>
                    <th>Status Passos</th>
                    <th>Produ&ccedil;&atilde;o</th>
                    <th>Desenvolvimento</th>
                    
                </tr>   
           </form>
 
        </thead>
        <tbody>
            <?php

                if (isset(($_POST['nomeM']))){
                    $pesquisaM = addslashes($_POST['nomeM']);
                    $_POST['nomeM'] = "";
                }else{
                    $pesquisaM = "";
                }

                $consultaM = $pdo->query("SELECT idMenus, dataCriacao, nome, rotina, revisaoTexto, revisaoPassos, ambienteProd, ambienteDev FROM menus WHERE nome LIKE '%". $pesquisaM ."%' OR rotina LIKE '%". $pesquisaM ."%' ");

                while ($linhaM = $consultaM->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td>
                            <?php echo $linhaM['nome']; ?>
                        </td>
                        <td>
                            <?php echo $linhaM['rotina']; ?>
                        </td>
                        <td>
                            <?php $date = new DateTime($linhaM['dataCriacao']); echo $date->format('d/m/Y'); ?>
                        </td>
                        <td>
                            <?php if ($linhaM['revisaoTexto'] == "TRUE"){ echo '<div class=revisado>'.'Revisado'.'</div>' ;} else { echo '<div class=pendente>'.'Pendente'.'</div>';} ?>
                        </td>
                        <td>
                            <?php if ($linhaM['revisaoPassos'] == "TRUE"){ echo '<div class=revisado>'.'Revisado'.'</div>' ;} else { echo '<div class=pendente>'.'Pendente'.'</div>';} ?>
                        </td>
                        <td>
                            <?php if ($linhaM['ambienteProd'] == "TRUE"){ echo 'Sim' ;} else { echo 'N&atilde;o';} ?>
                        </td>
                        <td>
                            <?php if ($linhaM['ambienteDev'] == "TRUE"){ echo 'Sim' ;} else { echo 'N&atilde;o';} ?>
                        </td>
                        <td>
                            <form action="editar-menu.php">
                                <input type="hidden" name="idMenus" value="<?php echo $linhaM['idMenus'];?>">
                                <div class="btn-editar-menus">  
                                    <button class="input-botão">Editar Menu</button>
                                </div>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="../PHP/deletarM.php">
                                <input type="hidden" name="idMenus" value="<?php echo $linhaM['idMenus'];?>">
                                <div class="btn-deletar-menus">
                                    <button class="input-botão" onclick="return confirm('Tem certeza que deseja deletar este menu?');">Deletar Menu</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
                
        </tbody>
    </table>

    <br>

    <form action="cadastrar-menu.php">
        <div class="btn-cadastrar-menu">
            <button class="input-botão">Cadastrar Menu</button>
        </div>
    </form>

    <br>
    
    <h1> Hist&oacute;rico de Altera&ccedil;&otilde;es </h1>
    <table id="tabelaL">
        <thead>
           <form method="post" action="home.php" >
                <tr>
                    <th><input class="form-control" name="nomeL" id="nomeL" placeholder="Nome do fluxo ou menu" na  me="nomeL"></th>
                    <th><button type="submit" class="btn btn-primary">Buscar</button></th>
                </tr>
                <tr>
                    <th>Nome</th>
                    <th>Rotina</th>
                    <th>Data de Altera&ccedil;&atilde;o</th>
                    <th>Usu&aacute;rio</th>
                    <th>Texto</th>
                    <th>Passos</th>
                    <th>Status Texto</th>
                    <th>Status Passos</th>
                    <th>Produ&ccedil;&atilde;o</th>
                    <th>Desenvolvimento</th>
                </tr>       
           </form>

        </thead>
        <tbody>
        <?php
                if (isset(($_POST['nomeL']))){
                    $pesquisaL = addslashes($_POST['nomeL']);
                    $_POST['nomeL'] = "";
                }else{
                    $pesquisaL = "";
                }

        $consultaL = $pdo->query("SELECT idHistoricoAlteracoes, dataAlteracao, nome, rotina, usuario, texto, passos FROM historicoalteracoes WHERE nome LIKE '%". $pesquisaL ."%' OR rotina LIKE '%". $pesquisaL ."%' ");
        $consultaR = $pdo->query("SELECT idRevisao, dataRevisao, nome, rotina, usuario, revisaoTexto, revisaoPassos, ambienteDev, ambienteProd FROM revisao WHERE nome LIKE '%". $pesquisaL ."%' OR rotina LIKE '%". $pesquisaL ."%' ");

        $contador = 0;

        while ($linhaL = $consultaL->fetch(PDO::FETCH_ASSOC) and $linhaR = $consultaR->fetch(PDO::FETCH_ASSOC and $contador < 5)) {
            
                ?>
                    <tr>
                        <td>
                            <?php echo $linhaL['nome']; ?>
                        </td>
                        <td>
                            <?php echo $linhaL['rotina']; ?>
                        </td>
                        <td>
                            <?php $date = new DateTime($linhaL['dataAlteracao']); echo $date->format('d/m/Y'); ?>
                        </td>
                        <td>
                            <?php echo $linhaL['usuario']; ?>
                        </td>
                        <td>
                            <?php if (strlen($linhaL['texto']) == 0) { echo '[Log sem altera&ccedil;&otilde;es]';} else { echo $linhaL['texto']; } ?>
                        </td>
                        <td>
                            <?php if (strlen($linhaL['passos']) == 0) { echo '[Log sem altera&ccedil;&otilde;es]';} else { echo $linhaL['passos']; } ?>
                        </td>
                        <td>
                            <?php if ($linhaR['revisaoTexto'] == "TRUE"){ echo '<div class=revisado>'.'Revisado'.'</div>' ;} else { echo '<div class=pendente>'.'Pendente'.'</div>';} ?>
                        </td>
                        <td>
                            <?php if ($linhaR['revisaoPassos'] == "TRUE"){ echo '<div class=revisado>'.'Revisado'.'</div>' ;} else { echo '<div class=pendente>'.'Pendente'.'</div>';} ?>    
                        </td>
                        <td>
                            <?php if ($linhaR['ambienteProd'] == "TRUE"){ echo 'Sim' ;} else { echo 'N&atilde;o';} ?>
                        </td>
                        <td>
                            <?php if ($linhaR['ambienteDev'] == "TRUE"){ echo 'Sim' ;} else { echo 'N&atilde;o';} ?>
                        </td>
                        <?php $contador = ($contador + 1) ?>
                    </tr>
                <?php
                }
                ?>
        </tbody>
    </table>

    <br>

        <form action="consultar-historico.php">
            <input type="hidden" name="idHistoricoAlteracoes" value="<?php echo $linhaL['idHistoricoAlteracoes'];?>">
                <div class="btn-editar-fluxos">  
                    <button class="input-botão">Consultar Hist&oacute;rico</button>
                </div>
        </form>

</body>
</html>
