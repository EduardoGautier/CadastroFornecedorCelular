<?php
require_once "conexao.php";
 
 
 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        $sql = "UPDATE fornecedor SET nome=?, telefone=?, email=? , rua=?, numero=?, cidade=?, estado=?, cep=?    WHERE id_fornecedor=?";
 
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("ssssssssi",$_POST["nome"], $_POST["telefone"], $_POST["email"], $_POST["rua"], $_POST["numero"], $_POST["cidade"], $_POST["estado"], $_POST["cep"], $_POST["idFornecedor"]);
 
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
		  $sql = "select id_fornecedor,nome,telefone,email,rua,numero,cidade,estado,cep from fornecedor where id_fornecedor = ?";
      
	  if($stmt = $mysqli->prepare($sql)){

	    $stmt->bind_param("i", $_GET["idfornecedor"]);
            
             if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                     $linha = $result->fetch_array(MYSQLI_ASSOC);
                    
                    $idFornecedor = $linha["id_fornecedor"];
                    $nome = $linha["nome"];
                    $email = $linha["email"];
					$rua = $linha["rua"];
					$telefone = $linha["telefone"];
					$numero = $linha["numero"];
					$cidade = $linha["cidade"];
					$estado = $linha["estado"];
					$cep = $linha["cep"];
					
                }                 
            } else{
                echo "Erro";
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
 	<h1>Fornecedor</h1>
	<form method="post" action="atualizarFornecedor.php">
		<label>idFornecedor: </label>
		<input type="text" name="idFornecedor" value="<?php echo $idFornecedor;?>" class="form-control" readonly><br><br>

		<label>Nome: </label>
		<input type="text" name="nome" value="<?php echo $nome;?>"  class="form-control" placeholder=""><br><br>

		<label>Telefone: </label>
		<input type="text" name="telefone" value="<?php echo $telefone;?>"  class="form-control" placeholder=""><br><br>	

		<label>Email: </label>
		<input type="text" name="email" value="<?php echo $email;?>"  class="form-control" placeholder=""><br><br>

		<label>Rua: </label>
		<input type="text" name="rua" value="<?php echo $rua;?>"  class="form-control" placeholder=""><br><br>

		<label>Numero: </label>
		<input type="text" name="numero" value="<?php echo $numero;?>"   class="form-control" placeholder=""><br><br>

		<label>Cidade: </label>
		<input type="text" name="cidade" value="<?php echo $cidade;?>"   class="form-control" placeholder=""><br><br>

		<label>Estado: </label>
		<input type="text" name="estado" value="<?php echo $estado;?>"  class="form-control" placeholder=""><br><br>

		<label>Cep: </label>
		<input type="text" name="cep" value="<?php echo $cep;?>"  class="form-control" placeholder=""><br><br>

		<button type="submit" name="salvar">Salvar</button>

	</form>


 </body>
 </html> 