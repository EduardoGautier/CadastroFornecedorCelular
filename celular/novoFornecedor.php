<?php
require_once "conexao.php";
 

	 if($_SERVER["REQUEST_METHOD"] == "POST"){
			$sql = "insert into fornecedor (nome,telefone,email,rua,numero,cidade,estado,cep) values (?,?,?,?,?,?,?,?)";
	 
			if($stmt = $mysqli->prepare($sql)){
				$stmt->bind_param("ssssssss", $_POST["nome"], $_POST["telefone"], $_POST["email"], $_POST["rua"], $_POST["numero"], $_POST["cidade"], $_POST["estado"], $_POST["cep"]);
				
				
				if($stmt->execute()){
					header("location: index.php");
					exit();
				} else{
					echo "Erro !";
				}
			}
			 
			$stmt->close();
		
		
		$mysqli->close();
		}

?>
 
 <!DOCTYPE html>
 <html lang="pt-br">
	 <head>
	 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" >
 		<title>Estoque - Celulares</title>
 			<style>
 				form {
					width:70%;
					margin: auto auto;
				}
 			</style>
 	</head>
	
 <body>
	<form method="post" action="novoFornecedor.php">
		<h1>Fornecedor</h1>
		<label>idFornecedor: </label>
		<input type="text" name="idFornecedor" class="form-control" readonly><br><br>

		<label>Nome: </label>
		<input type="text" name="nome" class="form-control" placeholder=""><br><br>

		<label>Telefone: </label>
		<input type="text" name="telefone" class="form-control" placeholder=""><br><br>	

		<label>Email: </label>
		<input type="text" name="email" class="form-control" placeholder=""><br><br>

		<label>Rua: </label>
		<input type="text" name="rua" class="form-control" placeholder=""><br><br>

		<label>Numero: </label>
		<input type="text" name="numero" class="form-control" placeholder=""><br><br>

		<label>Cidade: </label>
		<input type="text" name="cidade" class="form-control" placeholder=""><br><br>

		<label>Estado: </label>
		<input type="text" name="estado" class="form-control" placeholder=""><br><br>

		<label>Cep: </label>
		<input type="text" name="cep" class="form-control" placeholder=""><br><br>

		<button type="submit" name="salvar" class="btn btn-outline-primary">Cadastrar</button>

	</form>


 </body>
 </html>