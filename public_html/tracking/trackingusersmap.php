<?php

/* Attention this is NOT open source software and is protected under 
the copyright act. Copyright (c) 2003 J.Quijano Hacix Inc.
Licensee: Nutrophy Inc.
*/


// Users Map
$title="Users";
$idname="user_id";
$valfieldname="login_name";
$sortcriteria="login_name";
$filename="users";
$posthandler="trackinguserspost.php";
$updhandler="trackingusersupd.php";
$inshandler="trackingusersins.php";
$asignhandler="trackingusersasign.php";
$formhandler="trackingusersform.php";
$toplisthandler="trackinguserslisttop.php";
$bodylisthandler="trackinguserslistbody.php";
$showclone="";
$showsearch="";
$filter="";
$minsec=2;


function getvalidfield(){
  global $login_name;
  return $login_name;
}

function setvalidfield($valuef){
  global $login_name;
  $login_name=$valuef;
}

?>
