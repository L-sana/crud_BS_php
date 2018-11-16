<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sistema de cadastros PHP Lais</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<h1 class="page-header text-center" style="color: black;">Adicionar Membros</h1>
	<div class="row">
		
			<div class="container" >
				<a href="#addnew" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Incluir</a>
				<a href="../index.php" class="btn btn-primary"> Retornar</a>
	            <?php 
	                session_start();
	                if(isset($_SESSION['message'])){
	                    ?>
	                    <div class="alert alert-info text-center" style="margin-top:20px;" align="center">
	                        <?php echo $_SESSION['message']; ?>
	                    </div>
	                    <?php

	                    unset($_SESSION['message']);
	                }
	            ?>
        </div>
   		
            <div class="container">
          	<table class="table table-bordered table-striped" style="margin-top:20px;" width: 100%;>
				<thead>
					<th style="text-align: center; background-color: #A4A4A4;">ID</th>
					<th style="text-align: center; background-color: #A4A4A4;">Nome</th>
					<th style="text-align: center; background-color: #A4A4A4;">Sobrenome</th>
					<th style="text-align: center; background-color: #A4A4A4;">Endereço</th>
					<th style="text-align: center; background-color: #A4A4A4;">Ação</th>
				</thead>
				<tbody>
					<?php
						//inclusao de nova conexao
						include_once('connection.php');

						$database = new Connection();
    					$db = $database->open();
						try{	
						    $sql = 'SELECT * FROM membros order by nome';
						    foreach ($db->query($sql) as $row) {
						    	?>
						    	<tr>
						    		<td><?php echo $row['id']; ?></td>
						    		<td><?php echo $row['nome']; ?></td>
						    		<td><?php echo $row['sobrenome']; ?></td>
						    		<td><?php echo $row['endereco']; ?></td>
						    		<td>
						    			<a href="#edit_<?php echo $row['id']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Alterar</a>
						    			<a href="#delete_<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> Apagar</a>
						    		</td>
						    		<?php include('edit_delete_modal.php'); ?>
						    	</tr>
						    	<?php 
						    }
						}
						catch(PDOException $e){
							echo "Problema na conexao " . $e->getMessage();
						}

						$database->close();

					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php include('add_modal.php'); ?>
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>