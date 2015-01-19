<?php 
//Carregar as classes
include_once 'autoLoad.php';
/*
* Cria as classes Active Record
* para manipular os resgistros das tabelas correspondentes
*/
class Turmarecord     extends Trecord {}
class InscricaoRecord extends Trecord {}

//Delete objectos do banco de dados
try 
{
	//Iniscia transação com o banco 'my_livro'
	TTransaction::open('my_livro');
	//Define o arquivo para log
	TTransaction::setLogger(new TLoggerTXT('C:\Apache24\htdocs\trainingphpoo\tmp\log9.txt'));

	######################################################
	# Primeiro exemplo, Excluir todas as Turmas da tarde #
	######################################################
	TTransaction::log("**Excluir Turmas da tarde");


	//Iniciar um critério de seleção turma = 'T'
	$criteria = new TCriteria;
	$criteria->add(new TFilter('turno', '=' , 'T'));

	//Instanciar repositório de turmas
	$repository= new TRepository('turma');

	//Retornar todos objectos que satisfazem o critério
	$turmas = $repository ->load($criteria);

	//verificar se retornou alguma turma

	if ($turmas) 
	{
		//Percorre todas Turmas retornadas

		foreach ($turmas as $turma) 
		{
			//Excluir a turma
			$turma->delete();
		}
	}

	######################################################
	# Segundo exemplo, Excluir as inscrições do aluno "1"#
	######################################################
	TTransaction::log("**Excluir as inscrições do aluno '1'");
	//Instanciar criterio de seleção de dados ref_Aluno='1'
	$criteria = new TCriteria;
	$criteria-> add(new TFilter('refAluno', '=', '1'));

	//Instancia um repositorio de inscricao
	$repository = new TRepository('inscricao');

	//Excluir todos os objectos que satisfazem este criterio de seleção
	$repository->delete($criteria);

	//Finaliza a transação
	TTransaction::close();
	echo "Foram excluidos os dados com sucesso";
} 
catch (Exception $e) //em caso de exceção
{
	//Exibe a mensagem gerada pela exceção
	echo '<b>Erro</b>' . $e->getMessage();
	//Desfaz todas alterações no banco de dados
	TTransaction::rollback();
	
}


 ?>