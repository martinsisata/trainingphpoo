<?php
/*Classe TTransaction
Esta Class provê os métodos necessário para manipulação de Transações
*/
final class TTransaction 
{
  private static $conn;   // Conexão Activa
  private static $logger; // Objecto LOG

  /*
  Método __construct
  Esta Declara como private para não intanciar a Class TTransaction
  */
  private function __construct () {}
  /*
  Método open()
  Abre uma Transação e um conexão ao Banco de Dados
  */

  public static function open($database)
  {
    //Abre uma conexão Armazenada na propriedade estática $conn
    if (empty(self::$conn)) 
    {
      self::$conn = TConnection::open($database);
      //Inicia a transação
      self::$conn -> beginTransaction();
      //Desliga o log de SQL
      self::$logger = NULL;
    }
  }
  /*
  Método get()
  Retorna a conexão activa da transação
  */
  public static function get()
  {
    //Retorna a Conexão activa
    return self::$conn;
  }
  /* 
  Método roollback()
  Desfaz todas a operações feitas na transações
  */
  public static function rollback()
  {
    if (self::$conn) 
    {
        //Desfaz operações realizadas pela transação
        self::$conn -> rollback();
        $conn = NULL;
    }
  }
  /*
  Método close()
  Aplicar todas as aplicações realizadas e fechar
  */

  public static function close()
  {
    if (self::$conn) {
      //Aplica as operações realizada durante a operação
      self::$conn -> commit();
      self::$conn = NULL;
    }
  }
  /*
  Método setLogger()
  Define qul estratégia (Algoritimo de LOG será usado)
  */
  public static function setLogger(TLogger $logger)
  {
    self::$logger = $logger;
  }
  /*
  Método log()
  Armazena uma mensagem no arquivo log
  Baseada na estratégia ($logger) actual
  */
  public static function log($message)
  {
    //Verifica se exixte um logger
    if (self::$logger) 
    {
      self::$logger -> write($message);
    }
  }
}


?>