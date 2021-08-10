<?php

    require_once "conexao.php";
    
    $sql = "delete from celular where codigo = ?";
    
   if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("i", $_GET["codigo"]);
        
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