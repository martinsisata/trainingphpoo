<?php 
/* Classe TRecord
Esta classe provê os métodos necessário para persistir e 
recuparar objectos da base de dados (Active Record)
*/
abstract class TRecord 
{
	protected $data; //Array contendo os dados do objecto

	/* Método contrutor
	Instancia um Active Record. Se passado o $id, já carrega o objecto
	$id = Objecto id
	*/

	public function __Construct($id = NULL)
	{
		if($id) //Se existir ID
		{
			//carrega o objecto correspondente
			$objecto = $this-> load($id);
			if ($objecto)
			{
				$this->fromArray($objecto->toArray());
			}
		}
	}

	/*Método __clone()
	Executando quando o objecto for clonado
	limpa o ID para que seja gerado um novo ID para clone.
	*/

	public function __clone()
	{
		unset($this->id);
	}

	/*Método __set()
	Executado sempre que uma propriedade for atribuida.
	*/

	public function __set($prop, $value)
	{
		//Verifica se existe método set <propriedade>
		if (method_exists($this, 'set_'.$prop))
		{
			//executa o método set <proprieadde>
			call_user_func(array($this,'set_'.$prop, $value));
		}
		else
		{
			//Atribuir valor a propriedade
			$this->data[$prop] = $value;
		}
	}
	/*
	Método __get ()
	executa sempre que um apropriedade for requerida
	*/

	public function __get($prop)
	{
		//Verifica se existe método get_ <propriedade>
		if (method_exists($this, 'get_'.$prop))
		{
			//executa o método get_ <proprieadde>
			call_user_func(array($this,'get_'.$prop));
		}
		else
		{
			//retorna o valor da propriedade
			return $this-> data[$prop];
		}
	}
	/*Método getEntity()
	retornao nome da entidade 
	*/
	public function getEntity()
	{
		//Obter o nome da classe
		$classe = strtolower(get_class($this));
		//Retornar o nome da classe
		return substr($classe, 0, -6);
	}

	/*
	Método fromArray
	preenche os dados do objecto com um array
	*/

	public function fromArray($data)
	{
		$this -> data = $data;
	}

	/*Método toArray
	Retornar os dados do bjecto com array
	*/

	public function toArray()
	{
		return $this->data;
	}

	/*
	Método store()
	Armazena o objecto na base de dados e retorna
	O Número de linhas afectadas pela instrução SQL (zero ou um)
	*/

	public function store()
	{
		//Verifica se tem ID ou se existe na base de dados
		if (empty($this->data['id']) or (!$this->load($this->id))) 
		{
			//Incrementa o ID
			$this->id = $this->getLast() +1;
			//Criar uma Instrução de insert
			$sql = new TSqlInsert;
			$sql = setEntity($this->getEntity());
			//Percorre os dados do objceto
			foreach ($this->data as $key => $value)
			{
				//Passa os dados do objecto para o SQL
				$sql -> setRowData($key, $this->$key);
			}
		}
		else
		{
			//Inicia a instrução update
			$sql = new TSqlUpdate;
			$sql->setEntity($this->getEntity());
			//cria um critério de seleção baseado no ID
			$criteria = new TCriteria;
			$criteria -> add(new TFilter('id', '=', $this->id));
			$sql->setCriteria ($criteria);
			//percorre os dados do objecto
			foreach ($this-> data as $key => $value)
			{
				if ($key !== 'id') //o ID não precisa ir no UPDATE
				 {
					//Passa os dados do objecto para o SQL
					$sql->setRowDAta ($key, $this->$key);
				}
			}
		}
		//Obtém transação activa
		if ($conn = TTransaction::get()) 
		{
			//Faz o log e executa o SQL
			TTransaction::log($sql->getInstruction());
			$result = $conn ->exec($sql->getInstruction);
			//Retorna o Resultado
			return $result;

		}
		else
		{
			//Se não tiver transação, retorna uma exceção
			throw new Exception('Não há transação activa!!');
			
		}

	}

	/*
	método load()
	recupera (retorna) um objecto da base de dados
	através de seu ID e instancia ele na memória
	@param $id = ID do objecto
	*/

	public function load($id)
	{
		//Instanciar a instrução SELECT
		$sql = new TSqlSelect;
		$sql->setEntity($this->getEntity());
		$sql -> addColumn ('*');

		//cria critério de seleção baseado no ID
		$criteria = new TCriteria;
		$criteria -> add(new TFilter('id','=',$id));
		//define o critério de seleção de dados
		$sql -> setCriteria($criteria);
		//Obter Transação activa
		if ($conn = TTransaction::get()) 
		{
			//Cria mensagem de log e executa a consulta
			TTransaction::log ($sql->getInstruction());
			$result = $conn->Query($sql->getInstruction());
			//Se retornaou algum dados
			if ($result) 
			{
				//restorna os dados em forma de Objecto
				$object = $result->fetchObject(get_class($this));
			}
			return $object;
		}
		else
		{
			//Se não tiver transação, retorna uma exceção
			throw new Exception('Não há transação activa!!');
			
		}
	}
	/*
	méttodo delete ()
	exclui um objecto da base de dados através de seu ID.
	@param $id = ID do objecto
	*/
	public function delete ($id = NULL)
	{
		//O ID é o parâmetro ou a propriedade ID
		$id = $id ? $id : $this->id;
		//Instacia uma instrução de delete 
		$sql = new TSqlDelete;
		$sql -> setEntity($this->getEntity());

		//Cria critério de seleção de dados
		$criteria = new TCriteria;
		$criteria ->add(new TFilter('id','=',$id));
		//define o critério de seleção baseado no ID
		$sql->setCriteria($criteria);

		//Obtém transação activa
		if ($conn= TTransaction::get()) 
		{
			//faz o log e executa o SQL
			TTransaction::log($sql->getInstruction());
			$result = $conn->exec($sql->getInstruction());
			//Retorna o resultado
			return $result;
		}
		else
		{
			//Se não tiver transação, retorna uma exceção 
			throw new Exception('Não há transação activa');
		}
	}
	/*
	Método getLast()
	retorna o último ID
	*/

	private function getLast()
	{
		//Inicia a instrução
		if ($conn = TTransaction::get()) 
		{
			//Instacia instrução de SELECT
			$sql = new TSqlSelect;
			$sql -> addColumn('max(ID) as ID');
			$sql-> setEntity($this->getEntity());
			//cria log e executa instrução SQL
			TTransaction::log($sql->getInstruction());
			$result = $conn->Query($sql->getInstruction());
			//restorna os dados do banco
			$row = $result->fetch();
			return $row [0];
		}
		else
		{
			//Se não tiver transação, reorna uma exceção
			throw new Exception('Não há transação activa!!');
			
		}
	}
}


 ?>
