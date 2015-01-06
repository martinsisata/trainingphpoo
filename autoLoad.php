<?php 
/*
Função __autoload()
carrega uma classe quando ela é necessária,
ou seja, quando ela é instanciada pela primeira vez
*/


function __autoload($classe)
{
	if(file_exists("app.ado/{$classe}.class.php"))
	{
		require "app.ado/{$classe}.class.php";

	}
}


 ?>