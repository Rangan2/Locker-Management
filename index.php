<?php
include "connection/connection.php";
	if(isset($_POST['Submit']))
	{
		$full_name = $_POST['fname'];
		$company_name = $_POST['cname'];
		$company_email = $_POST['cemail'];
		$password = md5($_POST['password']);
		$company_field = $_POST['cfield'];
		$location = $_POST['location'];
		
		list($email_first_part, $email_second_part) = explode("@",$company_email);
		
		$company_admin_fetch = "select * from  company_admin_master";
		//echo $company_admin_fetch;exit;
		$company_admin_rec = mysql_query($company_admin_fetch);
		$company_admin_num_rows = mysql_num_rows($company_admin_rec );
		$company_fetch = "select * from company_master";
		$company_fetch_rec = mysql_query($company_fetch);
		$company_fetch_row = mysql_num_rows($company_fetch_rec);
		if($company_admin_num_rows > 0 && $company_fetch_row > 0)
		{
			while($company_admin_res = mysql_fetch_assoc($company_admin_rec))
			{
				$each_email_id = $company_admin_res['email_id'];
				list($each_email_id_first, $each_email_id_last) = explode("@", $each_email_id);
				if($email_second_part == $each_email_id_last)
				{
					echo "<script>
							alert('Your Company Already Registered')
							location.replace('index.php?');
						  </script>";
				}else{
				
					$insert_record = "insert into company_master(company_name, company_field, company_location) values('$company_name', '$company_field', '$location')";
					$insert_record_query = mysql_query($insert_record);
					if($insert_record_query)
					{
						
						$last_inserted_key = mysql_insert_id();
						$company_adming_register = "insert into company_admin_master(company_id, admin_name, email_id, password) values('$last_inserted_key', '$full_name', '$company_email', '$password')";
						$company_adming_register_query = mysql_query($company_adming_register);
						
						if($company_adming_register_query)
						{
							echo "<script>
									alert('Thank You For Registering , Your Account will activate after verification ')
									location.replace('index.php?');
								 </script>";
						}else{
						
							echo "<script>
									alert('Your Company Not Registered Properly')
									location.replace('index.php?');
						  		  </script>";
						}
					}else{
					
						echo "<script>
								alert('Your Company Not Registered Properly')
								location.replace('index.php?');
						  	</script>";
					} 
				}
			}
		}else{
			//echo "Inside Else";
				
				$insert_record = "insert into company_master(company_name, company_field, company_location) values('$company_name', '$company_field', '$location')";
					$insert_record_query = mysql_query($insert_record);
					//echo "Company insert Id : ".$insert_record_query;exit;
					if($insert_record_query)
					{
						//echo "Inside if";exit;						
						$last_inserted_key = mysql_insert_id();
						$company_adming_register = "insert into company_admin_master(company_id, admin_name, email_id, password) values('$last_inserted_key', '$full_name', '$company_email', '$password')";
						//echo $company_adming_register;exit;
						$company_adming_register_query = mysql_query($company_adming_register);
						
						if($company_adming_register_query)
						{
							echo "<script>
									alert('Thank You For Registering , Your Account will activate after verification ')
									location.replace('index.php?');
								 </script>";
						}else{
						
							echo "<script>
									alert('Your Company's Admin Does Not Registered Properly')
									location.replace('index.php?');
						  		  </script>";
						}
				}else{
					
						echo "<script>
								alert('Your Company Not Registered Properly')
								location.replace('index.php?');
						  	</script>";
				} 
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Locker Management | Index</title>
<link rel="stylesheet" type="text/css"  href="css/all.css" />
<script type="text/javascript" language="javascript" src="js/all.js"></script>
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td align="center"><span class="index_heading">Create Account</span></td>
  </tr>
  <tr>
    <td align="center"><span class="index_heading_second_row">Manage Locker Details </span></td>
  </tr>
  <tr>
    <td align="center" class="index_heading">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><form id="form1" name="form1" method="post" action="" onsubmit="return chk_null_register()">
	<blockquote>
      <table width="35%" border="0" class="inner_tab_index">
        <tr>
          <td height="25" colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr align="left">
          <td width="5%" height="25" >&nbsp;</td>
          <td width="95%" >Full Name</td>
        </tr>
        <tr>
          <td height="25" colspan="2" align="center"><input name="fname" type="text" class="inner_tab_index_txt_box" id="fname" size="50" /></td>
        </tr>
        <tr align="left">
          <td height="25">&nbsp;</td>
          <td height="25">Company Name </td>
        </tr>
        <tr>
          <td height="25" colspan="2" align="center"><input name="cname" type="text" class="inner_tab_index_txt_box" id="cname" size="50" /></td>
        </tr>
        <tr align="left">
          <td height="25">&nbsp;</td>
          <td height="25">Company Email Id </td>
        </tr>
        <tr>
          <td height="25" colspan="2" align="center"><input name="cemail" type="text" class="inner_tab_index_txt_box" id="cemail" size="50" /></td>
        </tr>
        <tr align="left">
          <td height="25">&nbsp;</td>
          <td height="25">Password</td>
        </tr>
        <tr>
          <td height="25" colspan="2" align="center"><input name="password" type="password" class="inner_tab_index_txt_box" id="password" size="50" /></td>
        </tr>
        <tr align="left">
          <td height="25">&nbsp;</td>
          <td height="25">Re-Type Password </td>
        </tr>
        <tr align="left">
          <td height="25" colspan="2" align="center"><input name="repassword" type="password" class="inner_tab_index_txt_box" id="repassword" size="50" /></td>
        </tr>
        <tr align="left">
          <td height="25">&nbsp;</td>
          <td height="25">Company Filed of Work </td>
        </tr>
        <tr>
          <td height="25" colspan="2" align="center"><input name="cfield" type="text" class="inner_tab_index_txt_box" id="cfield" size="50" /></td>
        </tr>
        <tr align="left">
          <td height="25">&nbsp;</td>
          <td height="25">Location</td>
        </tr>
        <tr>
          <td height="25" colspan="2" align="center"><input name="location" type="text" class="inner_tab_index_txt_box" id="location" size="50" /></td>
        </tr>
        <tr>
          <td height="10" colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td height="10" colspan="2" align="center"><input name="Submit" type="submit" class="btn"  value="Register" /></td>
        </tr>
        <tr>
          <td height="25" colspan="2" align="center"><table width="100%" border="0">
              <tr>
                <td width="65%" align="center">&nbsp;</td>
                <td width="35%" align="center" onclick="location.replace('login.php')"><table width="73%" height="37" border="0" class="inner_tab_index_login">
                    <tr>
                      <td align="center">Log In </td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="25" colspan="2" align="center">&nbsp;</td>
        </tr>
      </table>
	  </blockquote>
    </form></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
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
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
