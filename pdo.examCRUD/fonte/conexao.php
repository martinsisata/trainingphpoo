<?php 

define('HOST','localhost');
define('DB_NAME','pdo');
define('USER','root');
define('PASS','12345678');

$dsn = 'mysql:host='.HOST.';dbname='.DB_NAME;

try {

	$bd = new PDO ($dsn,USER,PASS);
	$bd -> setAttribute (PDO::ATTR_ERRMODE,PDO :: ERRMODE_EXCEPTION);

} catch (PDOException $e) {
	echo 'Houve erro com a conexao do banco de dado'.$e->getMessage();
	
}


 ?>