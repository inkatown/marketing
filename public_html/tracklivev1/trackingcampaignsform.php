<?php
  // Campaigns Form Handler
  printf("<form method='post' action='$mphpself'>");
  printf("<input type='hidden' name='main_id' value='$c_id'>");
  printf("<input type='hidden' name='ntt' value='2'>");
  printf("<table><tr><td>Campaign Code:</td><td><input type='Text' name='c_code' value='$c_code'></td></tr>");
  printf("<tr><td>Name         :</td><td><input type='Text' name='c_name' value='$c_name'></td></tr>");
  printf("<tr><td>Salesman     :</td><td><input type='Text' name='salesman' value='$salesman'></td></tr>");
  printf("<tr><td> Reports :</td><td><p><a href='trendstats.php?c_id=$c_id'><img border='0' src='images/reports.jpg' width='56' height='54'></a></p>     </td></tr>");

//  printf("Beg Date:   :<input type='Text' name='beg_date' value='$beg_date'><br>");
//  printf("End Date:   :<input type='Text' name='end_date' value='$end_date'><br>");

  if ($seclevel > 2){
    printf("<tr><td></p><input type='Submit' name='continue' value='Continue'><input type='Submit' name='submit' value='Update'></td></tr>");
  }
  else {
  print("<tr><td></p><input type='Submit' name='continue' value='Continue'></td></tr>");
  }

    printf("</form>");
?>