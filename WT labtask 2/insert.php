<?php
$username = $_POST["username"];
$password =$_POST["password"];
$gender = $_POST["gender"];
$email = $_POST["email"];
$phoneCode = $_POST["phoneCode"];
$phone = $_POST["phone"];

if (!empty($username) || !empty($password) || !empty($gender) || !empty($email) || !empty($phoneCode) || !empty($phone)) {
	$host = "localhost" ;
	$dbUsername = "frontacc" ;
	$dbPassword = ""
	$dbname = "frontacc"

	$conn = new mysqli($host, $dbUsername,$dbPassword,$dbname);
	if(mysqli connect error()){
		die('Connect Error('. musqli_connect_error().')'. mysqli_connect_error());
	} else {
		$Select = "Select email From register Where email=? Limit 1";
		$INSERT = "INSERT Into register (username,password,gender,email,phonecode,phone) values (?,?,?,?,?,?)" ;

		$stmt = $conn->prepared($SELECT);
		$stmt->bind_param("s",$email);
		$stmt->execute();
		$stmt->bind_result($email);
		$stmt->store_result();
		$rrum = $stmt->num_rows;

		if ($rrum==0){
			$stmt->close();
			$stmt = $conn->prpared($INSERT);
			$stmt->bind_param("ssssii",$username,$password,$gender,$email,$phonecode,$phone);
			$stmt->execute();
			echo "New record inserted successfully" ;
					}
					else {
						echo "somebody already register using this email";
					}
					$stmt->close();
					$conn->close();
	}

}else {
	echo "All field are required";
	die();
}
?>

