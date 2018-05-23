<?php
// <!-- Will Add all the customer's Database Parameters here using php data objects(PDO)-->
      class db{
      //Adding Database Parameters
      	private $dbhost = 'localhost';
      	private $dbuser = 'root';
      	private $dbpassword = '';
      	private $dbname = 'slimapi';

      	//Connecting to Database using object oriented php
      	public function connect(){
      		$mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
      		$dbConnection = new PDO($mysql_connect_str,$this->dbuser,$this->dbpassword);

      		//Incase of error reporting in Database
      		$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      		return $dbConnection;
      	}

      }

    
