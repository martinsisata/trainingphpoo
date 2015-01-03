<?php
//Carregar as classes necessárias 
include_once 'app.ado/TExpression.class.php';
include_once 'app.ado/TCriteria.class.php';
include_once 'app.ado/TFilter.class.php';

//Criar um Objecto
$criteria = new TCriteria;
$criteria -> add(new TFilter('idade','<','16'), TExpression::OR_OPERATOR);
$criteria -> add(new TFilter('idade','>','60'), TExpression::OR_OPERATOR);
echo $criteria -> dump();
echo "<br>";
$criteria = new TCriteria;
$criteria -> add(new TFilter('idade', 'IN', array(24,25,26)));
$criteria -> add (new TFilter('idade', 'NOT IN', array(10)));
echo $criteria -> dump();
?>