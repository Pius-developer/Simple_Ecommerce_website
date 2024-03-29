<?php

class CreatDb 
{

  public $servername;
  public $username;
  public $password;
  public $dbname;
  public $tablename;
  public $conn;



// class constructor

public function __construct(

	$dbname = "Newdb",
	$tablename = "Productdb",
	$servername = "Localhost",
	$username = "root",
	$password = ""
	
)
{

	// initialising my class

	$this ->dbname = $dbname;
    $this ->tablename = $tablename;
	$this ->servername = $servername;
	$this ->username = $username;
	$this ->password = $password;
   


    // creating my connection

    $this ->conn = mysqli_connect($servername, $username, $password);

    // check connection

    if(!$this ->conn){

    	die("Connection Failed:" . mysql_connect_error());
    }

    // QUERY DATABASE

    $sql = "CREATE DATABASE IF NOT EXISTS $dbname ";

    // EXECUTE QUERY

    if (mysqli_query($this->conn, $sql)) {
    	
    	$this->conn = mysqli_connect($servername,$username,$password,$dbname);

    	// sql to create table 

    	$sql = "CREATE TABLE IF NOT EXISTS $tablename
    	(id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    	    product_name VARCHAR(255) NOT NULL,
    	    product_price FLOAT,
    	    product_img VARCHAR(100)

         );";

    	if (!mysqli_query($this->conn, $sql)) {
    		
    		echo "Error creating table:" . mysqli_error($this->conn);
    	}
    }else{

    	return false;
    }

}

// Get products from database

public function getData(){

	$sql = "SELECT * FROM $this->tablename";

	$result = mysqli_query($this->conn, $sql);

	if (mysqli_num_rows($result) > 0 ) {
		
		return $result;
	}
}

}

?>
