<?php
    session_start();
	require 'conexao.php';
	global $pdo;

    $nome = addslashes($_POST['nome']);
    $rotina = addslashes($_POST['rotina']);
    $usuario = addslashes($_POST['usuario']);
    $data = addslashes($_POST['data']);
    $revisaoTexto = addslashes($_POST['revisaoTexto']);
    $revisaoPassos = addslashes($_POST['revisaoPassos']);
    $ambienteDev = addslashes($_POST['ambienteDev']);
    $ambienteProd = addslashes($_POST['ambienteProd']);

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
    
    $_SESSION['camposForm'] = $_POST;
    $_SESSION['errosReportados'] = $erros;
    header("Location: ../View/Home.php");

}else {

    $nome = addslashes($_POST['nome']);
    $rotina = addslashes($_POST['rotina']);
    $data = addslashes($_POST['data']);
    $revisaoTexto = addslashes($_POST['revisaoTexto']);
    $revisaoPassos = addslashes($_POST['revisaoPassos']);
    $ambienteDev = addslashes($_POST['ambienteDev']);
    $ambienteProd = addslashes($_POST['ambienteProd']);

	 $stmt = $pdo->prepare("INSERT INTO menus (dataCriacao, nome, rotina, usuario, revisaoTexto, revisaoPassos, ambienteDev, ambienteProd) VALUES(:dataCriacao, :nome, :rotina, :usuario, :revisaoTexto, :revisaoPassos, :ambienteDev, :ambienteProd)");
	 $stmt->execute(array(':dataCriacao' => $data, ':nome' => $nome, ':rotina' => $rotina, ':usuario' => $usuario, ':revisaoTexto' => $revisaoTexto, ':revisaoPassos' => $revisaoPassos,':ambienteDev' => $ambienteDev, ':ambienteProd' => $ambienteProd));

     $_SESSION['cadastroRealizado'] = $sucesso;
     ?> <script>alert("Fluxo cadastrado com sucesso!");</script> <?php
     ?> <script>window.location.href = "../Views/home.php";</script> <?php
}