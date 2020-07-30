<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Menu</title>
    <style type="text/css">
   
    nav ul li:hover> ul
    {
        display: block;
    }
    nav ul ul
    {
        list-style: none;
    }
    nav ul li ul li:hover> li a
    {
        display: block;
    }

    nav ul li:hover
    {
        background-color: transparent;
        border-radius: 5px;
    }
    
</style>
</head>
<body>
    <div class="navbar fixed-top navbar-inverse bg-light sticky-top "  >
        <div class="row " >
            <div class="navbar-header col-md-2">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand"><img src="assets/img/pes1.png" /></a>
            </div>

            <div class="col-md-8">
               <section > 
                    <nav class="btn btn-info">
                        <ul class="nav navbar-nav" style="width: 100%">
                            <li><a href="dashboard.php">DASHBOARD</a></li>
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Categories <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-category.php">Add Category</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-categories.php">Manage Categories</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Books <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-book.php">Add Book</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-books.php">Manage Books</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Issue Books <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="issue-book.php">Issue Book to Student</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="issue-book-staff.php">Issue Book to Staff</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-issued-books.php">Manage Student Issued Books</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-issued-books-staff.php">Manage Staff Issued Books</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Registration <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Student</a></li>
                                    <ul>
                                        <li><a href="stud-reg.php">Reg Student</a></li>
                                        <li><a href="stud-manage.php">View Students</a></li>
                                    </ul>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Staff</a></li>
                                    <ul>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="staff-reg.php">Reg Staff</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="staff-manage.php">View Staff</a></li>
                                    </ul>
                                </ul>
                            </li>
                            <li><a href="includes/studentUpload.php">Add Students</a></li>                   
                            <li><a href="change-password.php">Change Password</a></li>
                        </ul>
                    </nav>
                </section>
            </div>
            
            <div class="col-md-2 right-div ">
                <a href="logout.php" class="btn btn-danger pull-right">LOG-OUT <i class="glyphicon glyphicon-log-out"></i></a>
            </div>
        </div>
    </div>
</div>

</body>
</html>


<!--<style type="text/css">
    #menu-top li{
    margin: 0 5px;
    padding: 0 0 8px;
    float: left;
    position: relative;
    list-style: none;
    }
    #menu-top a {
    display:block;
    }
    #menu-top ul li:hover a, #menu-top li:hover li a {
    background: none;
    border: none;
    color: #666;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    }
    #menu-top ul a:hover {
    background: #0399d4 !important;
    }
    #menu-top ul ul a{
    display: block;
    }
    #menu-top ul{
    display: none;
    margin: 0;
    padding: 0;
    position: absolute;
    }
    #menu-top li:hover > ul {
    display: block;
    }
    #menu-top ul li {
    float: none;
    margin: 0;
    padding: 0;
    }
    
    #menu-top ul ul:hover ul
    {
        display: block;
    }
    #menu-top {
    display: inline-block;
}
html[xmlns] #menu-top {
    display: block;
}
</style>-->

<!-- LOGO HEADER END-->
