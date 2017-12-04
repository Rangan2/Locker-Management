<?php
session_start();
include "connection/connection.php";
if(isset($_GET['status']) && isset($_GET['off']))
{
	$status = base64_decode($_GET['status']);
	$office = base64_decode($_GET['off']);
	$office_sql = "update office_master set office_status='$status' where office_id='$office'";
	//echo $office_sql;exit;
	$office_rec = mysql_query($office_sql);
	$office_res = mysql_fetch_assoc($office_rec);
	$floor_sql = "update floor_master set floor_status='$status' where office_id='$office'";
	$floor_rec = mysql_query($floor_sql);
	$floor_res = mysql_fetch_assoc($floor_rec);	
	$office_admin_sql = "update office_admin_credentials_master set admin_status='$status' where office_id='$office'";
	$office_admin_rec = mysql_query($office_admin_sql);
	$office_admin_fetch_sql = "select * from office_admin_credentials_master where office_id = '$office'";
	$office_admin_fetch_rec = mysql_query($office_admin_fetch_sql);
	while($office_admin_fetch_res = mysql_fetch_assoc($office_admin_fetch_rec))
	{
		$assigned_floor_update_sql = "update office_admin_assigned_floor_number set assign_floor_status='$status' where credential_id = '$office_admin_fetch_res[credential_id]'";
		$assigned_floor_update_rec = mysql_query($assigned_floor_update_sql);
	}
	$locker_update_sql = "update locker_master set locker_active_status='$status' where office_id='$office'";
	$locker_update_rec = mysql_query($locker_update_sql);
	if($locker_update_rec)
	{
		echo "<script>
				alert('Office Status Updated')
				location.replace('company_details.php?');
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
        <td align="center"><table width="80%" border="0" cellpadding="0" cellspacing="0" class="dashboard_inner_tab">
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
		  <?php
		  	if(isset($_GET['office']) && !isset($_GET['admin']))
			{
				$office_id = base64_decode($_GET['office']);
				//$fetch_sql = "select * from office_admin_master where office_id = '$office_id' and admin_status = 1";
				$fetch_sql = "select * from office_admin_credentials_master where office_id = '$office_id'";
				//$url = "company_details.php?office=";
			}else if(isset($_GET['office']) && isset($_GET['admin']) && !isset($_GET['floor']))
			{
				$office_id = base64_decode($_GET['office']);
				$admin_id = base64_decode($_GET['admin']);
				$fetch_sql = "select * from office_admin_assigned_floor_number where credential_id = '$admin_id'";
			}
			elseif(isset($_GET['office']) && isset($_GET['floor']) && isset($_GET['admin']))
			{
				$admin_id = base64_decode($_GET['admin']);
				$floor_id = base64_decode($_GET['floor']);
				$office_id = base64_decode($_GET['office']);
				$fetch_sql = "select * from locker_master where added_by = '$admin_id' and floor_id = '$floor_id' and office_id = '$office_id'";
			}else{
		  		$fetch_sql = "select * from office_master where company_id = $_SESSION[company_id]";
				//@$url = "company_details.php?office=$fetch_res[office_id]";
			}
			//echo $fetch_sql;
			$fetch_rec = mysql_query($fetch_sql);
			$i = 1;
			while($fetch_res = mysql_fetch_assoc($fetch_rec))
			{
				if(isset($_GET['office']) && !isset($_GET['floor']) && !isset($_GET['admin']))
				{
					$office_id = base64_decode($_GET['office']);
					//$floor_id = base64_decode($_GET['floor']);
					//$url = "company_details.php?office=".base64_encode($office_id)."&admin=".base64_encode($fetch_res['admin_id']);
					$url = "company_details.php?office=".base64_encode($office_id)."&admin=".base64_encode($fetch_res['credential_id']);
					
				}elseif(isset($_GET['office']) && isset($_GET['admin']) && !isset($_GET['floor'])){
					$office_id = base64_decode($_GET['office']);
					$admin_id = base64_decode($_GET['admin']);
					$url = "company_details.php?office=".base64_encode($office_id)."&floor=".base64_encode($fetch_res['floor_id'])."&admin=".base64_encode($admin_id);
				}elseif(isset($_GET['office']) && isset($_GET['admin']) && isset($_GET['floor'])){
					$url = "";
				}elseif(!isset($_GET['office']) && !isset($_GET['floor']) && !isset($_GET['admin'])){
					$url = "company_details.php?office=".base64_encode($fetch_res['office_id']);
					//$admin_id = base64_decode($_GET['admin']);
				}
				//echo $url;
		  ?>
            <td align="center"><a  style="text-decoration:none; color:#999999" href="<?php echo $url; ?>" ><table width="65%" border="0" cellpadding="0" cellspacing="0" class="dashboard_all_menu">
              <tr>
                <td height="25" align="right">
				<?php
					if(!isset($_GET['office']) && !isset($_GET['floor']) && !isset($_GET['admin']))
					{
				?>
				<table width="300" border="0">
                  <tr>
                    <td width="68%" height="25">&nbsp;</td>
                    <td width="28%" align="right">
					<?php
						if($fetch_res['office_status'] == 1)
						{
					?>
					<a href="company_details.php?status=<?php echo base64_encode(0);?>&off=<?php echo base64_encode($fetch_res['office_id']);?>">
					<img src="images/green.gif" width="24" height="24" title="Click Here To Make The Office Offline" />
					</a>
					<?php
						}else{
					?>
					<a href="company_details.php?status=<?php echo base64_encode(1);?>&off=<?php echo base64_encode($fetch_res['office_id']);?>">
					<img src="images/red.gif" width="24" height="24" title="Click Here To Make The Office Online" />
					</a>
					<?php
						}
					?>					</td>
                    <td width="4%">&nbsp;</td>
                  </tr>
                </table>
				<?php
				}
				?>
				</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
			  <?php
			  	if(isset($_GET['office']) && !isset($_GET['floor']) && isset($_GET['admin'])){
			  	$floor_fetch_sql = "select * from floor_master where floor_id = '$fetch_res[floor_id]'";
				$floor_fetch_rec = mysql_query($floor_fetch_sql);
				$floor_fetch_res = mysql_fetch_assoc($floor_fetch_rec);
				}
			  ?>
              <tr>
                <td align="center"><?php if(isset($_GET['office']) && !isset($_GET['admin']) && !isset($_GET['floor'])){echo $fetch_res['admin_name']; }elseif(isset($_GET['office']) && isset($_GET['floor']) && isset($_GET['admin'])){echo $fetch_res['locker_number'];}elseif(isset($_GET['office']) && !isset($_GET['floor']) && isset($_GET['admin'])){echo $floor_fetch_res['floor_number'];}else{echo $fetch_res['office_location'];}?></td>
              </tr>
            	  <tr>
                <td height="15">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><?php if(isset($_GET['office']) && isset($_GET['floor']) && isset($_GET['admin'])){ if($fetch_res['locker_status'] == 1){echo "Key Not Received";}else{echo "Key Received";}} ?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
            </a></td>
			<?php
				
				if($i % 3 == 0)
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
