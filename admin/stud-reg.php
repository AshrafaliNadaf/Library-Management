<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['signup']))
{
               
    $count_my_page = ("studentid.txt");
    $hits = file($count_my_page);
    $hits[0] ++;
    $fp = fopen($count_my_page , "w");
    fputs($fp , "$hits[0]");
    fclose($fp); 
    $StudentId= $_POST['StudentId']; 
    $fullname=$_POST['fullname'];
    $mobileno=$_POST['mobileno'];
    $emailId=$_POST['emailId']; 
    $status=1;
    $sql="INSERT INTO  tblstudents (StudentId,FullName,MobileNumber,EmailId) VALUES(:StudentId,:fullname,:mobileno,:emailId)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':StudentId',$StudentId,PDO::PARAM_STR);
    $query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
    $query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
    $query->bindParam(':emailId',$emailId,PDO::PARAM_STR);
    //$query->bindParam(':password',$password,PDO::PARAM_STR);
    //$query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
     echo '<script>alert("Your Registration successfull and your SRN is  "+"'.$StudentId.'")</script>';
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
    <title>PESU MCA Library Management System | Student Signup</title>
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
            url: "check_availability.php",
            data:'emailId='+$("#emailId").val(),
            type: "POST",
            success:function(data){
            $("#user-availability-status").html(data);
            $("#loaderIcon").hide();
            },
            error:function (){}
            });
        }

        /*function check()
        {
            if(($("#StudentId").val()=="") || ($("#fullname").val()=="") || ($("#emailid").val()=="") || ($("#mobileno").val()=="") )
            {
                $("#submit").prop('disabled', true);

            }
            else
            {
                $("#submit").prop('disabled', false);

            }
        }*/
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
    <h4 class="header-line" style="text-align: center;">Student Registration</h4></div>
    </div>
    <div class="row">    
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">      
    <!-- <div class="col-md-9 col-md-offset-1"> -->
    <div class="panel panel-info">
    <div class="panel-heading">STUDENT REGISTRATION FORM
    </div>
    <div class="panel-body">
    <form name="signup" method="post" onSubmit="return valid();">
        <div class="form-group">
        <label>Enter SRN</label><span style="color:red"><b>&nbsp*<b></span>
        <input class="form-control" type="text" id="StudentId" name="StudentId" maxlength="13" autocomplete="off" pattern="^[P][E][S][0-9]+" placeholder="e.g : PES10123456789" required />
        </div>

        <div class="form-group">
        <label>Enter Full Name</label><span style="color:red"><b>&nbsp*<b></span>
        <input class="form-control" type="text" id="fullname" name="fullname" autocomplete="off" required />
        </div>

        <div class="form-group">
        <label>Enter Email</label><span style="color:red"><b>&nbsp*<b></span>
        <input class="form-control" type="email" name="emailId" id="emailId" onblur="checkAvailability()"  autocomplete="off" required />
        <span id="user-availability-status" style="font-size:12px;"></span> 
        </div>

        <div class="form-group">
        <label>Mobile Number </label><span style="color:red"><b>&nbsp*<b></span>
        <input class="form-control" type="text" id="mobileno" name="mobileno" maxlength="10" autocomplete="off" required onkeypress="return mask(this,event)" onBlur="check()" />
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
