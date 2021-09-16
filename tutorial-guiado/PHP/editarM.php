<?php
    session_start();
	require '../PHP/conexao.php';
	global $pdo;

if (strlen($_POST['nome']) ==  0){
	$erros[] = utf8_encode('Preencha o campo nome.');
}

if (strlen($_POST['rotina']) == 0){
	$erros[] = utf8_encode('Preencha o campo rotina.');
}

if (strlen($_POST['data']) == 0){
	$erros[] = utf8_encode('Preencha o campo data.');
}
   
if (isset($erros) && count($erros) > 0) {

    $_SESSION['errosReportados'] = $erros;
   
    header("Location: ../View/editar-menu.php?idMenu=". $_POST['idMenus']);
     

}else {    

        $id = addslashes($_POST['idMenus']);
        $data = addslashes($_POST['data']);
        $nome = addslashes($_POST['nome']);
        $rotina = addslashes($_POST['rotina']);
        $usuario = addslashes($_POST['usuario']);
        $texto = addslashes($_POST['texto']);
        $passos = addslashes($_POST['passos']);

        if (@$_POST['revisaoTexto']){
            $revisaoTexto = addslashes($_POST['revisaoTexto']);
        }else{
            $_POST['revisaoTexto'] = 'FALSE';
            $revisaoTexto = addslashes($_POST['revisaoTexto']);
        }

        if (@$_POST['revisaoPassos']){
            $revisaoPassos = addslashes($_POST['revisaoPassos']);
        }else{    
            $_POST['revisaoPassos'] = 'FALSE';
            $revisaoPassos = addslashes($_POST['revisaoPassos']);
        }

       if (@$_POST['ambienteDev']){
            $ambienteDev = addslashes($_POST['ambienteDev']);
        }else{    
            $_POST['ambienteDev'] = 'FALSE';
            $ambienteDev = addslashes($_POST['ambienteDev']);
        }

        if (@$_POST['ambienteProd']){
            $ambienteProd = addslashes($_POST['ambienteProd']);
        }else{
            $_POST['ambienteProd'] = 'FALSE';
             $ambienteProd = addslashes($_POST['ambienteProd']);
        }
     }

	 try {

        $stmt = $pdo->prepare('UPDATE menus SET nome = :nome, rotina = :rotina, usuario = :usuario, revisaoTexto = :revisaoTexto, revisaoPassos = :revisaoPassos, ambienteDev = :ambienteDev, ambienteProd = :ambienteDev WHERE idMenus=:id');
  
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':rotina', $rotina);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':revisaoTexto', $revisaoTexto);
        $stmt->bindParam(':revisaoPassos', $revisaoPassos);
        $stmt->bindParam(':ambienteDev', $ambienteDev);
        $stmt->bindParam(':ambienteProd', $ambienteProd);

        $retorno  = $stmt->execute();

         $stmt = $pdo->prepare("INSERT INTO historicoalteracoes (nome, rotina, dataAlteracao, usuario, texto, passos) VALUES(:nome, :rotina, :dataAlteracao, :usuario, :texto, :passos)");
	     $stmt->execute(array(':nome' => $nome, ':rotina' => $rotina, ':dataAlteracao' => $data, ':usuario' => $usuario,':texto' => $texto, ':passos' => $passos));
 
         $stmt = $pdo->prepare("INSERT INTO revisao (nome, dataRevisao, usuario, texto, passos , revisaoTexto, revisaoPassos, ambienteDev, ambienteProd) VALUES(:nome, :dataRevisao, :usuario, :texto, :passos, :revisaoTexto, :revisaoPassos, :ambienteDev, :ambienteProd)");
	     $stmt->execute(array(':nome' => $nome, ':dataRevisao' => $data, ':usuario' => $usuario, ':texto' => $texto, ':passos' => $passos, ':revisaoTexto' => $revisaoTexto, ':revisaoPassos' => $revisaoPassos, ':ambienteDev' => $ambienteDev, ':ambienteProd' => $ambienteProd));
  
  if (! $retorno){
      $erros[] = utf8_encode('Não foi possivel atualizar o Menu, Tente Novamente');
  }else {
       ?> <script>alert("Menu editado com sucesso!");</script> <?php
       ?> <script>window.location.href = "../Views/home.php";</script> <?php
  } 

} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}

