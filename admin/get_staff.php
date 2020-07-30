<?php 
require_once("includes/config.php");
if(!empty($_POST["EmpId"])) 
{
	$EmpId= strtoupper($_POST["EmpId"]);
	$sql ="SELECT FullName FROM tblstaff WHERE EmpId=:EmpId";
	$query= $dbh -> prepare($sql);
	$query-> bindParam(':EmpId', $EmpId, PDO::PARAM_STR);
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
	 echo "<span style='color:red'> Invaid Staff Id. Please Enter Valid Staff id .</span>";
	 echo "<script>$('#submit').prop('disabled',true);</script>";
	}
}
?>