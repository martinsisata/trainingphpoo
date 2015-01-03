<?php
//Carregar as classes necessárias 
include_once 'app.ado/TExpression.class.php';
include_once 'app.ado/TFilter.class.php';

//Crie um filtro por data(String)
$filter1 = new TFilter('data','=','26-06-1989');
echo $filter1 -> dump();
?>