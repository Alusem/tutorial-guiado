<?php
    session_start();
	require '../PHP/conexao.php';
	global $pdo;
   
	 try {
        
        $id = addslashes($_POST['idMenus']);

        $stmt = $pdo->prepare('DELETE FROM menus WHERE idMenus = :id');
  
        $stmt->bindParam(':id', $id);
        
        if ($id > 0 ){
        $retorno  = $stmt->execute();
        }
  
      if (! $retorno){
          $erros[] = utf8_encode('Não foi possivel deletar o menu, Tente Novamente');
      }else {
           ?> <script>alert("Menu deletado com sucesso!");</script> <?php
           ?> <script>window.location.href = "../Views/home.php";</script> <?php
      }

    } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
