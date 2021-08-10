<?php
define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('BANCO', 'estoque_celulares');
 
$mysqli = new mysqli(SERVIDOR, USUARIO, SENHA, BANCO);
 
if($mysqli === false){
    die("Erro de conexão " . $mysqli->connect_error);
}
?>