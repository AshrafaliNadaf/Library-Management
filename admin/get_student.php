<?php 
require_once("includes/config.php");
if(!empty($_POST["studentid"])) 
{
	$studentid=strtoupper($_POST["studentid"]);
	$sql ="SELECT FullName,id FROM tblstudents WHERE StudentId=:studentid";
	$query= $dbh -> prepare($sql);
	$query-> bindParam(':studentid', $studentid, PDO::PARAM_STR);
	$query-> execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ);
	$cnt=1;
	if($query -> rowCount() > 0)
	{
		foreach ($results as $result)
		{?>
			<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->FullName);?></option>
			<?php  
			echo htmlentities($result->FullName);
			echo "<script>$('#submit').prop('disabled',false);</script>";
		}
	}
 	else
 	{
	  	echo "<span style='color:red'> Invaid Student Id. Please Enter Valid Student id .</span>";
	 	echo "<script>$('#submit').prop('disabled',true);</script>";
	}
}
?>