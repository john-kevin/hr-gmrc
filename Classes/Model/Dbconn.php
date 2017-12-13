<?php 

namespace Classes\Model;

class Dbconn{


	CONST env = 'local';

	private $config;
	private $host;
	private $password;
	private $dbname;
	private $user;
	private $database;



	public function __construct()
	{

		$this->config   = require_once('Config/application.config.php');
		$this->database = $this->config['database'][self::env];
		$this->host     = $this->database['host'];
		$this->user     = $this->database['username'];
		$this->password = $this->database['password'];
		$this->dbname   = $this->database['dbName'];
	}

	public function connect()
	{

		try {
            $dbcon = new \PDO('mysql:host='.$this->host.'; dbname='.$this->dbname, $this->user, $this->password);  
            $dbcon->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
            $dbcon->exec("SET CHARACTER SET utf8");  //  return all sql requests as UTF-8  
    
            return $dbcon;
        } catch(\Exeption $e) {
            die( $e->getMessage() );
            return;
        }
	}
}