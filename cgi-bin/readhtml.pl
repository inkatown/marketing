#!/usr/bin/perl -w
use Mysql;
use Term_rec;

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
  #@stuff=($sth->fetchrow);
  #@stuff=($sth->fetchrow);
	
 
  #end of the database stuff	




   $logFile = "/var/log/httpd/access_log" ;#$ARGV[0];

   open (LOGFILE,"$logFile") || die "  Error opening log file $logFile.\n";


   #----------------------------------------------------------------#
   #  Begin processing the LOGFILE, record-by-record, until the     #
   #  end of the file.  Create a hash to store the number of times  #
   #  we've been accessed from each $clientAddress.                 #
   #----------------------------------------------------------------#


while(<LOGFILE>) {
	chomp;
	


	s/\s+/ /go;


	($clientAddress, $rfc1413, $username,
	$localTime, $httpRequest, $statusCode,
	$bytesSentToClient, $referer, $clientSoftware) =
	#/^(\S+) (\S+) (\S+) \[(.+)] \"(.+)\" (\S+) (\S+) \"(.*)\" \"(.*)\"/o;
	/^(\S+) (\S+) (\S+) \[(.+)] \"(.+)\" (\S+) (\S+) (\S+) \"(.*)\" \"(.*)\"/o;
	#here we split the value of local time
	@timo = split(/\//,(substr($localTime,0,11)));
	$day=$timo[0];
	
	if($timo[1] eq 'May'){
	  $month = '05' ;
	}
	if($timo[1] eq 'Jun'){
	  $month = '06';	
	}
	if($timo[1] eq 'Jul'){
	  $month = '07';	
	}
	if($timo[1] eq 'Aug'){
	  $month = '08';	
	}
	if($timo[1] eq 'Sep'){
	  $month = '09';	
	}
	if($timo[1] eq 'Oct'){
	  $month = '10';	
	}


	#$year=$timo[2];
	if((($ln{da}<=$day)&&($ln{da1}>=$day)) && (($ln{dm}<=$month) && ($ln{dm1}>=$month))){
	#here we store all the pages visited by a unique ip address
	$httpRequest = substr($httpRequest,4);
	
	$httpHasho{$clientAddress}=$httpHasho{$clientAddress}.":".$httpRequest;
	}
}


close (LOGFILE);
#--------------------------<<   html main   >>-----------------------------#

print "Content-type: text/html\n\n";

print <<ENDHTML;
<HTML><HEAD>
<TITLE>CGI Test</TITLE>
<link rel="stylesheet" type="text/css" href="../catalog/includes/stylesheet.css">
</HEAD>
ENDHTML





print "This report was generated with the following criteria: \n";
print "<BR>\n";
print "--------------------------------\n\n";
#here we initialize the the counters to 0 and set the key to the be the searching string

while(@row = ($sth->fetchrow)){
	#print $row[0];
	$termd = Term_rec->new();
	$termd->name($row[1]);
	$termd->counter(0);
	$termd->idcam($row[2]);
	$rowi = $rowi.$sep.$row[0];
	$stuff{$rowi} = $termd;
	#separator
	$sep= ".*"
}




foreach $key_url (sort(keys(%httpHasho))){
	#print $httpHasho{$key_url};
	foreach $search(keys %stuff){
		
		if($httpHasho{$key_url}=~/$search/){
			($stuff{$search})->counter(($stuff{$search})->counter() + 1);		
		}

	
	}
	
	
}

#testing output
print "<BR>\n";
print "Campaign name: $ln{campaignBox} \n";
print "<BR>\n";
print "Beg_date: $ln{dm} - $ln{da} - 2003  \n";
print "<BR>\n";
print "End_date: $ln{dm1} - $ln{da1} - 2003 \n";
#print "this is the beg and end date value $month \n";


print "<BR>\n";


print "<BR>\n";


print <<ENDHTML;
<table border=1>
<tr><td>Name of page</td><td>Number of Unique Hits</td><td>Tag</td><td>Percentage</td><td>&nbsp</td></tr>
ENDHTML

$inito = 0;
$onehundred = 0;
$barimg='../awstats/icons/other/barrehp.png';
#foreach $search1(keys %stuff){
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

print <<ENDHTML;
</table>
ENDHTML




print "<BODY>\n";
print "</BODY></HTML>";

exit(0);

