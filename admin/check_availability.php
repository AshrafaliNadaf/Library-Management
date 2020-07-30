<?php 
require_once("includes/config.php");
// code user email availablity

	if(isset($_POST['emailId'])) 
	{
		$email= $_POST['emailId'];
		if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) 
		{

			echo "<span style='color:red'>Note! : Not valid E-mail.</span>";
		}
		else 
		{
			$sql ="SELECT EmailId FROM tblstudents WHERE EmailId=:emailId";
			$query= $dbh -> prepare($sql);
			$query-> bindParam(':emailId', $email, PDO::PARAM_STR);
			$query-> execute();
			//$results = $query -> fetchAll(PDO::FETCH_OBJ);
			$cnt=1;
			if($query -> rowCount() > 0)
			{
			echo "<span style='color:red'> Email already exists .</span>";
			 //echo "<script>$('#submit').prop('disabled',true);</script>";
			} 
			else
			{
		
				echo "<span style='color:green'> Email available for Registration .</span>";
	 			//echo "<script>$('#submit').prop('disabled',true);</script>";
			}
		}
	}
	else
	{
		echo "<span style='color:red'><b>Note:</b> Please provice Email</span>";
	}

/*	$host="localhost";
	$username="root";
	$pass="";
	$db="library";

	$conn=mysqli_connect($host,$username,$pass,$db) or die("Connection Failed");

	if(isset($_POST['email']) & !empty($POST['email']))
	{
		$email=mysqli_real_escape_string($conn,$_POST['email'])
		$sql="select * from tblstudents where EmailId="$email"";
		$result=mysqli_query($conn,$sql);
		$count=mysqli_num_rows($result);
		if($count>0)
		{
			echo "<div style=color:'red'>".$email." not available</div>";

		}
		else
		{
			echo "<div style=color:'green'>".$email." available"";
		}

	}
*/	
?>
