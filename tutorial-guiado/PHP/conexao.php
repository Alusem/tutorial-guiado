<?php

$localhost = "db4free.net:3306";
$user = "sam_adm";
$passw = "pousada991";
$banco = "tutorial-guiado";

global $pdo;

try{

	$pdo = new PDO("mysql:dbname=".$banco."; host=".$localhost, $user, $passw);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
	echo "ERRO: ".$e->getMessage();
	exit;
}
