<?php 
//Carregar as classes
include_once 'autoLoad.php';
/*
* Cria as classes Active Record
* para manipular os resgistros das tabelas correspondentes
*/
class InscricaoRecord extends Trecord {}

//Obtém objectosk da base de dados
try 
{
	//Iniscia transação com o banco 'my_livro'
	TTransaction::open('my_livro');
	//Define o arquivo para log
	TTransaction::setLogger(new TLoggerTXT('C:\Apache24\htdocs\trainingphpoo\tmp\log7.txt'));
	TTransaction::log("**Selecriona Inscrições da Turma 2");

	//Instacia critério de seleção
	$criteria = new TCriteria;
	$criteria->add(new TFilter(' refTurma ',  ' = ',  2));
	$criteria->add(new TFilter(' cancelado ', ' = ',  FALSE));

	//Instancia repositório de inscrição
	$repository = new TRepository('inscricao');
	//retornar todos os objectos que satifazem o critério
	$inscricoes = $repository->load($criteria);

	//Verifica se retornou alguma inscrição
	if ($inscricoes) 
	{
		TTransaction::log("**Altera as inscrições");
		//Percorre todas inscriç~eos retornadas

		foreach ($inscricoes as $inscricao) 
		{
			//alterar algumas propriedades
			$inscricao->nota       = 8;
			$inscricao->frequencia = 75;

			//Armazena o objecto na base de dados
			$inscricao->store();
		}
	}
	//Finaliza a transação
	TTransaction::close();
	echo "Alterações Concluida com sucesso";
} 
catch (Exception $e) //em caso de exceção
{
	//Exibe a mensagem gerada pela exceção
	echo '<b>Erro</b>' . $e->getMessage();
	//Desfaz todas alterações no banco de dados
	TTransaction::rollback();
	
}


 ?>