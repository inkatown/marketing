#!/usr/bin/perl -w
use Mysql;
use Term_rec;
use Records;
use Time::Local;

#------------------------------------------------------------------------------#



#--------------------------<<   main   >>-----------------------------#


#--------------------------<<retrieving data from trendstat.php>>-----------------------------#  
  
  if ($ENV{'REQUEST_METHOD'} eq "GET")
  {
   $yourname=$ENV{'QUERY_STRING'};
  }
  $yourname =~ s/\+/ /g;

  # split form data and store in hash
  @details = split (/&/, $yourname);
  foreach $tanto (@details){
   ($n,$v) = split (/=/, $tanto);
 
   $ln{$n} = $v;
   #print "this is the variable $v";
  }
  #stored all the values in the hash ln
#--------------------------<<database handling>>-----------------------------#  
#database variables
  $DBHOST = "localhost";
  $DBNAME = "catalog";
  $DBUSER = "oscommerce";
  $DBPASS = "oscommerce";
  #here we connect with the database
  $DB = Mysql->connect($DBHOST, $DBNAME, $DBUSER, $DBPASS);
  $DB->selectdb($DBNAME);
  #retrieve data from the database base on the campaign selected
$query="SELECT u.url, u.url_page_name, u.url_tag FROM campaigns c, urls u WHERE c.c_code=u.c_code AND c.c_name='$ln{campaignBox}' order by u.url_tag";

  $sth =$DB->query($query);

	
 
  #end of the database connection set up
  #here we initialize stuff hashtable

  while(@row = ($sth->fetchrow)){
	#print $row[0];
	$termd = Term_rec->new();
	$termd->name($row[1]);
	$termd->counter(0);
	$termd->oristring($row[0]);
	$termd->idcam($row[2]);
	#$rowi = $rowi.$sep.$row[0];
	$rowi .= $sep.$row[0];
	$stuff{$rowi} = $termd;
	#separator
	$sep= ".*"
  } 





#--------------------------<<   html main   >>-----------------------------#

print "Content-type: text/html\n\n";

print <<ENDHTML;
HTML><HEAD>
<TITLE>CGI Test</TITLE>
<link rel="stylesheet" type="text/css" href="../catalog/includes/stylesheet.css">
</HEAD>
<BODY>
ENDHTML
	@ln1=split(/-/,$ln{pubdate});
	@ln2=split(/-/,$ln{expdate});
	$inicialDate = timelocal(0, 0, 0, $ln1[0], $ln1[1], $ln1[2]) ;
	$endingDate = timelocal(0, 0, 0, $ln2[0], $ln2[1], $ln2[2]) ;
	
	$query="SELECT localTime FROM log_stats ORDER BY s_id LIMIT 0,1";
	$firstEntry = $DB->query($query);
	
	$firstE=$firstEntry->fetchrow;
	
	
	$query="SELECT localTime FROM log_stats ORDER BY s_id DESC LIMIT 0,1";
	$lastEntry = $DB->query($query);
	
	$lastE=$lastEntry->fetchrow;
	
  ##### start of report heading####
  
  print "This report was generated with the following criteria: \n";
  print "<BR>\n";
  print "--------------------------------\n\n";
  print "<BR>\n";
  print "Campaign name: $ln{campaignBox} \n";
  print "<BR>\n";
  print "Beg_date: $ln1[1] - $ln1[0] - $ln1[2]  \n";
  print "<BR>\n";
  print "End_date: $ln2[1] - $ln2[0] - $ln2[2] \n";
  print "<BR>\n";
  print "Report Type: $ln{reportBox} \n";
  
  print "<BR>\n";
  print "<BR>\n";
  ##### end of report heading####


  $query1="SELECT clientAddress, localTime, httpRequest, concat(year(prodate), '/',month(prodate), '/',dayofmonth(prodate)), s_id FROM log_stats where prodate >= '$ln1[2]-$ln1[1]-$ln1[0]' and prodate < date_add('$ln2[2]-$ln2[1]-$ln2[0]', interval 1 day) order by prodate";

  $sth1 =$DB->query($query1);



		
