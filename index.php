<?php 
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;

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

	//Valida se usuario está logado
	User::verifyLogin();
   
	$page = new PageAdmin();

	$page->setTpl("index");

	//Aqui acaba a execução, e o PHP limpa a memoria e chama o método __destruction e carrega o footer
});

//Rota page login admin
$app->get('/admin/login', function(){
	$page = new PageAdmin([
	//Desabilitar o header e footer
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login");
});

$app->post('/admin/login', function(){
	//Valida login
	User::login($_POST["login"], $_POST["password"]);

	header("Location: /admin");
	exit();
});

//Rota Logout
$app->get('/admin/logout', function(){

	User::logout();

	header("Location: /admin/login");
	exit;
});

$app->run();

 ?>