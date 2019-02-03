<?php
class Offers{

	// database connection and table name
	private $conn;
	private $table_name = "offers";

	// subcribed user properties
	public $offerSerialNo;
	public $offerPrice;
	public $offerLimit;
	public $offerDescription;
	
	// constructor with $db as database connection
	public function __construct($db){
		$this->conn = $db;
	}
	
	// add use
	function offerLimit($offer_serial){
	// select all query
	$query = "SELECT
				offerLimit
			FROM
				" . $this->table_name . " WHERE offerSerialNo = ?";
				
	// prepare query statement
	$stmt = $this->conn->prepare($query);
	
	$stmt->bindParam(1, $offer_serial);
	// execute query
	$stmt->execute();

	return $stmt;
}


	
	
}