$tempcounter = 0;

$initdate = 0;

while(@row1 = ($sth1->fetchrow)) {
	 
  
###initialization of pdate  data changes
 if($initdate eq 0) {
	$pdate = $row1[3];
	$initdate = 1;
 }
###initialization of pdate data changes  

 if($ln{reportBox} eq 'daily') {
  ###start of if date changes###
  if($pdate ne $row1[3]){
   ###foreach loop to search httpHasho
   foreach  $key_url(sort hshvalue1(keys(%httpHasho))){
    foreach $search(keys %stuff){
		
	 if(($httpHasho{$key_url})->promurls()=~/$search/){
		($stuff{$search})->counter(($stuff{$search})->counter() + 1);		
	  		
	}
   }
	
   }
   ###end of foreach loop to search httpHasho

   #	
   #
   #
   #################################start_of_table#####################################

print <<ENDHTML;
<br> $pdate
<table border=1>
<tr><td>Name of page</td><td>Number of Unique Hits</td><td>Tag</td><td>Percentage</td><td>&nbsp;</td></tr>
ENDHTML

   $inito = 0;
   $onehundred = 0;
   $barimg='../awstats/icons/other/barrehp.png';
   ###start of foreach loop  
   foreach  $search1(sort hshvalue(keys(%stuff))){
	$tmpctr= ($stuff{$search1})->counter();
	($stuff{$search1})->finalcounter(($stuff{$search1})->finalcounter() + $tmpctr);		
	$tmpcrt=($stuff{$search1})->name();
	$tmptrc=($stuff{$search1})->idcam();
	$oristring=($stuff{$search1})->oristring();
	if($inito eq 0){
	 	$inito = 1;
		$onehundred = $tmpctr;	
	}
	
	print "<tr>\n";
	print "<td bgcolor='#FFFF99'>\n";
	print $tmpcrt;
	print "</td>\n";
	print "<td bgcolor='#FFFF99'>\n";
	print $tmpctr;
	print "</td>\n";
	
	print "<td bgcolor='#FFFF99'>\n";
	print $tmptrc;
	print "</td>\n";

	print "<td bgcolor='#FFFF99'>\n";
	$percentage =  &computePercentage($tmpctr,$onehundred);
	$b = sprintf("%.2f", $percentage);
	print $b; 
	print "</td>\n";
	print "<td>\n";
	print " <IMG SRC=$barimg WIDTH=$percentage HEIGHT=6 alt=$oristring>\n";
	#print "$search1";
	print "</td>\n";
	print "</tr>\n";
	
	$tmpctr= ($stuff{$search1})->counter(0);
	


   }
print <<ENDHTML;
</table>
<br>
ENDHTML
   #################################end_of_table#####################################
   #
   #  
   #
   #
   %httpHasho = ();

  }
  ###end of if date changes###	
}


    
 	


	
	#here we split the value of local time
	@timo = split(/\//,(substr($row1[1],0,11)));
	$day=$timo[0];
	
	$mes = $timo[1];
	$month = &converDate($mes);
	
	
	$recDate = timelocal(0, 0, 0, $timo[0], $month, $timo[2]) ;

	
	
	if(($recDate>=$inicialDate) && ($recDate<=$endingDate)){
	#here we store all the pages visited by a unique ip address
	$httpRequest = substr($row1[2],4);
	
	  if(defined $httpHasho{$row1[0]}){
		($httpHasho{$row1[0]})->promurls(($httpHasho{$row1[0]})->promurls().$httpRequest);
	  }else{
 		$reCord = Records->new();
		$reCord->promurls($httpRequest);
		$reCord->visit_date($row1[3]);	
		$reCord->id($row1[4]);
		$httpHasho{$row1[0]}=$reCord; 
	  }
	}
	$pdate = $row1[3];
}
#last item read print "Unix ending date $recDate\n";





  foreach $key_url(sort hshvalue1(keys(%httpHasho))){
  
	#$kuyayky = ($httpHasho{$key_url})->promurls();
	#$kuyayky1 = ($httpHasho{$key_url})->visit_date();
	#print "$key_url \t\t $kuyayky1 \t\t $kuyayky";
	#print "<BR>\n"	;
	foreach $search(keys %stuff){
		
		if(($httpHasho{$key_url})->promurls()=~/$search/){
			($stuff{$search})->counter(($stuff{$search})->counter() + 1);		
	  	$tmpcounter++;
			
		}

	
	}
    
     	
  }



###end of big fuzz####





#################################start_of_final table#####################################
if( $ln{reportBox} eq 'daily') {
print $pdate;
}
print <<ENDHTML;
<table border=1>
<tr><td>Name of page</td><td>Number of Unique Hits</td><td>Tag</td><td>Percentage</td><td>&nbsp;</td></tr>
ENDHTML

$inito = 0;
$onehundred = 0;
$barimg='../awstats/icons/other/barrehp.png';

foreach  $search1(sort hshvalue(keys(%stuff))){
	$tmpctr= ($stuff{$search1})->counter();
	$finalcounter = ($stuff{$search1})->finalcounter(($stuff{$search1})->finalcounter() + $tmpctr);		
	$tmpcrt=($stuff{$search1})->name();
	$tmptrc=($stuff{$search1})->idcam();
	$oristring=($stuff{$search1})->oristring();
	
	if($inito eq 0){
	 	$inito = 1;
		$onehundred = $tmpctr;	
	}
	
	print "<tr>\n";
	print "<td bgcolor='#FFFF99'>\n";
	print $tmpcrt;
	print "</td>\n";
	print "<td bgcolor='#FFFF99'>\n";
	print $tmpctr; #print " $finalcounter";
	print "</td>\n";
	
	print "<td bgcolor='#FFFF99'>\n";
	print $tmptrc;
	print "</td>\n";

	print "<td bgcolor='#FFFF99'>\n";
	$percentage =  &computePercentage($tmpctr,$onehundred);
	$b= sprintf("%.2f", $percentage);
	print $b;
	print "</td>\n";
	print "<td>\n";
	print " <IMG SRC=$barimg WIDTH=$percentage HEIGHT=6 alt=$oristring>\n";
	#print "$search1";
	print "</td>\n";
	print "</tr>\n";
	
	
	


}

#################################end_of_final_table#####################################

sub hshvalue{
 ($stuff{$a})->idcam() <=> ($stuff{$b})->idcam();
}
sub hshvalue1{
 ($httpHasho{$a})->id() <=> ($httpHasho{$b})->id();
}

sub computePercentage($tmpctr,$onehundred){
 if($onehundred	eq 0){
	return 0; 
 }
 return $percentage =  ($tmpctr*100)/$onehundred;
}
sub converDate($mes){
	if($mes eq 'Jan'){
	  return 1 ;
	}
	if($mes eq 'Feb'){
	  return  2 ;
	}
	if($mes eq 'Mar'){
	  return 3 ;
	}
	if($mes eq 'Apr'){
	  return 4 ;
	}
	if($mes eq 'May'){
	  return 5 ;
	}
	if($mes eq 'Jun'){
	  return 6;	
	}
	if($mes eq 'Jul'){
	  return 7;	
	}
	if($mes eq 'Aug'){
	  return 8;	
	}
	if($mes eq 'Sep'){
	  return 9;
	}
	if($mes eq 'Oct'){
	  return 10;
	}
	if($mes eq 'Nov'){
	  return 11;
	}
	if($mes eq 'Dec'){
	  return 12;
	}
}

print <<ENDHTML;
</table>
ENDHTML
print "<BR>\n";
	print "First item date from the database $firstE\n";

print "<BR>\n";
	print "Last item date from the database $lastE\n";


#################################start_of_table#####################################
print "</BODY></HTML>";

exit(0);

