<?php
session_start();
include "connection/connection.php";
if(isset($_POST['Submit']))
{
	$oldpass = md5($_POST['oldpass']);
	$new_pass = md5($_POST['newpass']);
	$pass_sql = "select * from company_admin_master where company_id='$_SESSION[company_id]'";
	$pass_rec = mysql_query($pass_sql);
	//$pass_row = mysql_num_rows($pass_rec);
	$pass_res = mysql_fetch_assoc($pass_rec);
	if( $pass_res['password'] == $oldpass)
	{
		$update_password = "update company_admin_master set password='$new_pass' where company_id='$_SESSION[company_id]'";
		$update_password_rec = mysql_query($update_password);
		if($update_password_rec)
		{
			echo "<script>
					alert('Password Updated')
					location.replace('logout.php?');
			  	  </script>";
		}else{
			echo "<script>
					alert('Password Does Not Updated')
					location.replace('password.php?');
			  	  </script>";
		}
	}else{
		echo "<script>
				alert('Old Password Does Not Matched')
				location.replace('password.php?');
			  </script>";
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Locker Management | Dashboard</title>
<link rel="stylesheet" type="text/css" href="css/all.css" />
<script src="js/all.js" language="javascript" type="text/javascript"></script>

<body onload="startclock()">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"><table width="99%" border="0" cellpadding="0" cellspacing="0" class="dashboard_mid_row_tab">
      <tr>
        <td><?php  include "include/header.php"?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30" align="center"><table width="99%" border="0" align="left" cellpadding="0" cellspacing="0" class="dashboard_mid_row_tab">
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><form id="form1" name="form1" method="post" action="" onsubmit="return change_passwd_chk()">
          <table width="35%" border="0" class="inner_tab_index">
            <tr>
              <td height="25" colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr align="left">
              <td width="8%" height="25" >&nbsp;</td>
              <td width="92%" >Old Password </td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center"><input name="oldpass" type="password" class="inner_tab_index_txt_box" id="oldpass" size="50" /></td>
            </tr>




            <tr align="left">
              <td height="25">&nbsp;</td>
              <td height="25">New Password</td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center"><input name="newpass" type="password" class="inner_tab_index_txt_box" id="newpass" size="50" /></td>
            </tr>
            <tr align="left">
              <td height="25">&nbsp;</td>
              <td height="25">Re-Type New Password </td>
            </tr>
            <tr align="left">
              <td height="25" colspan="2" align="center"><input name="rnewpass" type="password" class="inner_tab_index_txt_box" id="rnewpass" size="50" /></td>
            </tr>




            <tr>
              <td height="10" colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td height="10" colspan="2" align="center"><input name="Submit" type="submit" class="btn" id="Submit" value="Change" /></td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center">&nbsp;</td>
            </tr>
          </table>
        </form>
        </td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
</table>
</body>
</html>
