<?php 
//Carregar as classes
include_once 'autoLoad.php';
/*
* Cria as classes Active Record
* para manipular os resgistros das tabelas correspondentes
*/
class AlunoRecord     extends TRecord {}
class TurmaRecord      extends TRecord {}
class InscricaoRecord extends TRecord {}

//Obtém objectos do banco de dados
try 
{
	//Iniciar a transação com o banco de dado my_livro
	TTransaction::open('my_livro');
	//Define o arquivo para LOG
	TTransaction::setLogger(new TLoggerTXT('C:\Apache24\htdocs\trainingphpoo\tmp\log6.txt'));
	####################################################################
	# Primeiro Exemplo, Lista todas turmas em andamento no turno tarde #
	####################################################################

	//Cria um critério de seleção 
	$criteria = new TCriteria;
	//Filtra por turno e encerramento
	$criteria->add(new TFilter('turno',      '=',  'T'));
	$criteria->add(new TFilter('encerrada',  '=',  FALSE));

	//Instacia um repositório para Turma
	$repository = new TRepository('turma');

	//Retorna todos os Objectos que satisfazem o critério
	$turmas = $repository->load($criteria);

	//Verifica se retornou alguma turma
	if ($turmas) 
	{
		echo "Turmas Retornadas<br>\n";
		echo "==================<br>\n";

		//percorre todas turmas retornadas
		foreach ($turmas as $turma) 
		{
			echo ' ID          :' . $turma->id;
			echo ' Dia         :' . $turma->diaSemana;
			echo ' Turno       :' . $turma->sala;
			echo ' Professor   :' . $turma->professor;
			echo "<br>\n";
		}
	}
	#####################################################
	# Segundo Exemplo, Lista todos aprovados da turma 1 #
	#####################################################
	//instanciar um critério de seleção
	$criteria = new TCriteria;
	$criteria->add(new TFilter('nota',          ' >=',    7));
	$criteria->add(new TFilter('frequencia',    ' >=',    75));
	$criteria->add(new TFilter('refTurma',      ' =',    1));
	$criteria->add(new TFilter('cancelado',     ' =',    FALSE));

	//Instancia um repositório para Inscrição
	$repository = new TRepository('inscricao');
	//Retornar todos objectos que satisfazem o critério
	$inscricoes = $repository->load($criteria);
	//Verifica se retornou alguma inscrição
	if ($inscricoes) 
	{
		echo "Inscrições Retornadas<br>\n";
		echo "==================<br>\n";
		//Percorrer todas a inscrições retornadas
		foreach ($inscricoes as $inscricao) 
		{
			echo '  ID       :  ' . $inscricao->id;
			echo '  Aluno    :  ' . $inscricao->refAluno;

			//Obter o aluno relacionado a inscrição
			$aluno = new AlunoRecord($inscricao->refAluno);
			echo '  Nome    :  ' . $aluno->nome;
			echo '  Rua     :  ' . $aluno->endereco;
			echo "<br>\n";
		}
	}

	//Finaliza a transação
	TTransaction::close();

} catch (Exception $e) //em caso de Exceção
{
	//Exibe a mensagem gerada pela exceção
	echo '<br>Erro<br>' . $e->getMessage();
	//Desfaz todas alterações na base de dados
	TTransaction::rollback();
	
}
 ?>