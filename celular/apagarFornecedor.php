<?php

    require_once "conexao.php";
    
    $sql = "delete from fornecedor where id_fornecedor = ?";
    
   if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("i", $_GET["idfornecedor"]);
        
       if($stmt->execute()){
            header("location: index.php");
            exit();
        } else{
            echo "Erro";
        }
    }
	
    $stmt->close();
    
    $mysqli->close();

?>