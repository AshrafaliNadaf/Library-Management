<?php 
require_once("includes/config.php");
// code user email availablity

	if(!empty($_POST["bookid"])) 
	{
			$bookid= $_POST["bookid"];
	
		
			$sql ="SELECT BookId FROM tblissuedbookdetails WHERE BookId=:bookid";
			$query= $dbh -> prepare($sql);
			$query-> bindParam(':bookid', $bookid, PDO::PARAM_STR);
			$query-> execute();
			$results = $query -> fetchAll(PDO::FETCH_OBJ);
			$cnt=1;
			if($query -> rowCount() > 0)
			{
			echo "<span style='color:red'> Book already exists .</span>";
			 //echo "<script>$('#submit').prop('disabled',true);</script>";
			} 
			else
			{
		
				echo "<span style='color:green'> Book available for Issue .</span>";
	 			//echo "<script>$('#submit').prop('disabled',true);</script>";
			}
		
	}
	
?>
