<?php 
/*
 *Classe TRepositoy
 *Esta classe provê os métodos necessários para manipilar coleçºoes de Objectos.
 */

final class TRepository
{
	private $class; //Nome da calsse manipulada pelo repositório
	/*
	 * Método __construct()
	 * @param $class = Classe dos objectos
	 */
	function __construct($class)
	{
		$this->class = $class;
	}

	/*
	 * Método load()
	 *Recuperar um conjunto de objectos (collection) da base de dados
	 *através de um critério de seleção, e instanciá-los em memória
	 * @param $criteria = objecto do tipo TCriteria
	 */
	function load(TCriteria $criteria)
	{
		//instancia a instrução de SELECT
		$sql = new TSqlSelect;
		$sql->addColumn (' * ');
		$sql->setEntity($this->class);

		//Atribui o critério passado como paâmetro
		$sql->setCriteria($criteria);

		//Obtém transação activa
		if ($conn = TTransaction::get()) 
		{
			//Registar mensagem de log
			TTransaction::log($sql->getInstruction());

			//Executa a consulta na Base de dados
			$result = $conn->Query($sql->getInstruction());

			if ($result) 
			{
				//Percorre os resultados da consulta, retornando um objecto 
				while ($row = $result->fetchObject($this->class . 'Record'))
				{
					//Armazena no array $results
					$results [] = $row;
				}
			}

			return $results;
		}
		else
		{
			//Se não tiver transação, reorna uma exceção
			throw new Exception('Não há transação Activa!!');
			
		}
	}

	/*
	 * Método delete()
	 * Excluir um conjunto de objectos (collection) da base de dados
	 * Através de um critério de seleção
	 *@parm $criteria = objecto do tipo TCriteria
	 */
	function delete(TCriteria $criteria)
	{
		//Instanciar instrução DELETE
		$sql = new TSqlDelete;
		$sql->setEntity($this->class);

		//Atribui o critério passado como parâmetro
		$sql->setCriteria($criteria);

		//Obtém transação activa
		if ($conn = TTransaction::get()) 
		{
			//Registra mensagem de log
			TTransaction::log($sql->getInstruction());

			//Executa instrução DELETE
			$result = $conn->exec($sql->getInstruction());
			return $result;
		}
		else
		{
			//Se não tiver transação, reorna uma exceção
			throw new Exception('Não há transação activa!!');
			
		}
	}
	/*
	 * Método count()
	 * Retorna a quantidade de objectos da base de dados
	 * que satisfazem um determinado critério de seleção.
	 * @param $criteria = objecto do tipo TCriteria
	 */
	function count(TCriteria $criteria)
	{
		//Instancia a instrução SELECT
		$sql = new TSqlSelect;
		$sql->addColumn(' count(*) ');
		$sql->setEntity($this->class);

		//Atribui o critério passado como parâmetro
		$sql->setCriteria($criteria);
		//Obtém transação activa
		if ($conn = TTransaction::get()) 
		{
			//Resgistra mensagem de log
			TTransaction::log($sql->getInstruction());

			//Executa instrução SELECT
			$result = $conn->Query($sql->getInstruction());
			if ($result) 
			{
				$row = $result->fetch();
			}
			//Retornar o resultado
			return $row[0];
		}
		else
		{
			//Se não tiver transação, retorna uma exceção
			throw new Exception('Não há transação activa!!');
			
		}
	}

}
?>