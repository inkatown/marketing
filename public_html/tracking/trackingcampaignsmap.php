<?php

/* Attention this is NOT open source software and is protected under 
the copyright act. Copyright (c) 2003 J.Quijano Hacix Inc.
Licensee: Nutrophy Inc.
*/


// Campaigns Map
$title="Campaigns";
$idname="c_id";
$valfieldname="c_code";
$sortcriteria="c_code";
$filename="campaigns";
$posthandler="trackingcampaignspost.php";
$updhandler="trackingcampaignsupd.php";
$inshandler="trackingcampaignsins.php";
$asignhandler="trackingcampaignsasign.php";
$formhandler="trackingcampaignsform.php";
$toplisthandler="trackingcampaignslisttop.php";
$bodylisthandler="trackingcampaignslistbody.php";
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