<?php
    include('database.php');
    if(isset($_POST['submit'])){
        $units = $_POST['units'];
        $Disease = $_POST['disease'];
        $Donateddate = $_POST['donated_date'];
        $userid = $_SESSION["user_id"];
        $qery = mysqli_query($conn ,"INSERT into donation(user_id,units,disease,donated_date) VALUES($userid,'$units','$Disease','$Donateddate')");

        if($qery){
            echo '<div class="alert alert-success" role="alert">
            Donation request sucessful!
            </div>';

        } else{
            echo  '<div class="alert alert-danger" role="alert">
            Donation request failed!
            </div>';
        }

    }
    ?>




