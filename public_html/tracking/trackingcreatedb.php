<?php
/* Attention this is NOT open source software and is protected under 
the copyright act. Copyright (c) 2003 J.Quijano Hacix Inc.
Licensee: Nutrophy Inc.
*/

include("trackingcommoninc.php");
sendtitle("Data Base Creation Program");
// Create Tracking Data Data Base

  $createdb="1";
  $createusers="1";
  $createsessions="1";
  $createcampaigns="1";
  $createurls="1";

  include("trackingdbsec.php");
  $db=mysql_connect("$dbhost","$dbuser","$dbpassword") or die ("NO CONNECTION");

  if ($createdb){
    if (mysql_create_db("trackingdata")){
      print("Database Created succesfully\n");
    }
    else {
      printf("Error Creating database: %s\n", mysql_error());
    }
  }

  // Open Database

  mysql_select_db("trackingdata",$db) or die ("INVALID DATA BASE");


  if ($createusers){
    $query="CREATE TABLE users(user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,";
          $query=$query ."login_name CHAR(10), password CHAR(10), name VARCHAR(35),branch VARCHAR(35),";
          $query=$query ."readpriv VARCHAR(10), readinsert VARCHAR(10), readupdate VARCHAR(10),";
          $query=$query ."deletepriv VARCHAR(10), adminpriv VARCHAR(10))";
  mysql_query($query,$db) or die ("INVALID QUERY ON CREATE USERS:$query");
/*
  $query="ALTER TABLE users ADD COLUMN name VARCHAR(35)";
  mysql_query($query,$db) or die ("INVALID QUERY ON ADD name:$query");

  $query="ALTER TABLE users ADD COLUMN branch VARCHAR(35)";
  mysql_query($query,$db) or die ("INVALID QUERY ON ADD branch:$query");

  $query="ALTER TABLE users ADD COLUMN readpriv VARCHAR(10)";
  mysql_query($query,$db) or die ("INVALID QUERY ON ADD readpriv:$query");

  $query="ALTER TABLE users ADD COLUMN readinsert VARCHAR(10)";
  mysql_query($query,$db) or die ("INVALID QUERY ON ADD readinsert:$query");

  $query="ALTER TABLE users ADD COLUMN readupdate VARCHAR(10)";
  mysql_query($query,$db) or die ("INVALID QUERY ON ADD readupdate:$query");

  $query="ALTER TABLE users ADD COLUMN deletepriv VARCHAR(10)";
  mysql_query($query,$db) or die ("INVALID QUERY ON ADD deletepriv:$query");

  $query="ALTER TABLE users ADD COLUMN adminpriv VARCHAR(10)";
  mysql_query($query,$db) or die ("INVALID QUERY ON ADD adminpriv:$query");
*/

    // Create Administrator
    $query="INSERT INTO users SET user_id=NULL, login_name='cdadmin',password='667788',";
          $query .= "name='Tracking Data Administrator',branch='Corporate',adminpriv='ON'";
    mysql_query($query,$db) or die ("INVALID QUERY ON CREATE ADMIN USER:$query");

  }

  if ($createsessions){
    $query="CREATE TABLE sessions(session_no INT NOT NULL PRIMARY KEY AUTO_INCREMENT,";
         $query=$query."session_id VARCHAR(25),";
         $query=$query."master_user CHAR(10),";
         $query=$query."userloggedin CHAR(10),";
         $query=$query."session_time REAL)";
    mysql_query($query,$db) or die ("INVALID QUERY ON CREATE SESSIONS:$query");
  }

  if ($createcampaigns){
    $query="CREATE TABLE campaigns(c_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,";
         $query=$query."c_code VARCHAR(10),";
         $query=$query."c_name VARCHAR(35),";
         $query=$query."beg_date DATETIME,";
         $query=$query."end_date DATETIME,";
         $query=$query."salesman VARCHAR(35))";
    mysql_query($query,$db) or die ("INVALID QUERY ON CREATE campaigns:$query");
  }

  if ($createurls){
    $query="CREATE TABLE urls(url_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,";
          $query .="c_code VARCHAR(10),";
          $query .="url VARCHAR(150),";
          $query .="url_tag VARCHAR(20),";
          $query .="url_page_name VARCHAR(60))";
    mysql_query($query,$db) or die ("INVALID QUERY ON CREATE URLS:$query");
  }
  display_message("Database Created Succesfully");
endhtml();
?>
