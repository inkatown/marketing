<?php
  // Campaigns Form Handler
  printf("<form method='post' action='$mphpself'>");
  printf("<input type='hidden' name='main_id' value='$url_id'>");
  printf("<input type='hidden' name='ntt' value='3'>");
  printf("<table><tr><td>Campaign Name:</td><td><select size='1' name='c_code'>");
  // Print Campaigns 
  $mquery="SELECT * from campaigns ORDER BY c_code";
  $result = mysql_query($mquery,$db) or die ("Invalid Query: $mquery");
  while ($myrow = mysql_fetch_array($result)) {
    $mc_code=$myrow['c_code'];
    $mc_name=$myrow['c_name'];
    if ($mc_code == $c_code){
      printf("<option value='$mc_code' SELECTED>$mc_name</option>");
    }
    else {
      printf("<option value='$mc_code'>$mc_name</option>");
    }
  }  
  printf("</td></tr>");        
  printf("<tr><td>Url          :</td><td><input type='Text' size=60 name='url' value='$url'></td></tr>");
  printf("<tr><td>Tag          :</td><td><input type='Text' name='url_tag' value='$url_tag'></td></tr>");
  printf("<tr><td>Page Name    :</td><td><input type='Text' name='url_page_name' value='$url_page_name'></td></tr>");

  if ($seclevel > 2){
    printf("<tr><td><input type='Submit' name='continue' value='Continue'><input type='Submit' name='submit' value='Update'></td></tr>");
  }
  else {
  print("<tr><td><input type='Submit' name='continue' value='Continue'></td></tr>");
  }
    printf("</table></form>");
?>