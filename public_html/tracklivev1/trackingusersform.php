<?php
  // Users Form Handler
  printf("<form method='post' action='$mphpself'>");
  printf("<input type='hidden' name='main_id' value='$user_id'>");
  printf("<input type='hidden' name='ntt' value='1'>");
  printf("User Code:<input type='Text' name='login_name' value='$login_name'>");
  printf("Password     :<input type='Text' name='password' value='$password'><br>");
  printf("User Name:<input type='Text' name='name' value='$name'>");
  printf("Department:   :<input type='Text' name='branch' value='$branch'><br>");
  printf("<br>Security Permissions <br>");
  if ($readpriv){
    printf("<br><input type='checkbox' name='readpriv' value='ON' checked>Read");
  }
  else {
    printf("<br><input type='checkbox' name='readpriv' value='ON' >Read");
  }
  if ($readinsert){
    printf("<br><input type='checkbox' name='readinsert' value='ON' checked>Read Insert");
  }
  else {
    printf("<br><input type='checkbox' name='readinsert' value='ON' >Read Insert");
  }
  if ($readupdate){
    printf("<br><input type='checkbox' name='readupdate' value='ON' checked>Read Update");
  }
  else {
    printf("<br><input type='checkbox' name='readupdate' value='ON' >Read Update");
  }
  if ($deletepriv){
    printf("<br><input type='checkbox' name='deletepriv' value='ON' checked>Delete Records");
  }
  else {
    printf("<br><input type='checkbox' name='deletepriv' value='ON' >Delete Records");
  }
  if ($adminpriv){
    printf("<br><input type='checkbox' name='adminpriv' value='ON' checked>Administrator");
  }
  else {
    printf("<br><input type='checkbox' name='adminpriv' value='ON' >Administrator");
  }

  if ($seclevel > 2){
    printf("</p><input type='Submit' name='continue' value='Continue'><input type='Submit' name='submit' value='Update'>");
  }
  else {
  print("</p><input type='Submit' name='continue' value='Continue'>");
  }
    printf("</form>");
?>