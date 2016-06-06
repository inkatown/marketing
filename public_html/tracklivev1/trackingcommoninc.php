<?php
/* Attention this is NOT open source software and is protected under 
the copyright act. Copyright (c) 2003 J.Quijano Hacix Inc.
Licensee: Nutrophy Inc.
*/
// Common Functions
function sendheader() {
  // Send http header
  if (!headers_sent()){
    header("Content-Type: text/html");
  }
}

function display_message($msg){
  if (!headers_sent()){
  sendheader();
  }
  printf("$msg");  
}

function sendtitle($title){
  sendheader();
  printf("<html><head><title>$title</title></head><body>");
}

function endhtml(){
  printf("</body></html>");
}

?>
