<?php
/*Classe TConnection
Gerencia conexões com banco de dados atravez de arquivos de configuração 
*/

final class TConnection
{
	/*
	Método constract
	Nãp existira constancia por isso estamos marcando private
	*/

	private function __Construct() {}
	/*
	Método open()
	Recebe o nome do banco de dado e Instancia o objecto PDO correspondente
	*/
	
public static function open ($nome)
 	{
 		//Verifica se existe aquivo de configuração para este Banco de dado
 		if (file_exists("app.config/{$nome}.ini")) 
 		{
 			//Lê o ini e retorna uma array
 			$db = parse_ini_file("app.config/{$nome}.ini");
 		}
 		else
 		{
 			//Se não exixtir Lança um erro
 			throw new Exception ("Arquivo '$nome' não encontrado");
 		}
 		//Lê as informações contidas no arquivo
 		$user = isset($db ['user']) ? $db ['user'] : NULL;
 		$pass = isset($db ['pass']) ? $db ['pass'] : NULL;
 		$name = isset($db ['name']) ? $db ['name'] : NULL;
 		$host = isset($db ['host']) ? $db ['host'] : NULL;
 		$type = isset($db ['type']) ? $db ['type'] : NULL;
  	$port = isset($db ['port']) ? $db ['port'] : NULL;

  		//Descobre qual é o tipo de banco de dados a ser utilizado
  		switch ($type) {
  			case 'pgsql':
  				$port = $port ? $port : '5432';
  				$conn = new PDO ("pgsql:dbname={$name}; user = {$user}; password ={$pass};
  					host = $host; port = {$port}");
  				break;
  			case 'mysql':
  				$port = $port ? $port : '3306';
  				$conn = new PDO('mysql:host=localhost;dbname=my_livro','root','12345678');
  				break;
  			case 'sqlite':
  				$conn = new PDO("sqlite:{$name}");
  				break;
  			case 'ibase':
  				$conn = new PDO ("firebird:dbname={$name}", $user,$pass);
  				break;
  			case 'aci8':
  				$conn = new PDO("oci:dbname={$name}", $user, $pass);
  				break;
  			case 'msql':
  				$conn = new PDO("msql:host ={$host}, 1433;dbname={$name}",$user, $pass);
  				break;
  			default:
  				echo "Não Existe";
  				break;
  		}

  		//Definir para que o PDO lança exceções na acorrencia de erros
  		$conn -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  		//resornar o Objecto instanciadso
  		return $conn;


 	}
}
?>