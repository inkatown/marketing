<?php

/* Attention this is NOT open source software and is protected under 
the copyright act. Copyright (c) 2003 J.Quijano Hacix Inc.
Licensee: Nutrophy Inc.
*/


  // Security Functions
  function checkcookie($cname){
    $cvalue=$_COOKIE['sid'];
    if ($cvalue){
      return $cvalue;
    }
    else {
      return "";
    }
  }

  function getsecurity(){
    // returns security level 
    $cvalue=checkcookie("sid");
    if ($cvalue){
      include("trackingdbsec.php");
      $db=mysql_connect("$dbhost","$dbuser","$dbpassword") or die ("NO CONNECTION");
      mysql_select_db("$dbasename",$db) or die ("INVALID DATA BASE");  
      // Get session record
      $sql="SELECT * FROM sessions WHERE session_id='$cvalue'";
      $result=mysql_query($sql,$db) or die ("INVALID QUERY");
      if (mysql_num_rows($result) < 1) {
        // session expired
        die ("NOT AUTHORIZED TO PERFORM THIS OPERATION");
      }
      else {
        $myrow=mysql_fetch_array($result);
        $login_name=$myrow["master_user"];
        $sql="SELECT * FROM users WHERE login_name='$login_name'";
        $result=mysql_query($sql,$db) or die ("INVALID QUERY");
        if (mysql_num_rows($result) > 0) {
          // Validate Password
          $myrow=mysql_fetch_array($result);
          $cread=$myrow["readpriv"];
          $creadinsert=$myrow["readinsert"];
          $creadupdate=$myrow["readupdate"];
          $cdelete=$myrow["deletepriv"];
          $cadmin=$myrow["adminpriv"];
          if ($cadmin){
            return 5;
          }
          if ($cdelete) {
           return 4;
          }
          if ($readupdate){
            return 3;
          }
          if ($readinsert){
            return 2;
          }
          return 1;
        }
      }
    }
    else {
      die ("NOT AUTHORIZED TO PERFORM THIS OPERATION");
    }
  }

?>