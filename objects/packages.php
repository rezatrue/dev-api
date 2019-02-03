<?php
class Packages{

	// database connection and table name
	private $conn;
	private $table_name = "packages";

	// subcribed user properties
	public $proSerialNo;
	public $pacSerialNo;
	public $pacName;
	public $pacPrice;
	public $pacLimit;
	
	// constructor with $db as database connection
	public function __construct($db){
		$this->conn = $db;
	}
	
	// add use
	function pacLimit($pro_serial, $pac_serial){
	// select all query
	$query = "SELECT
				pacLimit
			FROM
				" . $this->table_name . " WHERE proSerialNo = ? AND pacSerialNo = ?";
				
	// prepare query statement
	$stmt = $this->conn->prepare($query);
	
	$stmt->bindParam(1, $pro_serial);
	$stmt->bindParam(2, $pac_serial);
	// execute query
	$stmt->execute();

	return $stmt;
}


	
	
}