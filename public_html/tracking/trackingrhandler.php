<html>
<body>

<?php

/* Attention this is NOT open source software and is protected under 
the copyright act. Copyright (c) 2003 J.Quijano Hacix Inc.
Licensee: Nutrophy Inc.
*/


/* This is the main record handler */

// Initial Settings for application specifics
$security="trackingsecurity.php";
$dbinfo="trackingdbsec.php";
$entities="trackingentities.php";
$addbutton="images/trackingaddbutton.jpg";
$clonebutton="images/clonerecordbutton.jpg";
$searchbutton="images/trackingsearchbutton.jpg";
$showclone="";
$issearching="";
$filter="";
$scriteria="";
$disstatus="";
$minsec=1;

// PARSE COMMAND LINE
$ntt=$_GET['ntt']; // get main call from main menu
if (! $ntt){$ntt=$_POST['ntt'];}  // post when hidden on the form
if ($ntt){include("$entities");}
  else {die("INVALID CALL");}
$docname=$_GET['docname'];

// SECURITY
include("$security");
$seclevel=getsecurity();
if ($seclevel < $minsec) {
  die ("NOT AUTHORIZED");
}
if ($seclevel == 1){$disstatus="DISABLED";}
$printlist="1";

// DATA BASE
include("$dbinfo");
$db=mysql_connect("$dbhost","$dbuser","$dbpassword") or die ("NO CONNECTION TO DATABASE AVAILABLE");
mysql_select_db("$dbasename",$db) or die ("INVALID DATA BASE");  


// RETRIEVE ACTION PARAMETERS
$submit=$_POST['submit'];
$continue=$_POST['continue'];
$record_id=$_GET['main_id'];
if (!$record_id){$record_id=$_POST['main_id'];}  // try with post
$delete=$_GET['delete'];
$add=$_GET['add'];
$view=$_GET['view'];
$clone=$_GET['clone'];
$sort=$_GET['sort'];
if (!$sort){
  $sort=$_POST['sort'];
}
$search=$_GET['search'];
if (!$search){$search=$_POST['search'];}
if($continue){$record_id="";}
$mphpself=$_SERVER['PHP_SELF'];

// RETRIEVE POST PARAMETERS

include("$posthandler");

if ($record_id){
  $printlist="";
}

if ($clone){
  // Duplicate record = record_id into a new row, insert with values we have now an show list
  $sql = "SELECT * FROM $filename WHERE $idname=$record_id";
  $result = mysql_query($sql);
  $myrow = mysql_fetch_array($result);
  include("$asignhandler");
  $submit="Update";
  $record_id="";
}


// Process Submit Actions
if ($submit)  {
  // here if no ID then adding else we're editing
  if ($record_id) {
    if ($seclevel > 2) {
      include("$updhandler");
    }
    else {
      die ("NOT AUTHORIZED TO UPDATE DATA");
    }
  } 
  else {
    if ($seclevel > 1){
      $validfield=getvalidfield();  // a shot
      if ($validfield){

        // add not empty record
        include("$inshandler");
      }
      else{
        die("INVALID DATA");
      }
    }
    else {
      die ("NOT AUTHORIZED TO INSERT DATA");
    }
  }
  // run SQL against the DB
  $result = mysql_query($sql,$db) or die("Can not perform update/insert Query:$sql");
  $validfield=getvalidfield();
  if ($validfield){
    $printlist="1";
    $record_id="";
    $add="";
  }
}


if ($delete) {
  if ($seclevel > 3){
    // delete a record
    if ($docname){
      // Delete source document
      $sql = "SELECT * FROM $filename WHERE $idname=$record_id";	
      $result = mysql_query($sql,$db) or die("SOURCE FILE NOT FOUND");
      $myrow = mysql_fetch_array($result);
      if ($myrow['link']){
        // Delete document file
        $dfname=$myrow['link'];
        unlink($dfname);
      }
  
    }
    $sql = "DELETE FROM $filename WHERE $idname=$record_id";	
    $result = mysql_query($sql,$db) or die("IMPOSIBLE TO DELETE RECORD");
    $printlist="1";
    $record_id="";
  }
  else {
    die ("NOT AUTHORIZED TO DELETE DATA");
  }
}

if ($add){
  $printlist="";

}

if ($search){
  if ($search =="searchresults"){
    $scriteria=getsearchcriteria();
    $printlist="1";
    $issearching="";
    $record_id="";
  }
  else {
    $issearching="1";
    $printlist="";
  }
}

if ($printlist) {
  // this part happens if we don't press submit show the list
  // print the list if there is not editing
  $mquery="SELECT * FROM $filename ";
  if ($filter){
    $mquery .=" WHERE ";
    $mquery .=$filter;
  }
  if ($scriteria){
    if ($filter){
      $mquery .=" AND ";
    }
    else {
      $mquery .=" WHERE ";
    }
    $mquery .=$scriteria;
  }
  if ($sort){
    $sortcriteria=$sort;
    $mquery .=" ORDER BY $sortcriteria";
  }
  $result = mysql_query($mquery,$db) or die ("Invalid Query: $mquery");
  ?>
  <div align="center">
  <center>
  <div align="center">
    <center>
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber1">
    <p align="center" <b> <font size="4"> <?php echo $title?> </font></b></p>
    <?php include("$toplisthandler")?>
  <?php
  while ($myrow = mysql_fetch_array($result)) {
    $record_id1=$myrow["$idname"];
    ?>
    <tr>
     <?php include("$bodylisthandler")?> 
   </tr>
    <?php
  }
  printf("</table></center></div></center></div><p>");
}

if ($seclevel > 1){
   // can add
   if (!$record_id){
     if (!$issearching){
       print("<a href='$mphpself?add=yes&ntt=$ntt'><img border='0' src='$addbutton' ></a>");
     }
   }
   elseif ($showclone){
     print("<a href='$mphpself?clone=yes&ntt=$ntt&main_id=$record_id'><img border='0' src='$clonebutton' ></a>");
   }
}

// Search handler
if ($showsearch){
  if (!$record_id){
    if ($issearching){     
    }
    else {
      print("<a href='$mphpself?search=yes&ntt=$ntt'><img border='0' src='$searchbutton' ></a>");
    }
  }
}
 
if ($record_id || $add || $search) {
  if ($record_id){
    // editing so select a record
    $sql = "SELECT * FROM $filename WHERE $idname=$record_id";
    $result = mysql_query($sql);
    $myrow = mysql_fetch_array($result);
    include("$asignhandler");
  }
  else {
    setvalidfield("");
    // $agname="";
  }

  // print Form
  if (!$printlist){
    include("$formhandler");
  }
}

?>

</body>
</html>
