<?php
namespace Classes\Model;

use \Classes\Model\Dbconn;

class IncomeModel {


	private $database;

	public function __construct()
	{
		// $this->database = new Dbconn;
	}

	public function getSalaryType()
	{

		$dbConn = new Dbconn;
		$connection = $dbConn->connect();

		$query="SELECT * FROM salary_type";

		$sth = $connection->prepare($query);
    	$sth->execute();
    	return  $sth->fetchAll(\PDO::FETCH_ASSOC);
  		
	}
}