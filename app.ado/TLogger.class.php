<?php
/*Classe TLogger
Esta Classe provê uma interface Abstrata para definição de algoritmos de LOG
*/
abstract class TLogger
{
	protected $filename; //Local do Arquivo de LOG

	/* 
	Método __construct()
	Instancia um logger
	*/
	public function __construct($filename)
	{
		$this -> filename = $filename;
		
		//Reseta o conteudo do arquivo
		file_put_contents($filename, '');

	}
	//define o métdo write como obrigatório
	abstract function write ($message);
}
?>