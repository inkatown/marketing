<tr>
  <td width='25%'><a href='<?php printf("$mphpself?ntt=2&view=yes&main_id=$record_id1")?>'>
  <img border='0' src='images/trackingvieweditbutton.jpg' width='76' height='15'></a></td>
  <td width='25%'><?php echo $myrow['c_code']?></td>
  <td width='25%'><?php echo $myrow['c_name']?></td>
  <td width='25%' align='right'>
<?php

/* Attention this is NOT open source software and is protected under 
the copyright act. Copyright (c) 2003 J.Quijano Hacix Inc.
Licensee: Nutrophy Inc.
*/

    if ($seclevel>3){
    ?>
      <a href='<?php printf("$mphpself?ntt=2&delete=yes&main_id=$record_id1")?>'>
      <img border='0' src='images/trackingdeletebutton.jpg' width='68' height='15'></a></td>
    <?php
    }
?>
</tr>
