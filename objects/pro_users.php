<?php
class Pro_users{

	// database connection and table name
	private $conn;
	private $table_name = "Pro_users";

	// subcribed user properties
	public $userSerialNo;
	public $proSerialNo;
	public $pacSerialNo;
	public $useAge;
	public $subExpaired;
	public $offerSerialNo;

	
	// constructor with $db as database connection
	public function __construct($db){
		$this->conn = $db;
	}
	
	// read users
	function read(){
	// select all query
	$query = "SELECT
				userSerialNo, proSerialNo, pacSerialNo, useAge, subExpaired, offerSerialNo
			FROM
				" . $this->table_name . " ORDER BY userSerialNo ASC";
	// prepare query statement
	$stmt = $this->conn->prepare($query);
	// execute query
	$stmt->execute();
	return $stmt;
}




	// view use
	function useAge($user, $product, $package){
	
	// select product 
	$query = "SELECT
				useAge, offerSerialNo, subExpaired
			FROM
				" . $this->table_name . " WHERE userSerialNo = ? AND proSerialNo = ? AND pacSerialNo = ?";
	
	// prepare query statement
	$stmt = $this->conn->prepare($query);
	
	$stmt->bindParam(1, $user);
	$stmt->bindParam(2, $product);
	$stmt->bindParam(3, $package);
	
	// execute query
	$stmt->execute();

	return $stmt;
}

	// add use
	function addUseAge($user, $product, $package, $newuse){
	// select all query
	$query = "UPDATE " . $this->table_name . " SET useAge = useAge + ? WHERE userSerialNo = ? AND proSerialNo = ? AND pacSerialNo = ?";
				
	// prepare query statement
	$stmt = $this->conn->prepare($query);
	
	$stmt->bindParam(1, $newuse);
	$stmt->bindParam(2, $user);
	$stmt->bindParam(3, $product);
	$stmt->bindParam(4, $package);
	
	// execute query
	$stmt->execute();

	return $stmt;
}


	
	// adding pro user
	function adduser(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                userSerialNo=:userSerial, proSerialNo=:proSerial, pacSerialNo=:pacSerial, useAge=:useAge, , subExpaired=:expaired, offerSerialNo=:offerSerial";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
	
    // sanitize
    $this->userSerialNo=htmlspecialchars(strip_tags($this->userSerialNo));
	$this->proSerialNo=htmlspecialchars(strip_tags($this->proSerialNo));
	$this->pacSerialNo=htmlspecialchars(strip_tags($this->pacSerialNo));
    $this->useAge=htmlspecialchars(strip_tags($this->useAge));
	$this->subExpaired=htmlspecialchars(strip_tags($this->subExpaired));
    $this->offerSerialNo=htmlspecialchars(strip_tags($this->offerSerialNo));
	
	// bind values
    $stmt->bindParam(":userSerial", $this->userSerialNo);
	$stmt->bindParam(":proSerial", $this->proSerialNo);
	$stmt->bindParam(":pacSerial", $this->pacSerialNo);
    $stmt->bindParam(":useAge", $this->useAge);
	$stmt->bindParam(":expaired", $this->subExpaired);
    $stmt->bindParam(":offerSerial", $this->offerSerialNo);
	
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
	
	
}