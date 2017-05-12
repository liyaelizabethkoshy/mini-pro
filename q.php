<?php 

$command = escapeshellcmd('python2 task2.py veg_burger vyttila');
$output = shell_exec($command);
$myfile = fopen("ab.txt","r") or die("sorry");
echo fread($myfile,filesize("ab.txt"));
fclose($myfile);
echo $output;

?>

