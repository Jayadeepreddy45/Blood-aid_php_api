
<?php
// if(empty($_SESSION['user_id'])){
//     header('Location: login.php');
//     exit();
// }
?>
<?php include('database.php');?>

   
<?php
//header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
            $user_id = 15;
            $qery = $conn->prepare("SELECT units, reason, requested_date, status FROM patient_requests WHERE user_id = ?");
            $qery->bind_param("s", $user_id);
            $qery->execute();

            // Store the result
            $result = $qery->get_result();
            $data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
$qery->close();
echo json_encode($data);
?>


            
 