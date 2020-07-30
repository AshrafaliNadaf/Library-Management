<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
	header('location:index.php');
}
else
{ 
    if(isset($_POST['issue']))
    {
        $studentid=strtoupper($_POST['studentid']);
        $bookid=$_POST['bookid'];
        $bid=$_POST['bookdetails'];
        $sql="INSERT INTO  tblissuedbookdetails(StudentID,BookId,bid) VALUES(:studentid,:bookid,:bookdetails)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
        $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
        $query->bindParam(':bookdetails',$bid,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId)
        {
            $_SESSION['msg']="Book issued successfully";
            header('location:manage-issued-books.php');
        }

        else 
        {
            $_SESSION['error']="Something went wrong. Please try again";
            header('location:manage-issued-books.php');
        }

    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>PESU MCA Library Management System | Issue a new Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	
	<script>
		// function for get student name
		function getstudent() 
		{
		    $("#loaderIcon").show();
		    jQuery.ajax({
		    url: "get_student.php",
		    data:'studentid='+$("#studentid").val(),
		    type: "POST",
		    success:function(data){
		    $("#get_student_name").html(data);
		    $("#loaderIcon").hide();
			},
			error:function (){}
			});
		}

		//function for book details
		function getbook() 
		{
			$("#loaderIcon").show();
			jQuery.ajax({
			url: "get_book.php",
			data:'bookid='+$("#bookid").val(),
			type: "POST",
			success:function(data){
			$("#get_book_name").html(data);
			$("#loaderIcon").hide();
			},
			error:function (){}
			});
		}

        function checkAvailability() 
        {
            $("#loaderIcon").show();
            jQuery.ajax({
            url: "check_book.php",
            data:'bookid='+$("#bookid").val(),
            type: "POST",
            success:function(data){
            $("#book-availability-status").html(data);
            $("#loaderIcon").hide();
            },
            error:function (){}
            });
        }
</script> 
	<style type="text/css">
	  .others{
	    color:red;
	}
	</style>
</head>
<body >
    <!------MENU SECTION START-->
	<?php include('includes/header.php');?>
	<!-- MENU SECTION END-->
    <div class="content-wrapper">
    <div class="container">
    <div class="row pad-botm">
    <div class="col-md-12" align="center"><h4 class="header-line">Issue a New Book</h4></div>
	</div>
	<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1" style="margin-left: 300px">
	<div class="panel panel-info">
	<div class="panel-heading">Issue a New Book</div>
	<div class="panel-body">
	<form role="form" method="post">
		<div class="form-group">
		<label>Student Id<span style="color:red;">*</span></label>
		<div></div>
		<?php
		    $host = "localhost";
		    $user = "root";
		    $password = "";
		    $dbname = "library";
		    $con = new mysqli($host, $user, $password, $dbname);
		    $result=mysqli_query($con,"SELECT * from tblstudents ");
		    echo "<center>";
		    echo "<select class='form-control' name='studentid' id='studentid' onBlur='getstudent()' autocomplete='off' required='required'>>";
	        echo "<option>";
	        echo "</option>";
		    while($row=mysqli_fetch_array($result))
		    {
		        echo "<option>$row[StudentId]</option>";
		    }
		    echo "</select>";
		    echo "</center>";
		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
		<script>
		    $("#searchddl").chosen();
		</script>
		</div>

		<div class="form-group">
		<span><label><b>Student Name :</b></label></span>
		<select  class="form-control" name="studentdetails" id="get_student_name" readonly></select>
 		</div>

		<div class="form-group">
		<label>Access Number<span style="color:red;">*</span></label>
		<!--    
		    <input class="form-control" type="text" name="booikid" id="bookid" onBlur="getbook()"  required="required" />
		-->
		<?php
		    $result=mysqli_query($con,"select * from tblbooks");
		    echo "<center>";
		    echo "<select class='form-control' name='bookid' id='bookid'  onBlur='getbook();checkAvailability()' autocomplete='off' required='required'>";
		    echo "<option>";
		    echo "</option>";
		    while($row=mysqli_fetch_array($result))
		    {
		        echo "<option>$row[ISBNNumber]</option>";
		    }
		    echo "</select>";
		    echo "</center>";
		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
		<script>
		    $("#searchddll").chosen();
		</script>
		</div>
		<span id="book-availability-status" style="font-size:12px;"></span> 
		
		<div class="form-group">
		<span><label><b>Book Name :</b></label></span>
		<select  class="form-control" name="bookdetails" id="get_book_name" readonly></select>
 		</div>
		<button type="submit" name="issue" id="submit" class="btn btn-info">Issue Book </button>
		<a href="dashboard.php" class="btn btn-danger btn-dm" role="button" aria-pressed="true" tabindex=-1>Cancel</a>
	</form>
	</div>
	</div>
	</div>
	</div>   
	</div>
	</div>
    <!-- CONTENT-WRAPPER SECTION END-->
  	<?php include('includes/footer.php');?>
     <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>