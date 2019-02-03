<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

// include database and object files
include_once '../config/database.php';
include_once '../objects/pro_users.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$pro_users = new Pro_users($db);

// please apply post later
if($_SERVER['REQUEST_METHOD'] == 'GET') {
$user_serial =  isset($_GET['user_serial']) ? $_GET['user_serial'] : null;
$pro_serial = isset($_GET['pro_serial']) ? $_GET['pro_serial'] : null;
$pac_serial = isset($_GET['pac_serial']) ? $_GET['pac_serial'] : null;
$pro_use = isset($_GET['pro_use']) ? $_GET['pro_use'] : null;
}

/*
// get posted data
$data = json_decode(file_get_contents("php://input"));
// set user property values
$user_serial = $data->user_serial;
$pro_serial = $data->pro_serial;
$pac_serial = $data->pac_serial;
$pro_use = $data->pro_use;
*/

if($user_serial == null || $pro_serial == null || $pac_serial == null || $pro_use == null) $status = "failed";
else {
	$stmt = $pro_users->addUseAge($user_serial, $pro_serial, $pac_serial, $pro_use); 
	if($stmt) $status = "success";
	else $status = "failed";
}

echo json_encode(array("response" => $status));

?>