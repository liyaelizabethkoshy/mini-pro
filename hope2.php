<!DOCTYPE html>
<html lan="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>FIND MY RESTAURENT </title>
  
<style>

h1{
  color: black;
   font-size: 70px;
   text-align: center;
   font-weight: 900;}
body {
    background-image: url("i.jpg");
}

table {
  border-collapse: collapse;
    width: 50%;
    background-color:black;
    left:25%;
    top:50%;
    position:relative;
    height:50px;
    margin-top:60px;
    outline:1px solid;
    
   }

tr{
 height: 20px;
}
th, td {
    padding: 8px;
    text-align: center;
     color:white;
     font-weight: 900;
      font-size: 30px;
     text-transform: capitalize;
    
}

tr:hover{background-color:#0a4c51;}
</style>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="w.html">Find My Restaurant</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="w.html">Home</a></li>
      <li><a href="w2.html">Search</a></li>
   
    </ul>
  </div>
</nav>
<h1>MENU</h1>
<?php
$name=$_REQUEST["idn"];
$val=$name;
$title = str_replace( array( '\'', '"', ',' , ';', '[', ']' ), ' ', $val);
$link = mysql_connect('localhost', 'root', '')
    or die('Could not connect: ' . mysql_error());
mysql_select_db('project') or die('Could not select database');

$p=trim($title);
$query = "SELECT rcode FROM res where rname='$p'";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

    foreach ($line as $col_value) {
     $s=$col_value;

    }
}
$s=trim($s);
$num=(int)$s;
$query = "SELECT item FROM MENU where rcod=$num";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());

while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
echo "<html><body><table>";
 foreach ($line as $col_value) {
     $col_value = str_replace('_',' ',$col_value);
     echo "<tr><td>$col_value</td></tr>";
    
 
    }
echo "</table></body><html>";

}


mysql_free_result($result);


mysql_close($link);
?>

</body>
</html>
