<?php
/* Attention this is NOT open source software and is protected under 
the copyright act. Copyright (c) 2003 J.Quijano Hacix Inc.
Licensee: Nutrophy Inc.
*/


$sql = "UPDATE users SET ";
$sql .="login_name='$login_name',";
$sql .="password='$password',";
$sql .="name='$name',";
$sql .="branch='$branch',";
$sql .="readpriv='$readpriv',";
$sql .="readinsert='$readinsert',";
$sql .="readupdate='$readupdate',";
$sql .="deletepriv='$deletepriv',";
$sql .="adminpriv='$adminpriv'";
$sql .=" WHERE user_id='$record_id'";
?>
       