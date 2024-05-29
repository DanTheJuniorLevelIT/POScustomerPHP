<?php
    include 'cusconn.php';

    $uid = $_POST['uid'];
    $imgurl = "http://localhost/customer/image/";

    $response = new stdClass();
    if(!empty($_FILES['files'])){
        $path = $_FILES['files']['name'];
        $expname = explode('.',$path);
        $newpath = $expname[0].$uid.".".$expname[1];
        $ext = pathinfo($newpath, PATHINFO_EXTENSION);
            $targetDir = "./image/";
            $targetFilePath = $targetDir . $newpath;

        if(move_uploaded_file($_FILES["files"]["tmp_name"], $targetFilePath)){
            $query = "UPDATE customer SET Profilepic='$newpath' WHERE CustID='$uid'";
            // if($result = $conn->query($query)){
            //     $query = "SELECT UserID, Lastname, Firstname, Role, DATE_FORMAT(Birthdate, '%M %e, %Y') AS FormattedBirthdate, Contact, Address,  CONCAT('$imgurl', profilepic) as img FROM user WHERE UserID = '$uid'";

            //     $result = $conn->query($query);

            //     if ($result->num_rows > 0) { 
            //         $customerData = $customerResult->fetch_assoc();
            //     } else {
            //         $customerData = ['error' => 'No customer found.'];
            //     }
            // }else{
            //     $customerData = "0";
            // }
            $result = $conn->query($query);
            if($result){
                $data = "Success";
            } else {
                $data = "Error";
            }
        }
    }

    echo json_encode($data);
?>