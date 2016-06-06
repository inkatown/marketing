#!/usr/bin/perl -w
use Mysql;

use Time::Local;

#------------------------------------------------------------------------------#



#--------------------------<<   main   >>-----------------------------#



#--------------------------<<database handling>>-----------------------------#  
#database variables
  $DBHOST = "localhost";
  $DBNAME = "catalog";
  $DBUSER = "oscommerce";
  $DBPASS = "oscommerce";
  #here we connect with the database
  $DB = Mysql->connect($DBHOST, $DBNAME, $DBUSER, $DBPASS);
  $DB->selectdb($DBNAME);
  #retrieve all the urls in the urls database
  $query="SELECT url FROM urls";

  $sth =$DB->query($query);
  
 
  #end of the database handling 
#here we make sure that there are no duplicates urls  

while(@row = ($sth->fetchrow)){
	$stuff{$row[0]}++;
}


   #here we specify the logfile's name and location	

   $logFile = "/var/log/httpd/access_log" ;#$ARGV[0];
   #$logFile ="access071403";
   open (LOGFILE,"$logFile") || die "  Error opening log file $logFile.\n";


   #----------------------------------------------------------------#
   #  Begin processing the LOGFILE, record-by-record, until the     #
   #  end of the file.  Create a hash to store the number of times  #
   #  we've been accessed from each $clientAddress.                 #
   #----------------------------------------------------------------#
#add conditions not to get duplicate data
	$query="SELECT localTime FROM log_stats ORDER BY s_id DESC LIMIT 0,1";
	$lastDate = $DB->query($query);
	

	$lastDatabaseDate = 0000000000;
while($lastD=($lastDate->fetchrow)){
	#stores the date in the date array dd/mm/year
	@date = split(/\//,(substr($lastD,0,11)));
	#stores the hour in the timo array hh:min:sec
	@timo = split(/:/,(substr($lastD,12,8)));
	if($date[1] eq 'Jan'){
	  $month= 1 ;
	}
	if($date[1] eq 'Feb'){
	  $month=  2 ;
	}
	if($date[1] eq 'Mar'){
	  $month= 3 ;
	}
	if($date[1] eq 'Apr'){
	  $month= 4 ;
	}
	if($date[1] eq 'May'){
	  $month= 5 ;
	}
	if($date[1] eq 'Jun'){
	  $month= 6;	
	}
	if($date[1] eq 'Jul'){
	  $month= 7;
	}
	if($date[1] eq 'Aug'){
	  $month= 8;	
	}
	if($date[1] eq 'Sep'){
	  $month= 9;
	}
	if($date[1] eq 'Oct'){
	  $month= 10;
	}
	if($date[1] eq 'Nov'){
	  $month= 11;
	}
	if($date[1] eq 'Dec'){
	  $month= 12;
	}
	#calculating the last record unix time from the database
	$lastDatabaseDate = timelocal($timo[2], $timo[1], $timo[0], $date[0], $month, $date[2]) ;
}


while(<LOGFILE>) {
	chomp;
	


	s/\s+/ /go;


	($clientAddress, $rfc1413, $username,
	$localTime, $httpRequest, $statusCode,
	$bytesSentToClient, $referer, $clientSoftware) =
	#/^(\S+) (\S+) (\S+) \[(.+)] \"(.+)\" (\S+) (\S+) \"(.*)\" \"(.*)\"/o;
	/^(\S+) (\S+) (\S+) \[(.+)] \"(.+)\" (\S+) (\S+) (\S+) \"(.*)\" \"(.*)\"/o;
 	@date1 = split(/\//,(substr($localTime,0,11)));
	@timo1 = split(/:/,(substr($localTime,12,8)));



	if($date1[1] eq 'Jan'){
	  $month1= 1 ;
	}
	if($date1[1] eq 'Feb'){
	  $month1=  2 ;
	}
	if($date1[1] eq 'Mar'){
	  $month1= 3 ;
	}
	if($date1[1] eq 'Apr'){
	  $month1= 4 ;
	}
	if($date1[1] eq 'May'){
	  $month1= 5 ;
	}
	if($date1[1] eq 'Jun'){
	  $month1= 6;	
	}
	if($date1[1] eq 'Jul'){
	  $month1= 7;
	}
	if($date1[1] eq 'Aug'){
	  $month1= 8;	
	}
	if($date1[1] eq 'Sep'){
	  $month1= 9;
	}
	if($date1[1] eq 'Oct'){
	  $month1= 10;
	}
	if($date1[1] eq 'Nov'){
	  $month1= 11;
	}
	if($date1[1] eq 'Dec'){
	  $month1= 12;
	}
	
	#calculating the current record unix time
	$recordDate = timelocal($timo1[2], $timo1[1], $timo1[0], $date1[0], $month1, $date1[2]) ;
 if($recordDate > $lastDatabaseDate){
	foreach $search(keys %stuff){
	#only stores the urls defined in the urls database
	 if($httpRequest=~/$search/){
		$query ="insert into log_stats(clientAddress,localTime,httpRequest, prodate) VALUES ('$clientAddress', '$localTime', '$httpRequest', '$date1[2]-$month1-$date1[0] $timo1[0]:$timo1[1]:$timo1[2]') ";
		$DB->query($query);
		
	 }	
	}
 }
}


close (LOGFILE);
#sub timeconverter($timt){	
	
	
#}
	
print "Content-type: text/html\n\n";
print <<ENDHTML;
<HTML><HEAD>
<TITLE>Tracking Update</TITLE>
<META HTTP-EQUIV="refresh" content="3;URL=http://www.nutrophy.com/tracklivev1/trendstats.php">
</HEAD>
<BODY>
The database has been updated!
ENDHTML
print <<ENDHTML;
</BODY>
</HTML>
ENDHTML
exit(0);

