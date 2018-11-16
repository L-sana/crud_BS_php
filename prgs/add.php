<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['add'])){
		$database = new Connection();
		$db = $database->open();
		try{
			//make use of prepared statement to prevent sql injection
			$stmt = $db->prepare("INSERT INTO membros (nome, sobrenome, endereco) VALUES (:nome, :sobrenome, :endereco)");
			//if-else statement in executing our prepared statement
			$_SESSION['message'] = ( $stmt->execute(array(':nome' => $_POST['nome'] , ':sobrenome' => $_POST['sobrenome'] , ':endereco' => $_POST['endereco'])) ) ? 'Membro adicionado com sucesso!' : 'O membro não pode ser adicionado.';	
	    
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();
	}

	else{
		$_SESSION['message'] = 'Fill up add form first';
	}

	header('location: Novo_Usuario.php');
	
?>