<?php
class User {
	private $name;
	private $pass;

	public function __construct($name, $pass) {
		$this->name = $name;
		$this->pass = $pass;
	}

	public function login() {
		Database::connect();
		$users = new Dbobject("users");
		$items = $users->query_many("name", $this->name);
		Database::disconnect();
		if (empty($items) || $items[0]["password"] != $this->pass) {
			return false;
		} else {
			return (int)$items[0]["access"];
		}
	}

	public function register() {
		Database::connect();
		$users = new Dbobject("users");
		$arr1 = ["name", "password", "access"];
		$arr2 = [$this->name, $this->pass, 1];
		$users->insert($arr1, $arr2);
		Database::disconnect();
	}
}
?>