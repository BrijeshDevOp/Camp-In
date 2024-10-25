<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if(isset($_POST['name'])) 
	{
		$otp = $_POST['name'];
		session_start();
		$dbPath = __DIR__.'/../Assets/db/database.php';
        require $dbPath;
		$email=$_SESSION['EMAIL'];
		$res=mysqli_query($conn,"select * from user where email='$email' and otp='$otp'");
		$count=mysqli_num_rows($res);
			if($count>0)
			{
				mysqli_query($conn,"update user set otp='' where email='$email'");
				$_SESSION['IS_LOGIN']=$email;
				echo "yes";
			}
			else
			{
				echo "not_exist";
			}
	} 
	else 
	{
		echo "Name parameter not found in the request.";
	}
	  // Get the value of the "name" parameter from the URL
}

?>