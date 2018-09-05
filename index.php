<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Exam</title>
    <link rel="stylesheet" href="style.css">
    <style>
      *{
        box-sizing: border-box;
      }
      .header
      {
        background-color:midnightblue;
        color:chartreuse;
        padding: 20px;
        text-align: center;
      }
      
      .column {
        float: left;
        width: 50%;
        padding: 15px;
      }
      .row:after {
        content: "";
        display: table;
        clear: both;
      }
      @media screen and (max-width:600px) {
        .column {
          width: 100%;
        }
      }
      .footer {
        background-color: midnightblue;
        color:chartreuse;
        padding: 10px;
        text-align: center;
        position: fixed;
        left:0;
        bottom:0;
        width:100%;
        
      }
      .errors {

         color: #FF0000;
         font-weight: bold;
        }
      
      input[type=text],input[type=password], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
      }

      input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      input[type=submit]:hover {
        background-color: #45a049;
      }

      /*div {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
      }*/
    </style>

    <style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #4CAF50;
}
</style>

  </head>
  <body>

    <?php
    include("header.php");
    include("database.php");
    include("navigation.php");
    //$login_idErr=$passwordErr=" ";
    //$login_id=$password=" ";
    extract($_POST);
    if(isset($submit))
    {
      $sql="select * from mst_user where login='$loginid' and pass='$pass'";
      $result=mysqli_query($con,$sql);
      if(mysqli_num_rows($result)<1)
      {
        $found="N";
      }
      else
      {
        $_SESSION["login"]=$loginid;
      }
    }

   if (isset($_SESSION["login"]))
{
echo "<h1 class='style8' align=center>Welcome to Online Exam</h1>";
    echo '<table width="28%"  border="0" align="center">
  <tr>
    <td style="font-size:25px;" width="93%" valign="bottom" bordercolor="#0000FF"> <a href="sublist.php" class="style4">Subject for Exam </a></td>
  </tr>
  <tr>
    <td style="font-size:25px;"valign="bottom"> <a href="result.php" class="style4">Result </a></td>
  </tr>
</table>';
   
    exit;
    

}
    ?>
   <!-- <div>
    <ul>
  <li><a class="active" href="index.php">Home</a></li>
  <li><a href="#about">About</a></li>
  <li><a href="#news">Signup</a></li>
  <li><a href="#contact">Login</a></li>
  <li><a href="#about">Subject</a></li>
  <li><a href="#about">Result</a></li>
  <li><a href="#about">Logout</a></li>
</ul>
</div>-->
    <div class="row">
      <div class="column">
        <h2>Welcome to Our Online Exam</h2>
        <p>This Site will provide the sample test for various subject of interest. You need to login for the take the online exam.</p>
      </div>
      <div class="column">
        <h2>Login Form</h2>
        <form name="form1" method="post" action="login.php">
          <label for="loginid">Login ID</label>
          <input type="text" id="loginid" name="loginid" placeholder="Enter Your Login ID..">

          <label for="password">Password</label>
          <input type="password" id="pass" name="pass" placeholder="Enter Your password..">
          <span class="errors"> 
            <?php
            if(isset($found))
            {
              echo "Invalid username or password";
            } 
            ?>
          </span>
          <input type="submit" name="submit" id="submit" value="Login">
          <span class="psw">New User ? <a href="signup.php">Sign Up Free</a></span>
        </form>
      </div>
    </div>
    <div class="footer">
      <p>Copyright@ Rabby 2010 to 2018</p>
    </div>
  </body>
</html>
