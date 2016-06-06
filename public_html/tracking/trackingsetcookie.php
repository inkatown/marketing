<?php
/* Attention this is NOT open source software and is protected under 
the copyright act. Copyright (c) 2003 J.Quijano Hacix Inc.
Licensee: Nutrophy Inc.
*/

if (!headers_sent()){
  $sid=$_COOKIE["sid"];
  if (!$sid){
    $stamp = strtotime ("now");
    $raddr=$_SERVER['REMOTE_ADDR'];
    $sessid = "$stamp-$raddr";
    $sessid = str_replace(".", "", "$sessid");
    setCookie("sid",$sessid);
    // Create session
    include("trackingdbsec.php");
    $login_name=$_GET['login_name'];
    $db=mysql_connect("$dbhost","$dbuser","$dbpassword") or die ("NO CONNECTION");
    mysql_select_db("$dbasename",$db) or die ("INVALID DATA BASE");
    $sql=  "INSERT INTO sessions SET session_no=NULL, session_id='$sessid', master_user='$login_name', session_time='$stamp'";
    $result=mysql_query($sql,$db) or die ("INVALID QUERY");   
  }
  printf("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\" >");
  $username=$_GET['username'];
  echo ("WELCOME $username, You can proceed with the main menu");
}
else {
  echo ("COOKIE HEADERS ALREADY SENT");
}

?>