<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0041)http://www.nutrophy.com/catalog/login.php -->
<HTML><HEAD><TITLE>Nutrophy | Trend Analyzer</TITLE>
<META http-equiv=Content-Type content="text/html; charset=windows-1252"><LINK 
href="../catalog/includes/stylesheet.css" type=text/css rel=stylesheet>
<SCRIPT language=javascript>
<!--

//-->
</SCRIPT>



<META content="MSHTML 6.00.2800.1141" name=GENERATOR></HEAD>
<BODY bottomMargin=0 bgColor=#ffffff leftMargin=0 topMargin=0 rightMargin=0 
marginheight="0" marginwidth="0"><!-- header //-->
<?
$db = mysql_connect("localhost", "oscommerce", "oscommerce") or die ("NO CONNECTION");;
mysql_select_db("catalog", $db);
$result = mysql_query("select c_name, c_id from campaigns",$db);

print $row[1];
//print "stop";
//print count($row);
?>

<!-- header_eof //--><!-- body //-->
<TABLE cellSpacing=0 cellPadding=0 width=748 align=center border=0>
  <TBODY>
  <TR><!-- body_text //-->
    <TD vAlign=top width="100%">
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD height=30><IMG height=30 
            src="/images/topBanner.jpg" width=626></TD></TR>
        <TR>
          <TD height=1><IMG height=1 
            src="http://localhost/images/spacer(1).gif" 
            width=1></TD></TR>
        <TR>
          <TD>
            <TABLE cellSpacing=0 cellPadding=0 width="100%">
              <TBODY>
              <TR>
                      <TD bgColor=#336699>&nbsp;&nbsp;<SPAN 
                  class=HeaderOneWhite>Campaign Trend Analizer</SPAN></TD>
                <TD bgColor=#336699><IMG height=27 
                  src="http://localhost/images/spacer(1).gif" 
                  width=1></TD></TR></TBODY></TABLE></TD></TR>
        <TR>
          <TD>
            <FORM name=tempstats 
            action="../cgi-bin/readhtml.pl" 
            method=GET><BR>
            <TABLE cellSpacing=0 cellPadding=2 width="100%" border=0>
              <TBODY>
              <TR>
                        <TD noWrap align=right><FONT face="Verdana, Arial" 
                  color=#000000 size=2>&nbsp;Campaing Name:&nbsp;</FONT></TD>
                        <TD noWrap align=left><FONT face="Verdana, Arial" color=#000000 
                  size=2>
                          <select name="campaignBox">
                            
			    <?while($row = mysql_fetch_array($result)) {

  				$sel="";
				if(!strcmp($_GET['c_id'],$row[1])){
					$sel="selected";
				}
				
				printf("<option value=\"%s\" %s>",$row[0],$sel);

  				echo $row[0];

  				echo '</option>';
			     }
			     ?>
                          </select>&nbsp;
                          </FONT></TD>
                      </TR>
              <TR>
                        <TD noWrap align=right><FONT face="Verdana, Arial" 
                  color=#000000 size=2>&nbsp;Beg_date:&nbsp;</FONT></TD>
                        <TD>  
                          <SELECT size=1 
            name=da> <OPTION value=01 selected>01&nbsp;</OPTION> <OPTION 
              value=02>02&nbsp;</OPTION> <OPTION value=03>03&nbsp;</OPTION> 
              <OPTION value=04>04&nbsp;</OPTION> <OPTION 
              value=05>05&nbsp;</OPTION> <OPTION value=06>06&nbsp;</OPTION> 
              <OPTION value=07>07&nbsp;</OPTION> <OPTION 
              value=08>08&nbsp;</OPTION> <OPTION value=09>09&nbsp;</OPTION> 
              <OPTION value=10>10&nbsp;</OPTION> <OPTION 
              value=11>11&nbsp;</OPTION> <OPTION value=12>12&nbsp;</OPTION> 
              <OPTION value=13>13&nbsp;</OPTION> <OPTION 
              value=14>14&nbsp;</OPTION> <OPTION value=15>15&nbsp;</OPTION> 
              <OPTION value=16>16&nbsp;</OPTION> <OPTION 
              value=17>17&nbsp;</OPTION> <OPTION value=18>18&nbsp;</OPTION> 
              <OPTION value=19>19&nbsp;</OPTION> <OPTION 
              value=20>20&nbsp;</OPTION> <OPTION value=21>21&nbsp;</OPTION> 
              <OPTION value=22>22&nbsp;</OPTION> <OPTION 
              value=23>23&nbsp;</OPTION> <OPTION value=24>24&nbsp;</OPTION> 
              <OPTION value=25>25&nbsp;</OPTION> <OPTION 
              value=26>26&nbsp;</OPTION> <OPTION value=27>27&nbsp;</OPTION> 
              <OPTION value=28>28&nbsp;</OPTION> <OPTION 
              value=29>29&nbsp;</OPTION> <OPTION value=30>30&nbsp;</OPTION> 
              <OPTION value=31>31</OPTION></SELECT> <FONT 
            face="Verdana, Arial, Helvetica, sans-serif" size=2>Month</FONT> 
            <SELECT size=1 name=dm> <OPTION value=01>January&nbsp;</OPTION> 
              <OPTION value=02>February&nbsp;</OPTION> <OPTION 
              value=03>March&nbsp;</OPTION> <OPTION 
              value=04>April&nbsp;</OPTION> <OPTION value=05>May&nbsp;</OPTION> <OPTION value=06>June&nbsp;</OPTION> 
              <OPTION value=07 selected>July&nbsp;</OPTION> <OPTION 
              value=08>August&nbsp;</OPTION> <OPTION 
              value=09>September&nbsp;</OPTION> <OPTION 
              value=10>October&nbsp;</OPTION> <OPTION 
              value=11>November&nbsp;</OPTION> <OPTION 
            value=12>December</OPTION></SELECT> <FONT 
            face="Verdana, Arial, Helvetica, sans-serif" size=2>Year</FONT> 
            <SELECT size=1 name=dy disabled="disabled"> <OPTION value=1997>1997&nbsp;</OPTION> <OPTION 
              value=1998>1998&nbsp;</OPTION> <OPTION 
              value=1999>1999&nbsp;</OPTION> <OPTION 
              value=2000>2000&nbsp;</OPTION> <OPTION 
              value=2001>2001&nbsp;</OPTION> <OPTION 
              value=2002>2002&nbsp;</OPTION> <OPTION 
              value=2003 selected>2003&nbsp;</OPTION></SELECT> </TD></TR>
				  <TR>
                        <TD noWrap align=right><FONT face="Verdana, Arial" 
                  color=#000000 size=2>&nbsp;End_date:&nbsp;</FONT></TD>
                        <TD>  
                          <SELECT size=1 
            name=da1> <OPTION value=01 selected>01&nbsp;</OPTION> <OPTION 
              value=02>02&nbsp;</OPTION> <OPTION value=03>03&nbsp;</OPTION> 
              <OPTION value=04>04&nbsp;</OPTION> <OPTION 
              value=05>05&nbsp;</OPTION> <OPTION value=06>06&nbsp;</OPTION> 
              <OPTION value=07>07&nbsp;</OPTION> <OPTION 
              value=08>08&nbsp;</OPTION> <OPTION value=09>09&nbsp;</OPTION> 
              <OPTION value=10>10&nbsp;</OPTION> <OPTION 
              value=11>11&nbsp;</OPTION> <OPTION value=12>12&nbsp;</OPTION> 
              <OPTION value=13>13&nbsp;</OPTION> <OPTION 
              value=14>14&nbsp;</OPTION> <OPTION value=15>15&nbsp;</OPTION> 
              <OPTION value=16>16&nbsp;</OPTION> <OPTION 
              value=17>17&nbsp;</OPTION> <OPTION value=18>18&nbsp;</OPTION> 
              <OPTION value=19>19&nbsp;</OPTION> <OPTION 
              value=20>20&nbsp;</OPTION> <OPTION value=21>21&nbsp;</OPTION> 
              <OPTION value=22>22&nbsp;</OPTION> <OPTION 
              value=23>23&nbsp;</OPTION> <OPTION value=24>24&nbsp;</OPTION> 
              <OPTION value=25>25&nbsp;</OPTION> <OPTION 
              value=26>26&nbsp;</OPTION> <OPTION value=27>27&nbsp;</OPTION> 
              <OPTION value=28>28&nbsp;</OPTION> <OPTION 
              value=29>29&nbsp;</OPTION> <OPTION value=30>30&nbsp;</OPTION> 
              <OPTION value=31>31</OPTION></SELECT> <FONT 
            face="Verdana, Arial, Helvetica, sans-serif" size=2>Month</FONT> 
            <SELECT size=1 name=dm1> <OPTION value=01>January&nbsp;</OPTION> 
              <OPTION value=02>February&nbsp;</OPTION> <OPTION 
              value=03>March&nbsp;</OPTION> <OPTION 
              value=04>April&nbsp;</OPTION> <OPTION value=05>May&nbsp;</OPTION> <OPTION value=06>June&nbsp;</OPTION> 
              <OPTION value=07 selected>July&nbsp;</OPTION> <OPTION 
              value=08>August&nbsp;</OPTION> <OPTION 
              value=09>September&nbsp;</OPTION> <OPTION 
              value=10>October&nbsp;</OPTION> <OPTION 
              value=11>November&nbsp;</OPTION> <OPTION 
            value=12>December</OPTION></SELECT> <FONT 
            face="Verdana, Arial, Helvetica, sans-serif" size=2>Year</FONT> 
            <SELECT size=1 name=dy1 disabled="disabled"> <OPTION value=1997 
              >1997&nbsp;</OPTION> <OPTION 
              value=1998>1998&nbsp;</OPTION> <OPTION 
              value=1999 >1999&nbsp;</OPTION> <OPTION 
              value=2000>2000&nbsp;</OPTION> <OPTION 
              value=2001>2001&nbsp;</OPTION> <OPTION 
              value=2002>2002&nbsp;</OPTION> <OPTION 
              value=2003 selected>2003&nbsp;</OPTION></SELECT> </TD>
                      </TR>
				  <TR>
                        <TD noWrap align=right><FONT face="Verdana, Arial" 
                  color=#000000 size=2>&nbsp;Report_Type:&nbsp;</FONT></TD>
                        <TD noWrap><FONT face="Verdana, Arial" color=#000000 
                  size=2>
                          <select name="reportBox" disabled="disabled">
                            <option value="visits">visits</option>
                            <option value="trends" selected>trends</option>
                          </select>
                          &nbsp;</FONT></TD>
                      </TR></TBODY></TABLE>
            <TABLE cellSpacing=0 cellPadding=2 width="100%" border=0>
              <TBODY>
              <TR>
                <TD colSpan=2><BR><IMG height=1 
                  src="http://localhost/images/pixel_black.gif" width="100%" 
                  border=0></TD></TR>
              <TR>
                <TD vAlign=top noWrap><!--<font face="Verdana, Arial" size="1" color="#000000">&nbsp;<label for="setcookie"><input type="checkbox" name="setcookie" value="1" id="setcookie" >&nbsp;Save login information in a cookie?</label>&nbsp;</font> --></TD>
                <TD><INPUT type=image 
                  src="/images/button_submit.gif" align=right 
                  value=login nowrap valign="top"></TD></TR>
              <TR>
                        <TD noWrap align=right colSpan=2>&nbsp;</TD>
                      </TR><!--          <tr>
            <td align="right" colspan="2" nowrap><font face="Verdana, Arial" size="1" color="#000000">&nbsp;<a href="http://www.nutrophy.com/catalog/create_account.php">No account with us? Click here to create one.</a>&nbsp;</font></td>
          </tr> --></TBODY></TABLE></FORM></TD></TR></TBODY></TABLE></TD><!-- body_text_eof //-->
    <TD vAlign=top align=left><IMG height=1 
      src="http://localhost/images/spacer(1).gif" width=1></TD>
    <TD vAlign=top width=121>
      <TABLE cellSpacing=0 cellPadding=0 width=121 border=0>
        <TBODY>
        <TR>
          <TD width="100%">
            <TABLE cellSpacing=0 cellPadding=2 width="100%" border=0><!-- right_navigation //-->
              <TBODY></TBODY></TABLE>
            <TABLE class=noprint height="100%" cellSpacing=0 cellPadding=0 
            width="100%" bgColor=#ffcc00 border=0 valign="top">
              <TBODY>
              <TR>
                <TD vAlign=top></TD></TR>
              <TR>
                <TD vAlign=top height="100%">
                  <TABLE cellSpacing=0 cellPadding=1 width=121 border=0 
                  valign="top">
                    <TBODY>
                    <TR>
                      <TD noWrap width=10>&nbsp;</TD>
                              <TD class=navMenuHeader>&nbsp;</TD>
                            </TR>
                    <TR>
                      <TD noWrap width=10>&nbsp;</TD>
                              <TD class=navMenuHeader>&nbsp;</TD>
                            </TR>
                    <TR>
                      <TD noWrap width=10>&nbsp;</TD>
                              <TD class=navMenuItem>&nbsp;</TD>
                            </TR>
                    <TR>
                      <TD noWrap width=10>&nbsp;</TD>
                              <TD class=navMenuItem>&nbsp;</TD>
                            </TR>
                    <TR>
                      <TD noWrap width=10>&nbsp;</TD>
                              <TD class=navMenuItem>&nbsp;</TD>
                            </TR>
                    <TR>
                      <TD noWrap width=10>&nbsp;</TD>
                              <TD class=navMenuItem>&nbsp;</TD>
                            </TR>
                    <TR>
                      <TD noWrap width=10>&nbsp;</TD>
                              <TD class=navMenuHeader>&nbsp;</TD>
                            </TR>
                    <TR>
                      <TD noWrap width=10>&nbsp;</TD>
                              <TD class=navMenuItem>&nbsp;</TD>
                            </TR>
                    <TR>
                      <TD noWrap width=10>&nbsp;</TD>
                              <TD class=navMenuItem>&nbsp;</TD>
                            </TR>
                    <TR>
                      <TD noWrap width=10>&nbsp;</TD>
                              <TD class=navMenuItem>&nbsp;</TD>
                            </TR>
                    <TR>
                      <TD noWrap width=10>&nbsp;</TD>
                              <TD class=navMenuHeader>&nbsp;</TD>
                            </TR>
                    <TR>
                      <TD noWrap width=10>&nbsp;</TD>
                              <TD class=navMenuHeader>&nbsp;</TD>
                            </TR>
                    <TR>
                      <TD noWrap width=10>&nbsp;</TD>
                              <TD class=navMenuHeader>&nbsp;</TD>
                            </TR>
                    <TR>
                      <TD noWrap width=10>&nbsp;</TD>
                              <TD class=navMenuItem>&nbsp;</TD>
                            </TR>
                    <TR>
                      <TD noWrap width=10>&nbsp;</TD>
                      <TD>&nbsp;</TD></TR>
                    <TR>
                      <TD noWrap 
                    width=10>&nbsp;</TD><!-- Buttons Start --></TR></TBODY></TABLE>
                  <TABLE cellSpacing=0 cellPadding=2 width=1 border=0>
                    <TBODY>
                    <TR>
                      <TD noWrap width=5>&nbsp;</TD>
                              <TD>&nbsp;</TD>
                              </A></TR></TBODY></TABLE><!-- Buttons End --></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE><!-- right_navigation_eof //--></TR></TBODY></TABLE></TD></TR></TABLE></TD></TR></TABLE><!-- body_eof //--><!-- footer //--><!-- footer_eof //--><BR></BODY></HTML>
