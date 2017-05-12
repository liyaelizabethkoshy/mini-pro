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
   color: white;
   font-size: 70px;
   text-align: center;
   font-weight: 900;
}
a{
color: white;
text-transform: capitalize;
font-size: 20px;
    
}
body {
    background-image: url("f.jpg");
}
table {
    border-collapse: collapse;
    width: 50%;
    background-color:black;
    left:25%;
    top:50%;
    position:relative;
    height:100px;
    margin-top:-150px;
    outline:1px solid;
   
}

th, td {
    padding: 8px;
    text-align: center;
    border-bottom: 1px solid black;
}

tr:hover{background-color:#80beab;}
</style>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="w.html">FIND MY RESTAURANT</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="w.html">Home</a></li>
      <li><a href="w2.html">SEARCH</a></li>
    </ul>
  </div>
</nav>
<h1>HAVE A LOOK</h1>
<?php

session_start();
$item = $_POST["DISHNAME"];
$city = $_POST["location"];
$item = str_replace(' ','_',$item);
$address = $city; 
$prepAddr = str_replace(' ','+',$address);
$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
$output= json_decode($geocode);
$latitude = $output->results[0]->geometry->location->lat;
$longitude = $output->results[0]->geometry->location->lng;
$command = escapeshellcmd("python2 task.py ".$item." ". $latitude." ". $longitude);
$output = shell_exec($command);
$myString = $output;
$myArray = explode(',', $myString);
echo "<html><body><div><table>";
foreach($myArray as $val)
{
 $val=trim($val);
 $v = str_replace( array( '\'', '"', ',' ,'_', ';', '[', ']' ), ' ', $val);
 echo "<tr><td><a href=hope2.php?idn=$val>$v</a></td></tr><br>";
}

echo "</table></div></body><html>";
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");

?>

</body>
</html>
