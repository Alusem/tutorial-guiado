<?php
    session_start();
	require '../PHP/conexao.php';
	global $pdo;
   
	 try {
        
        $id = addslashes($_POST['idFluxos']);

        $stmt = $pdo->prepare('DELETE FROM fluxos WHERE idFluxos = :id');
  
        $stmt->bindParam(':id', $id);
        
        if ($id > 0 ){
        $retorno  = $stmt->execute();
        }
  
      if (! $retorno){
          $erros[] = utf8_encode('Não foi possivel deletar o fluxo, Tente Novamente');
      }else {
           ?> <script>alert("Fluxo deletado com sucesso!");</script> <?php
           ?> <script>window.location.href = "../Views/home.php";</script> <?php
      }

    } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
