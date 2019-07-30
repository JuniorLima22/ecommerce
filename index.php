<?php 

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {
   
  //Chama o metodo __construct e carrega o header
	$page = new Page();

	//Adiciona o arquivo que tem o H1 hello (index.html)
	$page->setTpl("index");

	//Aqui acaba a execução, e o PHP limpa a memoria e chama o método __destruction e carrega o footer
});

//Rota para page admin
$app->get('/admin', function() {
   
	$page = new PageAdmin();

	$page->setTpl("index");

	//Aqui acaba a execução, e o PHP limpa a memoria e chama o método __destruction e carrega o footer
});

$app->run();

 ?>