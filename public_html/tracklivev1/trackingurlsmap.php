<?php

/* Attention this is NOT open source software and is protected under 
the copyright act. Copyright (c) 2003 J.Quijano Hacix Inc.
Licensee: Nutrophy Inc.
*/


// Urls Map
$title="Urls";
$idname="url_id";
$valfieldname="c_code";
$sortcriteria="c_code";
$filename="urls";
$posthandler="trackingurlspost.php";
$updhandler="trackingurlsupd.php";
$inshandler="trackingurlsins.php";
$asignhandler="trackingurlsasign.php";
$formhandler="trackingurlsform.php";
$toplisthandler="trackingurlslisttop.php";
$bodylisthandler="trackingurlslistbody.php";
$showclone="";
$showsearch="";
$filter="";
$minsec=5;


function getvalidfield(){
  global $c_code;
  return $c_code;
}

function setvalidfield($valuef){
  global $c_code;
  $c_code=$valuef;
}

?>