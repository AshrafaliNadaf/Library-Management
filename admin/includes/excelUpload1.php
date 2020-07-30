<?php


require('library/php-excel-reader/excel_reader2.php');
require('library/SpreadsheetReader.php');
require('db_config.php');


if(isset($_POST['Submit'])){


  $mimes = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet'];
  if(in_array($_FILES["file"]["type"],$mimes)){


    $uploadFilePath = 'uploads/'.basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);


    $Reader = new SpreadsheetReader($uploadFilePath);


    $totalSheet = count($Reader->sheets());


    echo "You have total ".$totalSheet." sheets".


    $html="<table border='1'>";
    $html.="<tr><th>Category</th><th>Acc No</th><th>Title</th><th>Author</th><th>Edition</th><th>Publisher</th></tr>";


    /* For Loop for all sheets */
    for($i=0;$i<$totalSheet;$i++){


      $Reader->ChangeSheet($i);


      foreach ($Reader as $Row)
      {
        $html.="<tr>";
        $a = isset($Row[0]) ? $Row[0] : '';
        $b = isset($Row[1]) ? $Row[1] : '';
        $c = isset($Row[2]) ? $Row[2] : '';
        $d = isset($Row[3]) ? $Row[3] : '';
        $e = isset($Row[4]) ? $Row[4] : '';
        $f = isset($Row[5]) ? $Row[5] : '';
        $g = isset($Row[6]) ? $Row[6] : '';
        $html.="<td>".$a."</td>";
        $html.="<td>".$b."</td>";
        $html.="<td>".$c."</td>";
        $html.="<td>".$d."</td>";
        $html.="<td>".$e."</td>";
        $html.="<td>".$f."</td>";
        $html.="<td>".$g."</td>";

        $html.="</tr>";


        $query = "insert into lib(a,b,c,d,e,f,g) values('".$a."','".$b."','".$c."','".$d."','".$e."','".$f."','".$g."')";


        $mysqli->query($query);
       }


    }


    $html.="</table>";
    echo $html;
    echo "<br />Data Inserted in dababase";


  }else { 
    die("<br/>Sorry, File type is not allowed. Only Excel file."); 
  }


}


?>