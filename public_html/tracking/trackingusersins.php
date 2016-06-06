<?php
/* Attention this is NOT open source software and is protected under 
the copyright act. Copyright (c) 2003 J.Quijano Hacix Inc.
Licensee: Nutrophy Inc.
*/

$sql = "INSERT INTO users SET ";
$sql .="user_id=NULL,";                                                                     
$sql .="login_name='$login_name',";                                                                       
$sql .="password='$password',";                                                                       
$sql .="name='$name',";        
$sql .="branch='$branch',";
$sql .="readpriv='$readpriv',";
$sql .="readinsert='$readinsert',";
$sql .="readupdate='$readupdate',";
$sql .="deletepriv='$deletepriv',";
$sql .="adminpriv='$adminpriv'";
?>    