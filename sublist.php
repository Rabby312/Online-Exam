<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Online Quiz - Quiz List</title>
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
echo "<h2 class=head1> Select Subject to Give Exam </h2>";
$sql="select * from mst_subject";
$rs=mysqli_query($con,$sql);
echo "<table align=center>";
while($row=mysqli_fetch_row($rs))
{
	echo "<tr><td align=center ><a href=showtest.php?subid=$row[0]><font size=4>$row[1]</font></a>";
}
echo "</table>";
?>
</body>
</html>