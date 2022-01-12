<?php 

class Connection {
	private $server = 'localhost';
	private $username = 'root';
	private $password = '';
	private $dbName = 'cafe';
	public $conn;


	public function connect(){
		$this->conn = mysqli_connect($this->server, $this->username, $this->password, $this->dbName);
		return $this->conn;
	}
}
