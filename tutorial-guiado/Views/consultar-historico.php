<?php
	require '../PHP/conexao.php';
	global $pdo;
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
   <head>
       <meta charset="utf-8"/>
       <title>Hist&oacute;rico</title>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
       <link rel="stylesheet" href="/CSS/home.css">
   </head>
   <body>
   <h1> Hist&oacute;rico de Altera&ccedil;&otilde;es </h1>
        <table id="tabelaL">
            <thead>
               <form method="post" action="consultar-historico.php" >
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
                        <th>Desenvolvimento</th>
                        <th>Produ&ccedil;&atilde;o</th>
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

            $consultaL = $pdo->query("SELECT idHistoricoAlteracoes, dataAlteracao, nome, rotina, usuario, texto, passos FROM historicoalteracoes WHERE nome LIKE '%". $pesquisaL ."%' ");
            $consultaR = $pdo->query("SELECT idRevisao, dataRevisao, nome, usuario, texto, passos, ambienteDev, ambienteProd FROM revisao WHERE nome LIKE '%". $pesquisaL ."%' ");

            while ($linhaL = $consultaL->fetch(PDO::FETCH_ASSOC) and $linhaR = $consultaR->fetch(PDO::FETCH_ASSOC)) {
            
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
                                <?php if ($linhaR['texto'] == "TRUE"){ echo '<div class=revisado>'.'Revisado'.'</div>' ;} else { echo '<div class=pendente>'.'Pendente'.'</div>';} ?>
                            </td>
                            <td>
                                <?php if ($linhaR['passos'] == "TRUE"){ echo '<div class=revisado>'.'Revisado'.'</div>' ;} else { echo '<div class=pendente>'.'Pendente'.'</div>';} ?>    
                            </td>
                            <td>
                                <?php if ($linhaR['ambienteDev'] == "TRUE"){ echo 'Sim' ;} else { echo 'N&atilde;o';} ?>
                            </td>
                            <td>
                                <?php if ($linhaR['ambienteProd'] == "TRUE"){ echo 'Sim' ;} else { echo 'N&atilde;o';} ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
            </tbody>
        </table>
   </body>
</html>