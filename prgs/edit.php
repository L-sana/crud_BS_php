<?php
	session_start();
	include_once('connection.php');
	$edit=filter_input(INPUT_POST, 'edit');
	
	if(isset($edit)){
		$database = new Connection();
		$db = $database->open();
		try{
			$id = filter_input(INPUT_GET, 'id');
			$firstname =filter_input(INPUT_POST, 'nome');
			$lastname =filter_input(INPUT_POST, 'sobrenome');
			$address =filter_input(INPUT_POST, 'endereco');
			//update membro
			$sql = "UPDATE membros SET nome = '$nome', sobrenome = '$sobrenome', endereco = '$endereco' WHERE id = '$id'";
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Usuário Atualizado com Sucesso!' : 'Ocorreu um erro de sistema.\nAtualização não realizada.';

		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		$database->close();
	}
	else{
		$_SESSION['message'] = 'Fill up edit form first';
	}

	header('location: Novo_Usuario.php');

?>