<?php include('database.php'); ?>

<?php
//header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$request_id = 7;
$status = "pending";
$update_query = mysqli_query($conn, "UPDATE patient_requests SET status = '$status' WHERE request_id = $request_id");

if ($update_query) {
    $select_query = $conn->prepare("SELECT patient_requests.units, user.blood_group 
                                            FROM patient_requests 
                                            INNER JOIN user ON user.user_id = patient_requests.user_id 
                                            WHERE request_id = ?");
    $select_query->bind_param("s", $request_id);
    $select_query->execute();
    $result = $select_query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $bloodgroup = $row["blood_group"];
        $units_requested = $row["units"];

        if ($status == "accepted") {
            // Decrease the blood stock
            $update_stock = $conn->prepare("UPDATE blood_stock SET units = units - ? WHERE bloodgroup = ?");
            $update_stock->bind_param("is", $units_requested, $bloodgroup);
            $update_stock->execute();


        } else if ($status == 'rejected') {

        }
    }
}

?>

<?php
// Fetch patient requests from the database
$qery = $conn->prepare("SELECT request_id, username, blood_group, units, reason, requested_date, phone_number, status 
                                    FROM user 
                                    JOIN patient_requests ON user.user_id = patient_requests.user_id");
$qery->execute();
$result = $qery->get_result();
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
$qery->close();
echo json_encode($data);
?>

