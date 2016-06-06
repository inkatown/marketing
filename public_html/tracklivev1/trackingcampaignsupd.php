<?php
/* Attention this is NOT open source software and is protected under 
the copyright act. Copyright (c) 2003 J.Quijano Hacix Inc.
Licensee: Nutrophy Inc.
*/


$sql = "UPDATE campaigns SET ";
$sql .="c_code='$c_code',";
$sql .="c_name='$c_name',";
//$sql .="beg_date='$beg_date',";
//$sql .="end_date='$end_date',";
$sql .="salesman='$salesman'";
$sql .=" WHERE c_id='$record_id'";
?>
       