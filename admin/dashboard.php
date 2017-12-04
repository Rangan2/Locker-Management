<?php
session_start();
//echo "Email : ".$_SESSION['email_id'].", Full Name : ".$_SESSION['full_name'].", Admin Id : ".$_SESSION['admin_id'].", Company Id : ".$_SESSION['company_id'].", Office Id : ".$_SESSION['office_id'].", Floor Id : ".$_SESSION['floor_id']; 
include "../connection/connection.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Locker Management | Dashboard</title>
<link rel="stylesheet" type="text/css" href="../css/all.css" />
<script src="../js/all.js" language="javascript" type="text/javascript"></script>

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
        <td align="center"><table width="80%" border="0" cellpadding="0" cellspacing="0" class="dashboard_inner_tab">
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
		  <?php
		  	if(isset($_GET['menu_id']))
			{
				$menu_id = base64_decode($_GET['menu_id']);
				$menu_sql = "select * from site_admin_menu_master where company_id = $_SESSION[company_id] and menu_status = 1 and menu_parent = $menu_id";
			}else{
		  		$menu_sql = "select * from site_admin_menu_master where menu_status = 1 and menu_parent = 0";
			}
			$menu_rec = mysql_query($menu_sql);
			$i = 1;
			while($menu_res = mysql_fetch_assoc($menu_rec))
			{
		  ?>
            <td align="center"><table width="300" border="0" cellpadding="0" cellspacing="0" class="dashboard_all_menu">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><a style="text-decoration:none; color:#999999" href="<?php if($menu_res['menu_link'] == '#'){echo "dashboard.php?company_id=".base64_encode($_SESSION['company_id'])."&menu_id=".base64_encode($menu_res['menu_id']);}else{echo $menu_res['menu_link'];}?>"><?php echo $menu_res['menu_name'];?></a></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
			<?php
				
				if($i % 2 == 0)
				{
					echo "</tr><td height='20'>&nbsp;</td><tr>";
				}
				$i++;
			}
			?>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
        </table></td>
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
