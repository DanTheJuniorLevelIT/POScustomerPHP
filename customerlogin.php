<?php
	include 'cusconn.php';
	$postdata= file_get_contents("php://input");
	$request = json_decode($postdata);
	
	$query = "SELECT CustID, Firstname FROM customer WHERE Email = '$request->use' AND Password = sha2('$request->pas',224)";
	$result = $conn->query($query);
	
	if($result){
		$row = $result->fetch_object();
	}else{
		$row=0;
	}
	
	echo json_encode($row);
?>