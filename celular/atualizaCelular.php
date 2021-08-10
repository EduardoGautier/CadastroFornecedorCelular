<?php
require_once "conexao.php";
 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        $sql = "UPDATE celular SET marca=?, modelo=?, cor=? , preco=?, id_fornecedor=?, data_fabricacao= STR_TO_DATE(?, '%d/%c/%Y')  WHERE codigo=?";
 
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("sssssss", $_POST["marca"], $_POST["modelo"], $_POST["cor"], $_POST["preco"], $_POST["idFornecedor"],  $_POST["dataFabricacao"], $_POST["codigo"] );
				
             if($stmt->execute()){ 
                header("location: index.php");
                exit();
            } else{
                echo "Erro";
            }
        }
         
        $stmt->close();
	  $mysqli->close();
    }
	else
	{
		  $sql = "select codigo, marca, modelo, cor, preco, id_fornecedor, data_fabricacao from celular where codigo = ?";
      
	  if($stmt = $mysqli->prepare($sql)){

	    $stmt->bind_param("i", $_GET["codigo"]);
            
             if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                     $linha = $result->fetch_array(MYSQLI_ASSOC);
                    
                    $codigo = $linha["codigo"];
                    $marca = $linha["marca"];
                    $modelo = $linha["modelo"];
					$cor = $linha["cor"];
					$preco = $linha["preco"];
					$idFornecedor = $linha["id_fornecedor"];
					$dataFabricacao = $linha["data_fabricacao"];
							
                }                 
            } else{
                echo "Erro";
            }
        }
        
        $stmt->close();
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
 		<h1>Celular</h1>
	<form method="post" action="atualizaCelular.php">
		<label>Codigo: </label>
		<input type="text" name="codigo" value="<?php echo $codigo;?>" class="form-control" readonly><br><br>

		<label>Marca: </label>
		<input type="text" name="marca" value="<?php echo $marca;?>" class="form-control" placeholder=""><br><br>

		<label>Modelo: </label>
		<input type="text" name="modelo" value="<?php echo $modelo;?>" class="form-control" placeholder=""><br><br>	

		<label>Cor: </label>
		<input type="text" name="cor" value="<?php echo $cor;?>" class="form-control" placeholder=""><br><br>

		<label>Preço: </label>
		<input type="text" name="preco" value="<?php echo $preco;?>" class="form-control" placeholder=""><br><br>

		<label>Fornecedor: </label>
		<select name="idFornecedor" value="<?php echo $idFornecedor;?>" class="form-control" >
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
		<input type="date" name="dataFabricacao" value="<?php echo $dataFabricacao;?>" class="form-control" placeholder=""><br><br>

		<button type="submit" name="salvar">Salvar</button>

	</form>


 </body>
 </html> 