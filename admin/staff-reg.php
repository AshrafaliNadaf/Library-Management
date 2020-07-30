<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['signup']))
{
    $count_my_page = ("staffid.txt");
    $hits = file($count_my_page);
    $hits[0] ++;
    $fp = fopen($count_my_page , "w");
    fputs($fp , "$hits[0]");
    fclose($fp); 
    $empid= $_POST['eid']; 
    $fname=$_POST['fullanme'];
    $mobileno=$_POST['mobileno'];
    $emailId=$_POST['emailId']; 
    $stream=$_POST['stream']; 
    //$password=md5($_POST['password']); 
    //$status=1;
    $sql="INSERT INTO  tblstaff(EmpId,FullName,Mobile,Email,Stream) VALUES(:empid,:fname,:mobileno,:emailId,:stream)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':empid',$empid,PDO::PARAM_STR);
    $query->bindParam(':fname',$fname,PDO::PARAM_STR);
    $query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
    $query->bindParam(':emailId',$emailId,PDO::PARAM_STR);
    //$query->bindParam(':password',$password,PDO::PARAM_STR);
    $query->bindParam(':stream',$stream,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
     echo '<script>alert("Your Registration successfull and Your Staff ID is  "+"'.$empid.'")</script>';
    }
    else 
    {
     echo "<script>alert('Something went wrong. Please try again');</script>";
    }
}
//}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>PESU MCA Library Management System | Staff Reg</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script type="text/javascript">
        function valid()
        {
            if(document.signup.password.value!= document.signup.confirmpassword.value)
            {
                alert("Password and Confirm Password Field do not match  !!");
                document.signup.confirmpassword.focus();
                return false;
            }
        return true;
        }
    </script>
    <script>
        function checkAvailability() 
        {
            $("#loaderIcon").show();
            jQuery.ajax({
            url: "check_availability_staff.php",
            data:'emailId='+$("#emailId").val(),
            type: "POST",
            success:function(data){
            $("#user-availability-status").html(data);
            $("#loaderIcon").hide();
            },
            error:function (){}
            });

        }
        function mask(textbox, e)
        {
            var c =(e.which)? e.which: e.keyCode;
            if(c==46 || c>31 && (c<48 || c>57))
            {
                alert("only numbers allowed");
                return false;
            }
            else 
                {return true;}
        }
    </script>    
</head>
<body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php');?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
    <div class="container">
    <div class="row pad-botm">
    <div class="col-md-12">
    <h4 class="header-line" style="text-align: center;">Staff Registration</h4></div>
    </div>
    <div class="row">          
    <!-- <div class="col-md-9 col-md-offset-1"> -->
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
    <div class="panel panel-info">
    <div class="panel-heading">STAFF REGISTRATION FORM</div>
    <div class="panel-body">

    <form name="signup" method="post" onSubmit="return valid();">

        <div class="form-group">
        <label>Enter Employee ID</label><span style="color:red"><b>&nbsp*<b></span>
        <input class="form-control" type="text" name="eid" maxlength="13" autocomplete="off" required />
        </div>

        <div class="form-group">
        <label>Enter Full Name</label><span style="color:red"><b>&nbsp*<b></span>
        <input class="form-control" type="text" name="fullanme" autocomplete="off" required />
        </div>

        <div class="form-group">
        <label>Mobile Number </label><span style="color:red"><b>&nbsp*<b></span>
        <input class="form-control" type="text" name="mobileno" maxlength="10" autocomplete="off" required
        onkeypress="return mask(this,event)" />
        </div>
                                        
        <div class="form-group">
        <label>Enter Email</label><span style="color:red"><b>&nbsp*<b></span>
        <input class="form-control" type="email" name="emailId" id="emailId" onblur="checkAvailability()"  autocomplete="off" required  />
        <span id="user-availability-status" style="font-size:12px;"></span> 
        </div>

        <div class="form-group">
        <label>Enter Stream </label><span style="color:red"><b>&nbsp*<b></span>
        <input class="form-control" type="text" name="stream" autocomplete="off" required />
        </div>
               
        <button type="submit" name="signup" class="btn btn-info" id="submit">Register Now </button>
        <a href="dashboard.php" class="btn btn-danger btn-dm" role="button" aria-pressed="true">Cancel</a>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
