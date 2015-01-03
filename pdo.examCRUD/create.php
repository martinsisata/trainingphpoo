<?php 
	//Incluir a conexao
	include_once 'fonte/conexao.php';
	//Verificar se tem submit
	if (isset($_POST['nome'])) {
		
		//receber os dados vindo do formulário via POST
		$nome  = $_POST ['nome'];
		$email = $_POST ['email'];
$sql  = ' INSERT INTO usuario (nome, email, criadoEm) ';
		$sql .= ' VALUES (:nome, :email, NOW()) ';


		try {

			$query = $bd->prepare($sql);
			$query-> bindValue(':nome',$nome,PDO::PARAM_STR);
			$query-> bindValue(':email',$email,PDO::PARAM_STR);
			$query-> execute();

	        print"
			<script>
				alert('Gravada com sucesso');
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
 	<title>Create</title>
 </head>
 <body><br><br><br><br><br>
 <form action ="<?php $_SERVER['PHP_SELF']; ?>" method="post">
 		<div><label>Nome<input type="text" name = "nome"></label></div><br><br>
 		<div><label>Usuario<input type="text" name = "email"></label></div><br><br>
 		<div><input type="submit" value="Criar Usuário"></div>
 </form>
 </body>
 </html>