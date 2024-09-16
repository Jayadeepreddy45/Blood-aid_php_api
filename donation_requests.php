<?php include('database.php'); ?>


<?php
//header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$donation_id = 18;
$status = "pending";
$update_query = mysqli_query($conn, "UPDATE donation SET status = '$status' WHERE donation_id = $donation_id");

if ($update_query) {
    $select_query = $conn->prepare("SELECT donation.units, user.blood_group 
                                            FROM donation 
                                            INNER JOIN user ON user.user_id = donation.user_id 
                                            WHERE donation_id = ?");
    $select_query->bind_param("s", $donation_id);
    $select_query->execute();
    $result = $select_query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $bloodgroup = $row["blood_group"];
        $units_donated = $row["units"];

        if ($status == "accepted") {
            // Increase the blood stock
            $update_stock = $conn->prepare("UPDATE blood_stock SET units = units + ? WHERE bloodgroup = ?");
            $update_stock->bind_param("is", $units_donated, $bloodgroup);
            $update_stock->execute();


        } else if ($status == 'rejected') {

        }
    }
}

?>
<?php
// Fetch donation requests from the database
$qery = $conn->prepare("SELECT donation_id, username, blood_group, units, disease, donated_date, phone_number, status 
                                    FROM user 
                                    JOIN donation ON user.user_id = donation.user_id");
$qery->execute();
$result = $qery->get_result();
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
$qery->close();
echo json_encode($data);
?>