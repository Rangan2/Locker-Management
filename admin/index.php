<?php
include "../connection/connection.php";
	if(isset($_POST['Submit']))
	{
		$user_name = $_POST['user_name'];
		$passwd = md5($_POST['passwd']);
		$site_admin_login_sql = "select * from site_admin_login_master where user_name = '$user_name'";
		//echo $sql;exit;
		$site_admin_login_rec = mysql_query($site_admin_login_sql);
		//echo $rec;
		$site_admin_login_row = mysql_num_rows($site_admin_login_rec);
		//echo $row; exit;
		if($site_admin_login_row > 0)
		{
			$site_admin_login_res = mysql_fetch_assoc($site_admin_login_rec);
			if($passwd == $site_admin_login_res['password'])
			{
				//echo $floor_id;exit;
				session_start();
				$_SESSION['full_name'] = $site_admin_login_res['full_name'];
				$_SESSION['admin_id'] = $site_admin_login_res['login_id'];
				echo "<script>
						alert(' Admin Panle Welcomes You ');
						location.replace('dashboard.php');
				      </script>";
			}else{
			
				echo "<script>
						alert('Password Does Not Matched');
						location.replace('index.php?');
				      </script>";
			}
			
		}else{
			echo "<script>
					alert('User Name Does Not Exist');
					location.replace('index.php?');
				  </script>";
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Locker Management | Log In</title>
<link rel="stylesheet" type="text/css"  href="../css/all.css" />
<script type="text/javascript" language="javascript" src="../js/all.js"></script>
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="index_heading">Log In </td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="index_heading_second_row">Sign In To Your Account </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><blockquote>
      <form id="form1" name="form1" method="post" action="" onsubmit="return chk_admin_login()">
        <table width="38%" border="0" class="inner_tab_index">
            <tr>
              <td height="30" colspan="2" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td width="9%" height="30" align="left">&nbsp;</td>
              <td width="91%" align="left">User Name </td>
            </tr>
            <tr>
              <td height="30" colspan="2" align="center"><input name="user_name" type="text" class="inner_tab_index_txt_box" id="user_name" size="50" /></td>
            </tr>
          <tr>
            <td height="30" align="right">&nbsp;</td>
            <td height="30" align="left">Password</td>
          </tr>
          <tr>
            <td height="30" colspan="2" align="center"><input name="passwd" type="password" class="inner_tab_index_txt_box" id="passwd" size="50" /></td>
            </tr>
          <tr>
            <td height="10" colspan="2" align="center">&nbsp;</td>
          </tr>
          <tr>
            <td height="30" colspan="2" align="center"><input name="Submit" type="submit" class="btn" value="Log In" /></td>
          </tr>
          <tr>
            <td height="30" colspan="2" align="center">&nbsp;</td>
          </tr>
          <tr>
            <td height="30" colspan="2" align="center">&nbsp;</td>
          </tr>
          </table>
        </form>
    </blockquote></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
