<?php 
	//Incluir a conexao
	include_once 'fonte/conexao.php';
	//Verificar se tem submit
	if (isset($_POST['id'])) {
		
		//receber os dados vindo do formulário via POST
		$id    = $_POST ['id'];
        $sql  = 'DELETE FROM usuario WHERE idUsuario = :id';

		try {

			$query = $bd->prepare($sql);
			$query-> bindValue(':id',$id,PDO::PARAM_INT);
			$query-> execute();

	        print"
			<script>
				alert('Deletado com sucesso');
			</script>
		    ";				
		} catch (Exception $e) {

			echo $e->getMessage();
			
		}


	}else{
		echo "esta mal";
	}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Delete</title>
 </head>
 <body><br><br><br><br><br>
 <form action ="<?php $_SERVER['PHP_SELF']; ?>" method="post">
 		<div><label>ID<input type="text" name = "id"></label></div><br><br>
 		<div><input type="submit" value="Apagar Usuário"></div>
 </form>
 </body>
 </html>