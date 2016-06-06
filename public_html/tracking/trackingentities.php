<?php
/* Attention this is NOT open source software and is protected under 
the copyright act. Copyright (c) 2003 J.Quijano Hacix Inc.
Licensee: Nutrophy Inc.
*/

  if ($ntt==1){$entity="users";include("trackingusersmap.php");}
  if ($ntt==2){$entity="campaings";include("trackingcampaignsmap.php");}
  if ($ntt==3){$entity="urls";include("trackingurlsmap.php");}
?>