#!/usr/bin/perl -w
use Mysql;
use Term_rec;
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
	$termd->idcam($row[2]);
	#$rowi = $rowi.$sep.$row[0];
	$rowi .= $sep.$row[0];
	$stuff{$rowi} = $termd;
	#separator
	$sep= ".*"
  } 



  $query1="SELECT clientAddress, localTime, httpRequest FROM log_stats";

  $sth1 =$DB->query($query1);

#--------------------------<<   html main   >>-----------------------------#

print "Content-type: text/html\n\n";

print <<ENDHTML;
<HTML><HEAD>
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
		



while(@row1 = ($sth1->fetchrow)) {
	#print "$row1[1]\n";
	
	#here we split the value of local time
	@timo = split(/\//,(substr($row1[1],0,11)));
	$day=$timo[0];
	
	$mes = $timo[1];
	$month = &converDate($mes);
	
	
	$recDate = timelocal(0, 0, 0, $timo[0], $month, $timo[2]) ;

	
	
	if(($recDate>=$inicialDate) && ($recDate<=$endingDate)){
	#here we store all the pages visited by a unique ip address
	$httpRequest = substr($row1[2],4);
	
	$httpHasho{$row1[0]}.=$httpRequest;
	}
}
#last item read print "Unix ending date $recDate\n";


foreach $key_url (sort(keys(%httpHasho))){
	#print $httpHasho{$key_url};
	foreach $search(keys %stuff){
		
		if($httpHasho{$key_url}=~/$search/){
			($stuff{$search})->counter(($stuff{$search})->counter() + 1);		
		}

	
	}
	
	
}






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
print "<BR>\n";

#################################start_of_table#####################################

print <<ENDHTML;
<table border=1>
<tr><td>Name of page</td><td>Number of Unique Hits</td><td>Tag</td><td>Percentage</td><td>&nbsp</td></tr>
ENDHTML

$inito = 0;
$onehundred = 0;
$barimg='../awstats/icons/other/barrehp.png';

foreach  $search1(sort hshvalue(keys(%stuff))){
	$tmpctr= ($stuff{$search1})->counter();
	$tmpcrt=($stuff{$search1})->name();
	$tmptrc=($stuff{$search1})->idcam();
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
	print $percentage =  &computePercentage($tmpctr,$onehundred);
	print "</td>\n";
	print "<td>\n";
	print "&nbsp;<IMG SRC=$barimg WIDTH=$percentage HEIGHT=6>\n";
	#print "$search1";
	print "</td>\n";
	print "</tr>\n";
	
	#print "Number of unique users $tmpctr who landed on $search1 this is the name $tmpcrt" ;
	#print "<BR>\n"	;
	


}

sub hshvalue{
 ($stuff{$a})->idcam() <=> ($stuff{$b})->idcam();
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

