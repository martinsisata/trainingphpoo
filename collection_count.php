<?php 

//Carregar as classes
include_once 'autoLoad.php';
/*
* Cria as classes Active Record
* para manipular os resgistros das tabelas correspondentes
*/

class AlunoRecord     extends TRecord {}
class TurmaRecord     extends TRecord {}

//Obtém objectos do banco de dados
try 
{
		//Inicia transação com o banco 'my_livro'
	TTransaction::open('my_livro');
    TTransaction::setLogger(new TLoggerTXT('C:\Apache24\htdocs\trainingphpoo\tmp\log8.txt'));
	TTransaction::log("**Conta Alunos de Luanda");

	//Primeiro Exemplo 

	//Instancia um criteripo de seleção 
	$criteria = new TCriteria;
	$criteria->add(new TFilter('cidade', ' = ' , 'Luanda'));

	//Instanciar um repositório de aluno
	$respository = new TRepository('aluno');
	$count = $respository->count($criteria);

	//Exibe o total na tela

	echo "O Total de aluno de Luanda é:  {$count}<br>\n";

	############################################################
	# Segundo exemplo, Contar todas as turmas com aula na sala #
	# "100" no turno da tarde ou na "200" pelo turno da manha. #
	############################################################

	TTransaction::log("**Conta Turmas");

	//Instancia um criterio de seleção
	//sala "100" e turna "T" (tarde)
	$criteria1 = new TCriteria;
	$criteria1->add(new TFilter(' sala ',  ' = ', ' 100 '));
	$criteria1->add(new TFilter(' turno ', ' = ', ' T '));
	
	//Instancia um criterio de seleção
	//sala "200" e turna "M" (Manhã)
	$criteria2 = new TCriteria;
	$criteria2->add(new TFilter(' sala ',  ' = ', ' 200 '));
	$criteria2->add(new TFilter(' turno ', ' = ', ' M '));
	
	//Instancia um criterio de seleção
	//com OU para juntar os critério anteriorias 
	$criteria = new TCriteria;
	$criteria->add($criteria1, TExpression::OR_OPERATOR);
	$criteria->add($criteria2, TExpression::OR_OPERATOR);

	//Instancia um repositorio
	$repository = new TRepository('turma');
	
	//Retornar quantos objectos satisfazem o critério
	$count = $repository->count($criteria);
	echo "Total de turmas: {$count} <br>\n";

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