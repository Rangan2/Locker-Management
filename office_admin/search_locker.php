<?php
session_start();
	include "../connection/connection.php";
if(isset($_GET['status']))
{
	$locker_id = base64_decode($_GET['locker']);
	$status = base64_decode($_GET['status']);
	$update_status_sql = "update locker_assign set assignment_status='$status' where locker_id='$locker_id'";
	//echo $update_status_sql;exit;
	$update_status_rec = mysql_query($update_status_sql);
	if($update_status_rec)
	{
		echo "<script>
				alert('Locker Status Updated')
				location.replace('search_locker.php?');
			 </script>";
	}else{
		echo "<script>
				alert('Locker Status Does Not Updated')
				location.replace('search_locker.php?');
			 </script>";
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Locker Details | Search Locker</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/all.css" />
<script src="../js/all.js" language="javascript" type="text/javascript"></script>
<body>
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
        <td align="right"><input type="hidden" name="officeId" id="officeId" value="<?php echo $_SESSION['office_id'];?>" /></td>
      </tr>
      <?php
  	$locker_fetch_sql = "select * from locker_master where added_by='$_SESSION[admin_id]'";
	$locker_fetch_rec = mysql_query($locker_fetch_sql);
	$locker_fetch_num_rows = mysql_num_rows($locker_fetch_rec);
	if($locker_fetch_num_rows > 0)
	{
  ?>
      <tr>
        <td height="30" align="center"><table width="80%" border="0">
          <tr>
            <td width="79%" height="30" align="center" class="lsit_head"><table width="100%" border="0">
              <tr>
                <td width="3%">&nbsp;</td>
                <td width="37%" align="left">Locker Search </td>
                <td width="60%" align="center"><table width="100%" border="0">
                  <tr>
                    <td width="22%" align="right">Floor Number </td>
                    <td width="5%" align="center">:</td>
                    <td width="21%"><select name="floor" class="inner_tab_index_txt_box" id="floor" style=" width:100px"  onchange="search_locker()" >
                      <option value="0">... Select ...</option>
             <?php
			 	$floor_id_arr = explode(",",$_SESSION['floor_id']);
				for($i = 0; $i < count($floor_id_arr); $i++)
				{
			 	 	$floor_list_sql = "select * from floor_master where office_id='$_SESSION[office_id]' and floor_id = '$floor_id_arr[$i]' and floor_status=1";
					$floor_list_rec = mysql_query($floor_list_sql);
					$floor_list_res = mysql_fetch_assoc($floor_list_rec)
			  ?>
                      <option value="<?php echo $floor_list_res['floor_id'];?>"><?php echo $floor_list_res['floor_number'];?></option>
                      <?php
				}
				?>
                    </select></td>
                    <td width="23%" align="center">Locker Number </td>
                    <td width="4%" align="center">:</td>
                    <td width="25%"><input name="locker_number" type="text" class="inner_tab_index_txt_box" id="locker_number" size="20" onkeyup="search_locker()" /></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="30" align="center"><div id="showList"><?php include "search_locker_list.php";?></div></td>
          </tr>
        </table></td>
      </tr>
      <?php
  	}
  ?>
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
</table>
</body>
</html>
