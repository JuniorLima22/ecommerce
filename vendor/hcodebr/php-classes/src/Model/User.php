<?php
namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class User extends Model {

	const SESSION = "User";

	public static function login($login, $password){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
			":LOGIN"=>$login
		));

		//Valida se encontra algo
		if (count($results) === 0) {
			throw new \Exception("Usuário inexistente ou senha inválida.");
			
		}

		$data = $results[0];

		//Verifica a senha do usuario
		if (password_verify($password, $data["despassword"]) === true) {
			$user = new User();

			// Getteres e Setteres dinamico com metodo magico na class Model.php
			$user->setData($data);

			//Teste para Visualiza objeto instanciado
			// $user->setiduser($data["iduser"]);
			// var_dump($user);
			// exit;

			//Se tudo ok depois da validação de login retorna os dados do usuario logado
			$_SESSION[User::SESSION] = $user->getValues();
			return $user;

		}else{
			throw new \Exception("Usuário inexistente ou senha inválida.");
		}
		
	}

	//Valida se usuario está logado ou não
	public static function verifyLogin($inadmin = true){
		if (
				!isset($_SESSION[User::SESSION])
				||
				!$_SESSION[User::SESSION]
				||
				!(int)$_SESSION[User::SESSION]["iduser"] > 0
				||
				(bool)$_SESSION[User::SESSION]["inadmin"] !== $inadmin
		) {
				header("Location: /admin/login");
				exit;
		}
	}

	//Logout
	public static function logout(){
		$_SESSION[User::SESSION] = NULL;
	}

} //End: class User extends Model
?>