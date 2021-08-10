<?php
require_once "conexao.php";
 
	 if($_SERVER["REQUEST_METHOD"] == "POST"){
			$sql = "insert into celular (marca,modelo,cor,preco,id_fornecedor,data_fabricacao,data_cadastro) values (?,?,?,?,?, STR_TO_DATE(?, '%d/%c/%Y') ,  STR_TO_DATE(?, '%d/%c/%Y'))";
	 
			if($stmt = $mysqli->prepare($sql)){
				
				$dataAtual = date('m/d/Y');
				
				$stmt->bind_param("sssssss", $_POST["marca"], $_POST["modelo"], $_POST["cor"], $_POST["preco"], $_POST["idFornecedor"], $_POST["dataFabricacao"], $dataAtual );
				
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
	<form method="post" action="novoCelular.php">
		<h1>Celular</h1>
		<label>Codigo: </label>
		<input type="text" name="codigo" class="form-control" readonly><br><br>

		<label>Marca: </label>
		<input type="text" name="marca" class="form-control" placeholder=""><br><br>

		<label>Modelo: </label>
		<input type="text" name="modelo" class="form-control" placeholder=""><br><br>	

		<label>Cor: </label>
		<input type="text" name="cor" class="form-control" placeholder=""><br><br>

		<label>Preço: </label>
		<input type="text" name="preco" class="form-control" placeholder=""><br><br>

		<label>Fornecedor: </label>
		<select name="idFornecedor" class="form-control" >
	     	<?php 
			
			    $sql = "select id_fornecedor, nome from fornecedor";
   
			  if($stmt = $mysqli->prepare($sql)){
					  
					 if($stmt->execute()){
						 
						$result = $stmt->get_result();
					
						if($result->num_rows > 0){
							   
							   while($linha = $result->fetch_array()){
							
									$idFornecedor = $linha["id_fornecedor"];
									$nome = $linha["nome"];
									
									echo "<option value='".$idFornecedor."' >".$nome."</option>";
						      }
						}                 
					} else{
						echo "Erro";
					}
				}
				
				$stmt->close();
				$mysqli->close();
			
			?>
			
		</select>
		
		<label>Data Fabricação: </label>
		<input type="text" name="dataFabricacao" class="form-control" placeholder=""><br><br>

		<button type="submit" name="salvar" class="btn btn-outline-primary">Cadastrar</button>

	</form>


 </body>
 </html>