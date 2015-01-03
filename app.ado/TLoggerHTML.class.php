<?php
/*Classe TLoggerHTML
implementa o Algoritmo de LOG em HTML
*/
class TLoggerHTML extends TLogger 
{
	/*
	Método write()
	ecreve uma mesnsagem no arquivo de LOG
	*/
	public function write($message)
	{
		$time = date("Y-m-d H:i:s");

		//Monta a string
		$text  = "<p>\n";
		$text .= " <b>$time</b>:\n";
		$text .= " <i>$message</i>\n";
		$text .= "</p>\n";

		//Adiciona ao final do arquivo
		$handler = fopen($this -> filename, 'a');
		fwrite($handler, $text);
		fclose($handler);
	}
}
?>