<?php
include "connection/connection.php";
	if(isset($_POST['Submit']))
	{
		$email = $_POST['email'];
		$passwd = md5($_POST['passwd']);
		$sql = "select * from company_admin_master where email_id = '$email' and status = 1";
		//echo $sql;exit;
		$rec = mysql_query($sql);
		//echo $rec;
		$row = mysql_num_rows($rec);
		//echo $row; exit;
		if($row > 0)
		{
			$res = mysql_fetch_assoc($rec);
			if($passwd == $res['password'])
			{
				session_start();
				$_SESSION['email_id'] = $email;
				$_SESSION['full_name'] = $res['admin_name'];
				$_SESSION['user_id'] = $res['admin_id'];
				$_SESSION['company_id'] = $res['company_id'];
				echo "<script>
						alert(' Admin Panle Welcomes You ');
						location.replace('dashboard.php');
				      </script>";
			}else{
			
				echo "<script>
						alert('Password Does Not Matched');
						location.replace('login.php?');
				      </script>";
			}
			
		}else{
			echo "<script>
					alert('Email Id Does Not Exist');
					location.replace('login.php?');
				  </script>";
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Locker Management | Log In</title>
<link rel="stylesheet" type="text/css"  href="css/all.css" />
<script type="text/javascript" language="javascript" src="js/all.js"></script>
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
      <form id="form1" name="form1" method="post" action="" onsubmit="return login_null_chk()">
        <table width="38%" border="0" class="inner_tab_index">
            <tr>
              <td height="30" colspan="2" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td width="9%" height="30" align="left">&nbsp;</td>
              <td width="91%" align="left">Email Id </td>
            </tr>
            <tr>
              <td height="30" colspan="2" align="center"><input name="email" type="text" class="inner_tab_index_txt_box" id="email" size="50" /></td>
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
            <td height="30" colspan="2" align="center"><table width="100%" border="0">
              <tr>
                <td width="66%" align="center">&nbsp;</td>
                <td width="34%" align="center" onclick="location.replace('index.php')"><table width="71%" height="37" border="0" align="left" class="inner_tab_index_login">
                    <tr>
                      <td align="center">Sign Up  </td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
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
