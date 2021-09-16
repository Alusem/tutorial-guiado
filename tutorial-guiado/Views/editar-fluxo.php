<!DOCTYPE html>
<html lang="pt-br">
   <head>
       <meta charset="utf-8"/>
       <title>Editar</title>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
       <link rel="stylesheet" href="/CSS/cadastrar-fluxo.css">
   </head>
   <body>
        <?php
            require '../PHP/conexao.php';
	        global $pdo;
            session_start();

            $id = $_GET['idFluxos'];
            $stringQuery ="SELECT idFluxos, nome, rotina, dataCriacao, usuario, revisaoTexto, revisaoPassos, ambienteDev,ambienteProd FROM fluxos WHERE idFluxos = '".$id."';";
            $sql = $pdo->query($stringQuery);
            
            if($sql->rowCount() > 0){
                $dados = $sql->fetch();
		    }

        ?>

        <div>
                <?php
 
                    if(is_array($_SESSION) && isset($_SESSION['errosReportados'])){
                        $erros = $_SESSION['errosReportados'];
                        foreach ($erros as $erro) {
                            echo $erro;
                            echo "<br>";
                        }
                        session_unset();
                    }

                    if (is_array($_SESSION) && isset($_SESSION['atualizacaoRealizada'])){
                        $sucesso = $_SESSION['atualizacaoRealizada'];
                        echo $sucesso;
                        session_unset();
                    }
                ?>
            </div>
            
        <div class=centro-cadastro>

            <div><h1>Editar Fluxos</h1></div>

            <form method="POST" action="../PHP/editarF.php">
            
                <div>
                    <input type="hidden" name="idFluxos" value="<?php echo $_GET['idFluxos'];?>">
                </div>
                <div>
                    <label>Nome</label><br>
                    <input class="input" minlength="3" type="text" name="nome" id="inputNome" placeholder="Nome" required value="<?php echo $dados[1]; ?>"><br/>
                </div>

                <div>
                    <label>Rotina</label><br>
                    <input class="input" minlength="4" maxlength="4" type="text" name="rotina" id="inputRotina" placeholder="Rotina" required value="<?php echo $dados[2]; ?>"><br/>
                </div>

                <div>
                    <label>Data</label><br>
                    <input class="input" minlength="19" maxlength="19" type="date" name="data" id="inputData" placeholder="Data" required value="<?php echo $dados[3]; ?>"><br/>
                </div>

                <div>
                    <label>Usu&aacute;rio</label><br>
                    <input class="input" minlength="3" maxlength="20" type="text" name="usuario" id="inputUsuario" placeholder="Usu&aacute;rio" required value="<?php echo $dados[4]; ?>"><br/>
                </div>

                <div>
                    <label>Textos Revisados?</label>
                    <input class="input" type="checkbox" name="revisaoTexto" id="inputTexto"  value="TRUE" ><br>
                </div>

                <div>
                    <label>Passos Revisados?</label>
                    <input class="input" type="checkbox" name="revisaoPassos" id="inputPassos" value="TRUE" ><br>
                </div>

                <div>
                    <label>Ambiente Dev</label>
                    <input class="input" type="checkbox" name="ambienteDev" id="inputDev" value="TRUE" ><br>
                </div>

                <div>
                    <label>Ambiente Prod</label>
                    <input class="input" type="checkbox" name="ambienteProd" id="inputProd" value="TRUE" ><br>
                </div>

                <div>
                    <label>Registrar log de modifica&ccedil;&otilde;es de Texto</label><br>
                    <input class="input" minlength="0" type="text" name="texto" id="inputTexto" placeholder="Descri&ccedil;&atilde;o" ><br/>
                </div>

                <div>
                    <label>Registrar log de modifica&ccedil;&otilde;es nos Passos</label><br>
                    <input class="input" type="text" name="passos" id="inputPasso" placeholder="Descri&ccedil;&atilde;o" ><br/>
                </div>

                <div class="btn2">
                    <button class="input-botao" type="submit">Editar</button>
                </div>
            </form>
        </div>
    </body>
</html>