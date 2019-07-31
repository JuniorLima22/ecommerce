<?php
namespace Hcode;

class Model {

	//$value terá todos os valores dos campos nosso objeto 
	private $values = [];

	//Toda vez que um metodo for chamado
	public function __call($name, $args){
		//Detecta o nome set ou get, se for GET retorna a informação se for SET iremos Setar a informação
		$method = substr($name, 0, 3);

		//Descobre o nome do campo quando chamado
		$fieldName = substr($name, 3, strlen($name));

		// teste para visualizar
		// var_dump($method, $fieldName);
		// exit;

		switch ($method) {
			case 'get':
				return $this->values[$fieldName];
				break;

			case 'set':
				return $this->values[$fieldName] = $args[0];
				break;
		}

	}

	//Metodo para Getteres e Setteres dinamico
	public function setData($data = array()){

		foreach ($data as $key => $value) {
			$this->{"set". $key}($value);
		}
	}

	//Retorna o atributo de values
	public function getValues(){
		return $this->values;
	}

}
?>