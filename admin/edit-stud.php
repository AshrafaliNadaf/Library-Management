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
    if(isset($_POST['update']))
    {
        $sid=intval($_GET['sid']);
        $name=$_POST['name'];
        $stdid=$_POST['stdid'];
        $email=$_POST['email'];
        $mobile=$_POST['mobile'];
        $sql="UPDATE  tblstudents set FullName=:name,StudentId=:stdid,EmailId=:email,MobileNumber=:mobile where id=:sid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sid',$sid,PDO::PARAM_STR);
        $query->bindParam(':name',$name,PDO::PARAM_STR);
        $query->bindParam(':stdid',$stdid,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
        $query->execute();
        $_SESSION['updatemsg']="Student info updated successfully";
        header('location:stud-manage.php');
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>PESU MCA Library Management System | Edit Student</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php');?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
    <div class="container">
    <div class="row pad-botm">
    <div class="col-md-12">
    <h4 class="header-line" style="text-align: center;">Edit Student</h4></div>
    </div>
    <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
    <div class="panel panel-info">
    <div class="panel-heading">Student Info</div>
    <div class="panel-body">
    <form role="form" method="post">
        <?php 
        $sid=intval($_GET['sid']);
        $sql = "SELECT StudentId,FullName,EmailId,MobileNumber from  tblstudents where id=:sid";
        $query = $dbh -> prepare($sql);
        $query->bindParam(':sid',$sid,PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        if($query->rowCount() > 0)
        {
            foreach($results as $result)
            {?>   
                <div class="form-group">
                <label>SRN<span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="stdid" value="<?php echo htmlentities($result->StudentId);?>" required />
                </div>

                <div class="form-group">
                <label>Student Name<span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="name" value="<?php echo htmlentities($result->FullName);?>" required />
                </div>

                <div class="form-group">
                <label>Email<span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="email" value="<?php echo htmlentities($result->EmailId);?>" required />
                </div>

                <div class="form-group">
                <label>Mobile Number<span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="mobile" value="<?php echo htmlentities($result->MobileNumber);?>" required maxlength=10/>
                </div>
    <?php }} ?>
    <button type="submit" name="update" class="btn btn-info">Update </button>
    <a href="stud-manage.php" class="btn btn-danger btn-dm" role="button" aria-pressed="true">Cancel</a>
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