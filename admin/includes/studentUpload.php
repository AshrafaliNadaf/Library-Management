<!DOCTYPE html>
<html>
<head>
	<title>Excel Uploading PHP</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>


<div class="container">
	<center>
		<h1>Upload Student List from Excel File</h1>
			<form method="POST" action="excelUpload.php" enctype="multipart/form-data">
				<div class="form-group">
					<label>Upload Students List</label>
					<input type="file" name="file" class="form-control" style="width: 30%">
				</div>

				<div class="form-group">
					<button type="submit" name="Submit" class="btn btn-success">Upload</button>
					<a href="/l/admin/dashboard.php" class="btn btn-danger btn-dm" role="button" aria-pressed="true">Cancel</a>
				</div>
			</form>
	</center>
</div>


</body>
</html>