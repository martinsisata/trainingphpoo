<?php 
	//Incluir a conexao
	include_once 'fonte/conexao.php';
	//Verificar se tem submit
	if (isset($_POST['nome'])) {
		
		//receber os dados vindo do formulário via POST
		$nome  = $_POST ['nome'];
		$email = $_POST ['email'];
		$id    = $_POST ['id'];
        $sql  = ' UPDATE  usuario SET nome = ?, email = ? WHERE idUsuario = ?';

		try {

			$query = $bd->prepare($sql);
			$query-> bindValue(1,$nome,PDO::PARAM_STR);
			$query-> bindValue(2,$email,PDO::PARAM_STR);
			$query-> bindValue(3,$id,PDO::PARAM_INT);
			$query-> execute();

	        print"
			<script>
				alert('Actualizado com sucesso');
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
 		<div><label>Nome<input type="text" name = "nome" ></label></div><br><br>
 		<div><label>Usuario<input type="text" name = "email"></label></div><br><br>
 		<div><input type="submit" value="Actualizar Usuário"></div>
 </form>
 </body>
 </html>