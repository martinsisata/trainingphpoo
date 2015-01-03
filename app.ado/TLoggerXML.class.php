<?php
/*Classe TLoggerXML
implementa o Algoritmo de LOG em XML
*/
class TLoggerXML extends TLogger 
{
	/*
	Método write()
	ecreve uma mesnsagem no arquivo de LOG
	*/
	public function write($message)
	{
		$time = date("Y-m-d H:i:s");

		//Monta a string
		$text  = "<log>\n";
		$text .= " <time>$time</time>\n";
		$text .= " <message>$message</message>\n";
		$text .= "</log>\n";

		//Adiciona ao final do arquivo
		$handler = fopen($this -> filename, 'a');
		fwrite($handler, $text);
		fclose($handler);
	}
}
?>