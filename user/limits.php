<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

// include database and object files
include_once '../config/database.php';
include_once '../objects/pro_users.php';
include_once '../objects/packages.php';
include_once '../objects/offers.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$pro_users = new Pro_users($db);
$packages = new Packages($db);
$offers = new Offers($db);

// please apply post later
if($_SERVER['REQUEST_METHOD'] == 'GET') {
$user_serial =  isset($_GET['user_serial']) ? $_GET['user_serial'] : null;
$pro_serial = isset($_GET['pro_serial']) ? $_GET['pro_serial'] : null;
$pac_serial = isset($_GET['pac_serial']) ? $_GET['pac_serial'] : null;
}

/*
// get posted data
$data = json_decode(file_get_contents("php://input"));
// set user property values
$user_serial = $data->user_serial;
$pro_serial = $data->pro_serial;
$pac_serial = $data->pac_serial;
*/

	$status = "failed";
	// user array
	$sub_arr=array();
	$sub_arr["sub"]=array();
	$sub_info= null; 

$pac_limit = null;	
$stmt_pac = $packages->pacLimit($pro_serial, $pac_serial);
$num_pac = $stmt_pac->rowCount();
if($num_pac > 0){
	while ($row_pac = $stmt_pac->fetch(PDO::FETCH_ASSOC)){	
		$pac_limit = $row_pac['pacLimit'];
	}
}	

$stmt = $pro_users->useAge($user_serial, $pro_serial, $pac_serial); // need to pass parameter 
$num = $stmt->rowCount();

$offer_serial = null;
if($num > 0 && $pac_limit != null){
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){	
		$use_age = $row['useAge'];
		$offer_serial = $row['offerSerialNo'];
		$subExpaired = $row['subExpaired'];
	}	
}

if($offer_serial != null){
	$stmt_off = $offers->offerLimit($offer_serial);
	$num_off = $stmt_off->rowCount();
	
	if($num_off > 0){
		while ($row_off = $stmt_off->fetch(PDO::FETCH_ASSOC)){	
			$offer_limit = $row_off['offerLimit'];
		}
		
		$status = "ok";
		$remainLimits = ($pac_limit + $pac_limit * $offer_limit / 100) - $use_age;
		$sub_info=array(
			"remainLimits" => $remainLimits,
			"expairedDate" => $subExpaired
		);
	}
}
	
array_push($sub_arr["sub"], $sub_info);

echo json_encode(array("response" => $status ,"sub" => $sub_arr["sub"]));

?>