<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
   <head>
       <meta charset="utf-8"/>
       <title>Cadastro</title>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
       <link rel="stylesheet" href="/CSS/cadastrar-fluxo.css">
   </head>
   <div class=form-cadastrar-menu>
        <div><h1>Cadastrar Menu</h1></div>
            <div>
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
        <div class=centro-cadastro>
            <form method="POST" action="../PHP/cadastrarM.php">
                <div>
                    <label>Nome</label><br>
                    <input class="input" minlength="3" type="text" name="nome" id="inputNome" placeholder="Nome" value="<?php if (isset($campos)){ echo $campos['nome'];}?>" required><br>
                </div>

                <div>
                    <label>Rotina</label><br>
                    <input class="input" minlength="4" maxlength="4" type="text" name="rotina" id="inputRotina" placeholder="Rotina" value="<?php if (isset($campos)){ echo $campos['rotina'];}?>" required /><br>
                </div>

                <div>
                    <label>Data de Cria&ccedil;&atilde;o</label><br>
                    <input class="input" minlength="19" maxlength="19" type="date" name="data" id="inputData" placeholder="Data" value="<?php if (isset($campos)){ echo $campos['data'];}?>" required><br>
                </div>

                <div>
                     <label>Usu&aacute;rio</label><br>
                     <input class="input" minlength="3" maxlength="20" type="text" name="usuario" id="inputUsuario" placeholder="Usu&aacute;rio" required value="<?php if (isset($campos)){ echo $campos['usuario'];}?>" required><br/>
                </div>

                <div>
                    <label>Status Texto</label>
                    <input class="input" type="checkbox" name="revisaoTexto" id="inputTexto" value="TRUE" ><br>
                </div>

                <div>
                    <label>Status Passos</label>
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

                <div class="btn1">
                    <button class="input-botao" type="submit">Cadastrar</button>
                </div>
            </form>    
        <div>
    </body>
</html>