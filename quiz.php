<?php
// this is quiz page for user
session_start();
include("database.php");
extract($_POST);
extract($_GET);
extract($_SESSION);
global $submit,$tid,$login;
/*$rs=mysql_query("select * from mst_question where test_id=$tid",$cn) or die(mysql_error());
if($_SESSION[qn]>mysql_num_rows($rs))
{
unset($_SESSION[qn]);
exit;
}*/
if(isset($subid) && isset($testid))
{
$_SESSION[sid]=$subid;
$_SESSION[tid]=$testid;
header("location:quiz.php");
}
if(!isset($_SESSION[sid]) || !isset($_SESSION['tid']))
{
	header("location: index.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Online Quiz</title>
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
include("navigation1.php");

$query="select * from mst_question";
$sql="select * from mst_question where test_id='$tid'";
$rs=mysqli_query($con,$sql) or die(mysqli_error($con));
if(!isset($_SESSION['qn']))
{
	$_SESSION['qn']=0;
	$sql5="delete from mst_useranswer where sess_id='" . session_id() ."'";
	mysqli_query($con,$sql5) or die(mysqli_error($con));
	$_SESSION['trueans']=0;
	
}
else
{	
		if($submit=='Next Question' && isset($ans))
		{
				mysqli_data_seek($rs,$_SESSION['qn']);
				$row= mysqli_fetch_row($rs);
				$sql2="insert into mst_useranswer(sess_id, test_id, que_des, ans1,ans2,ans3,ans4,true_ans,your_ans) values ('".session_id()."', '$tid','$row[2]','$row[3]','$row[4]','$row[5]', '$row[6]','$row[7]','$ans')";
				mysqli_query($con,$sql2) or die(mysqli_error($con));
				if($ans==$row[7])
				{
							$_SESSION['trueans']=$_SESSION['trueans']+1;
				}
				$_SESSION['qn']=$_SESSION['qn']+1;
		}
		else if($submit=='Get Result' && isset($ans))
		{
				mysqli_data_seek($rs,$_SESSION['qn']);
				$row= mysqli_fetch_row($rs);
				$sql3="insert into mst_useranswer(sess_id, test_id, que_des, ans1,ans2,ans3,ans4,true_ans,your_ans) values ('".session_id()."', '$tid','$row[2]','$row[3]','$row[4]','$row[5]', '$row[6]','$row[7]','$ans')";
				mysqli_query($con,$sql3) or die(mysqli_error($con));
				if($ans==$row[7])
				{
							$_SESSION['trueans']=$_SESSION['trueans']+1;
				}
				echo "<h1 class=head1> Result</h1>";
				$_SESSION['qn']=$_SESSION['qn']+1;
				echo "<Table align=center><tr class=tot><td>Total Question<td> $_SESSION[qn]";
				echo "<tr class=tans><td>True Answer<td>".$_SESSION['trueans'];
				$w=$_SESSION['qn']-$_SESSION['trueans'];
				echo "<tr class=fans><td>Wrong Answer<td> ". $w;
				echo "</table>";
				$sql4="insert into mst_result(login,test_id,test_date,score) values('$login','$tid','".date("d/m/Y")."',$_SESSION[trueans])";
				mysqli_query($con,$sql4) or die(mysqli_error($con));
				echo "<h1 align=center><a href=review.php> Review Question</a> </h1>";
				unset($_SESSION['qn']);
				unset($_SESSION[sid]);
				unset($_SESSION['tid']);
				unset($_SESSION['trueans']);
				exit;
		}
}
/*$sql1="select * from mst_question where test_id='$tid'";
$rs=mysqli_query($con,$sql1) or die(mysqli_error($con));
if($_SESSION['qn']>mysqli_num_rows($rs)-1)
{
unset($_SESSION['qn']);
echo "<h1 class=head1>Some Error  Occured</h1>";
session_destroy();
echo "Please <a href=index.php> Start Again</a>";

exit;
}*/
mysqli_data_seek($rs,$_SESSION['qn']);
$row= mysqli_fetch_row($rs);
echo "<form name=myfm method=post action=quiz.php>";
echo "<table width=100%> <tr> <td width=30>&nbsp;<td> <table border=0>";
$n=$_SESSION['qn']+1;
echo "<tR><td><span class=style2>Que ".  $n .": $row[2]</style>";
echo "<tr><td class=style8><input type=radio name=ans value=1>$row[3]";
echo "<tr><td class=style8> <input type=radio name=ans value=2>$row[4]";
echo "<tr><td class=style8><input type=radio name=ans value=3>$row[5]";
echo "<tr><td class=style8><input type=radio name=ans value=4>$row[6]";

if($_SESSION['qn']<mysqli_num_rows($rs)-1)
echo "<tr><td><input type=submit name=submit value='Next Question'></form>";
else
echo "<tr><td><input type=submit name=submit value='Get Result'></form>";
echo "</table></table>";
?>
</body>
</html>
