<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

// include database and object files
include_once '../config/database.php';
include_once '../objects/sub_users.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$user = new Sub_users($db);


// please apply post later
if($_SERVER['REQUEST_METHOD'] == 'GET') {
$user_email =  isset($_GET['user_email']) ? $_GET['user_email'] : null;
$user_password = isset($_GET['user_password']) ? $_GET['user_password'] : null;
}

/*
// get posted data
$data = json_decode(file_get_contents("php://input"));
// set user property values
$user_email = $data->user_email;
$user_password = $data->user_password;
*/

// query user
$stmt = $user->login($user_email, $user_password); // need to pass parameter
$num = $stmt->rowCount();

	$status = "failed";
// user array
	$user_arr=array();
	$user_arr["user"]=array();
	$user_info= null; 
	
// check if more than 0 record found
if($num > 0){
	
	// retrieve our table contents
	// fetch() is faster than fetchAll()
	// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){	
		
		$serialNo = $row['userSerialNo'];
		$name = $row['userName'];
		
		$user_info=array(
			"serialNo" => $serialNo,
			"name" => $name
		);
	}
	if($name != null) 
		$status = "ok";	
}
	
array_push($user_arr["user"], $user_info);

echo json_encode(array("response" => $status ,"user" => $user_arr["user"]));

?>