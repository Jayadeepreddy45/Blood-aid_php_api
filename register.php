
<?php
include('database.php');
//header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$data = array(
    "address" => "erfrsfr",
    "blood_group" => "A+",
    "city" => "fsrfrs",
    "dob" => "05-12-2004",
    "password" => "123",
    "phone_number" => "12316231",
    "pincode" => "12312",
    "state" => "dgrgrer",
    "username" => "jay"
    
);
echo json_encode($data);
?>
