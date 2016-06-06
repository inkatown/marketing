<?php
/* Attention this is NOT open source software and is protected under 
the copyright act. Copyright (c) 2003 J.Quijano Hacix Inc.
Licensee: Nutrophy Inc.
*/


$sql = "UPDATE urls SET ";
$sql .="c_code='$c_code',";
$sql .="url='$url',";
$sql .="url_tag='$url_tag',";
$sql .="url_page_name='$url_page_name'";
$sql .=" WHERE url_id='$record_id'";
?>
       