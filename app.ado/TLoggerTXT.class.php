<?php
/*Classe TLoggerTXT
implementa o Algoritmo de LOG em HTML
*/

class TLoggerTXT extends TLogger 
{
	/*
	Método write()
	ecreve uma mesnsagem no arquivo de LOG
	*/
	public function write($message)
	{
		$time = date("Y-m-d H:i:s");

		//Monta a string
		$text  = "$time :: $message\n";

		//Adiciona ao final do arquivo
		$handler = fopen($this -> filename, 'a');
		fwrite($handler, $text);
		fclose($handler);
	}
}
?>