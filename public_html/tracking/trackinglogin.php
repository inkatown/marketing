<?php
/* Attention this is NOT open source software and is protected under 
the copyright act. Copyright (c) 2003 J.Quijano Hacix Inc.
Licensee: Nutrophy Inc.
*/

// Login
if ($_POST['Submit']){
  // Process Login
  include("trackingdbsec.php");
  $login_name=$_POST['login_name'];
  $password=$_POST['password'];
  $db=mysql_connect("$dbhost","$dbuser","$dbpassword") or die ("NO CONNECTION");
  mysql_select_db("$dbasename",$db) or die ("INVALID DATA BASE");
  $sql="SELECT * FROM users WHERE login_name='$login_name'";
  $result=mysql_query($sql,$db) or die ("INVALID QUERY");
  if (mysql_num_rows($result) > 0) {
    // Validate Password
    $myrow=mysql_fetch_array($result);
    if ($password==$myrow["password"]){
      // login ok set cookie redirect to set cookie
      $username=$myrow["name"];
      header("Location: trackingsetcookie.php?login_name=$login_name&username=$username");
    }
    else {
      die ("NOT AUTHORIZED");
    }
  }
  else {
    die ("NOT AUTHORIZED");
  }  
}

include("trackingcommoninc.php");
sendtitle("Login");
?>
<p>
<p>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
  <p>&nbsp;</p>
  <div align="center">
    <center>
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber1" width="292">
      <tr>
        <td width="227"><font face="Verdana" size="2"><b>Login Name:</b></font></td>
        <td width="65"><input type="text" name="login_name" size="20"></td>
      </tr>
      <tr>
        <td width="227"><font face="Verdana" size="2"><b>Password:</b></font></td>
        <td width="65"><input type="password" name="password" size="20"></td>
      </tr>
    </table>
    </center>
  </div>
  <p align="center"><input type="submit" value="Submit" name="Submit"><input type="reset" value="Reset" name="B2"></p>
</form>

<?php
  endhtml();
?>
