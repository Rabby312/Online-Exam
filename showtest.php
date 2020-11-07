<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--this is show test page for online exam -->
<html>
<head>
<title>Online Quiz - Test List</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="quiz.css" rel="stylesheet" type="text/css">
<style>
.head1{
	color:red;
	text-align: center;
	
}
</style>
</head>
<body>
<?php
include("header.php");
include("database.php");
include("navigation1.php");
extract($_GET);
$sql1="select * from mst_subject where sub_id=$subid";
$rs1=mysqli_query($con,$sql1);
$row1=mysqli_fetch_array($rs1);
echo "<h1 align=center><font color=blue> $row1[1]</font></h1>";
$sql2="select * from mst_test where sub_id=$subid";
$rs=mysqli_query($con,$sql2);
if(mysqli_num_rows($rs)<1)
{
	echo "<br><br><h2 class=head1> No Exam for this Subject </h2>";
	exit;
}
echo "<h2 class=head1> Select Topic Name to Give Exam </h2>";
echo "<table align=center>";

while($row=mysqli_fetch_row($rs))
{
	echo "<tr><td align=center ><a href=quiz.php?testid=$row[0]&subid=$subid><font size=4>$row[2]</font></a>";
}
echo "</table>";
?>
</body>
</html>
