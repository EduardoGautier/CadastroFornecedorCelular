<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" >
    <title>Estoque de Celular</title>
    	<style>
			form{
				width: 30%;	
			}	
    	</style>
</head>
<body>
  					
                   <a href="novoFornecedor.php" class="form-control">Adicionar Fornecedor</a>

                    <?php
                    require_once "conexao.php";
                    
                    $sql = "select id_fornecedor,nome,telefone,email,rua,numero,cidade,estado,cep from fornecedor";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo "<table>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Id_fornecedor</th>";
                                        echo "<th>Nome</th>";
                                        echo "<th>Telefone</th>";
                                        echo "<th>E-mail</th>";
                                        echo "<th>Rua</th>";
									    echo "<th>Numero</th>";
										echo "<th>Cidade</th>";
										echo "<th>Estado</th>";
									    echo "<th>Cep</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($linha = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $linha['id_fornecedor'] . "</td>";
                                        echo "<td>" . $linha['nome'] . "</td>";
                                        echo "<td>" . $linha['telefone'] . "</td>";
                                        echo "<td>" . $linha['email'] . "</td>";
									    echo "<td>" . $linha['rua'] . "</td>";
										echo "<td>" . $linha['numero'] . "</td>";
										echo "<td>" . $linha['cidade'] . "</td>";
										echo "<td>" . $linha['estado'] . "</td>";
										echo "<td>" . $linha['cep'] . "</td>";
                                        echo "<td><a href='atualizarFornecedor.php?idfornecedor=". $linha['id_fornecedor'] ."' >Atualiza </a></td>";
                                        echo "<td><a href='apagarFornecedor.php?idfornecedor=". $linha['id_fornecedor'] ."' >Deletar  </a></td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            $result->free();
                        }
                    } else{
                        echo "Erro SQL " . $mysqli->error;
                    }
                    
                    ?>
					
					 <a href="novoCelular.php" class="form-control">Adicionar Celular</a>
 
	<form method="post" action="index.php"> 
	
		<label>Codigo: </label>
		<input type="text" class="form-control" name="codigo"><br><br>

		<label>Fornecedor: </label>
		<select name="idFornecedor" class="form-control" >
	       <option value='0' >Todos</option>   
			
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
			
			?>
			
		</select>
		
		<label>Preço: </label>
		<input type="text" name="preco"  class="form-control" placeholder=""><br><br>
		<button type="submit" name="salvar" class="btn btn-outline-primary">Buscar</button>

	</form>

		
					 
					 
<?php
                    
                    $sql = "select codigo,marca,modelo,cor,preco,data_fabricacao,data_cadastro, f.nome nome_fornecedor from celular c join fornecedor f on (f.id_fornecedor = c.id_fornecedor)
					        where 1=1 ";
							
							
							  if($_SERVER["REQUEST_METHOD"] == "POST"){ 
								  
								  if(isset($_POST['codigo']) and !empty($_POST['codigo']))
								  {
										 $sql  .=  " and codigo = ".$_POST['codigo'];
								  }
								  if(isset($_POST['preco']) and !empty($_POST['preco']))
								  {
										 $sql  .=  " and preco = ".$_POST['preco'];
								  }
								  if(isset($_POST['idFornecedor']) and !empty($_POST['idFornecedor']) and $_POST['idFornecedor'] > 0)
								  {
										 $sql  .=  " and f.id_fornecedor = ".$_POST['idFornecedor'];
								  }
							  }
     
							
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo "<table>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Codigo</th>";
                                        echo "<th>Marca</th>";
                                        echo "<th>Modelo</th>";
                                        echo "<th>Cor</th>";
                                        echo "<th>Preço</th>";
									    echo "<th>Fornecedor</th>";
										echo "<th>Data de Fabricação</th>";
										echo "<th>Data de Cadastro</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($linha = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $linha['codigo'] . "</td>";
                                        echo "<td>" . $linha['marca'] . "</td>";
                                        echo "<td>" . $linha['modelo'] . "</td>";
                                        echo "<td>" . $linha['cor'] . "</td>";
									    echo "<td>" . $linha['preco'] . "</td>";
										echo "<td>" . $linha['nome_fornecedor'] . "</td>";
										echo "<td>" . $linha['data_fabricacao'] . "</td>";
										echo "<td>" . $linha['data_cadastro'] . "</td>";
                                        echo "<td><a href='atualizaCelular.php?codigo=". $linha['codigo'] ."' >Atualiza </a></td>";
                                        echo "<td><a href='apagarCelular.php?codigo=". $linha['codigo'] ."' >Deletar  </a></td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            $result->free();
                        }
                    } else{
                        echo "Erro SQL " . $mysqli->error;
                    }
                    
                    $mysqli->close();
                    ?>
					
					
                </div>
            </div>        
        </div>
    </div>
</body>
</html>