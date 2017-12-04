<?php
session_start();
	include "../connection/connection.php";
	if(isset($_POST['Submit']))
	{
		$floor_num = $_POST['fnum'];
		$off_locker = $_POST['off_locker'];
		$off_locker_Array = explode(",", $off_locker);
		$locker_fetch_sql = "select * from locker_master where locker_number='$off_locker' and floor_id=$floor_num";
		//echo $locker_fetch_sql;exit;
		$locker_fetch_rec = mysql_query($locker_fetch_sql);
		$locker_fetch_num = mysql_num_rows($locker_fetch_rec);
		if($_POST['Submit'] == "Enter")
		{
			$office_location = $_POST['office_location'];
			if($locker_fetch_num > 0)
			{
				echo "<script>
						alert('Locker Already Exist')
						location.replace('add_locker.php?');
					  </script>";
			}else{
				$count = 0;
				$locker_number = 0;
				for($i = 0; $i < count($off_locker_Array); $i++)
				{
					$locker_sql = "insert into locker_master(office_id, floor_id, locker_number, added_by) values('$office_location', '$floor_num', '$off_locker_Array[$i]', '$_SESSION[admin_id]')";
					$locker_rec = mysql_query($locker_sql);
					if($locker_rec)
					{
						$count++;
					}else{
						$locker_number = $off_locker_Array[$i];
						break;
					}
				}
				if($count == count($off_locker_Array))
				{
					echo "<script>
							alert('All Locker Details Added')
							location.replace('add_locker.php?');
					  	  </script>";
				}else{
					echo "<script>
							alert('Locker Details Added Till Locker Number : '+$locker_number)
							location.replace('add_locker.php?');
					  	  </script>";
				}
				
			}
		}elseif($_POST['Submit'] == "Edit"){
		$locker_id = base64_decode($_GET['locker']);
		if($locker_fetch_num > 0)
		{
			echo "<script>
					alert('Locker Details Already Added')
					location.replace('add_locker.php?');
				  </script>";
		}else{
			$update_locker_sql = "update locker_master set floor_id = '$floor_num', locker_number='$off_locker' where locker_id='$locker_id'";	
			$update_locker_rec = mysql_query($update_locker_sql);
			if($update_locker_rec)
			{
				echo "<script>
						alert('Locker Details Updated Successfully')
						location.replace('add_locker.php?');
					  </script>";
			}else{
			
				echo "<script>
						alert('Locker Details Does Not Updated Successfully')
						location.replace('add_locker.php?');
					  </script>";
			}
		}
	}
}
if(isset($_GET['locker']))
{
	$locker_id = base64_decode($_GET['locker']);
	$locker_fetch_sql = "select * from locker_master where locker_id='$locker_id'";
	//echo $office_add_sql;
	$locker_fetch_rec = mysql_query($locker_fetch_sql);
	$locker_fetch_res = mysql_fetch_assoc($locker_fetch_rec);
	$floor_fetch_sql = "select * from floor_master where floor_id='$locker_fetch_res[floor_id]'";
	$floor_fetch_rec = mysql_query($floor_fetch_sql);
	$floor_fetch_res = mysql_fetch_assoc($floor_fetch_rec);
}
if(isset($_GET['delLocker']))
{
	$locker_id = base64_decode($_GET['delLocker']);
	$del_locker_sql = "delete from locker_master where locker_id = '$locker_id' and locker_status=1";
	$del_locker_rec = mysql_query($del_locker_sql);
	if($del_locker_rec)
	{
		echo "<script>
				alert('Locker Details Deleted')
				location.replace('add_locker.php?');
			 </script>";
	}else{
		
		echo "<script>
				alert('Locker Details Cannot be deleted Cause It is Already Assigned')
				location.replace('add_locker.php?');
			 </script>";
	}
}

if(isset($_GET['status']))
{
	$locker_id = base64_decode($_GET['locker']);
	$status = base64_decode($_GET['status']);
	$update_status_sql = "update locker_master set locker_status='$status' where locker_id='$locker_id'";
	$update_status_rec = mysql_query($update_status_sql);
	if($update_status_rec)
	{
		echo "<script>
				alert('Locker Status Updated')
				location.replace('add_locker.php?');
			 </script>";
	}else{
		echo "<script>
				alert('Locker Status Does Not Updated')
				location.replace('add_locker.php?');
			 </script>";
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Locker Details | Add Locker</title>
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
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><form id="form1" name="form1" method="post" action="" onsubmit="return add_locker_chk()">
          <table width="35%" border="0" class="inner_tab_index">
            <tr>
              <td height="25" colspan="2" align="center">&nbsp;</td>
            </tr>
			<?php
				if(!isset($_GET['locker']))
				{
			?>
            <tr align="left">
              <td width="8%" height="25" >&nbsp;</td>
              <td width="92%" >Office Location </td>
            </tr>
			<?php
				//echo $_SESSION['office_id'];
				$office_sql = "select * from office_master where office_id='$_SESSION[office_id]'";
				//echo $office_sql;
				$office_rec = mysql_query($office_sql);
				$office_res = mysql_fetch_assoc($office_rec);
			?>
            <tr>
              <td height="25" colspan="2" align="center"><select name="office_location" class="inner_tab_index_txt_box" id="office_location" style=" width:380px" >
                <option value="<?php echo $office_res['office_id'];?>" selected="selected"><?php echo $office_res['office_location'];?></option>
              </select></td>
            </tr>
			<?php
				}
			?>
            <tr align="left">
              <td height="25">&nbsp;</td>
              <td height="25">Floor Number</td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center"><select name="fnum" class="inner_tab_index_txt_box" id="fnum" style=" width:380px" >
                <option value="0">... Select ...</option>
				<?php
				$floor_id_arr = explode(",",$_SESSION['floor_id']);
				
				for($i = 0; $i < count($floor_id_arr); $i++)
				{
					$floor_sql = "select * from floor_master where office_id='$_SESSION[office_id]' and floor_id = '$floor_id_arr[$i]' and floor_status=1";
					$floor_rec = mysql_query($floor_sql);
					$floor_res = mysql_fetch_assoc($floor_rec)
			  ?>
                <option value="<?php echo $floor_res['floor_id'];?>" <?php if(@$floor_fetch_res['floor_id'] == @$floor_res['floor_id']){echo "selected";}?>><?php echo $floor_res['floor_number'];?></option>
				<?php
				}
				?>
              </select></td>
            </tr>
            <tr align="left">
              <td height="25">&nbsp;</td>
              <td height="25">Locker Numbers </td>
            </tr>
            <tr align="left">
              <td height="25" colspan="2" align="center"><input name="off_locker" type="text" class="inner_tab_index_txt_box" id="off_locker" size="50" placeholder="Enter Locker Numbers  Using ',' Separated Value" value="<?php echo @$locker_fetch_res['locker_number'];?>"/></td>
            </tr>
            <tr>
              <td height="10" colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td height="10" colspan="2" align="center"><input name="Submit" type="submit" class="btn" id="Submit" value="<?php if(isset($_GET['locker'])){echo "Edit";}else{echo "Enter";}?>" /></td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center">&nbsp;</td>
            </tr>
          </table>
        </form></td>
      </tr>
      <?php
  	$locker_fetch_sql = "select * from locker_master where added_by='$_SESSION[admin_id]'";
	$locker_fetch_rec = mysql_query($locker_fetch_sql);
	$locker_fetch_num_rows = mysql_num_rows($locker_fetch_rec);
	if($locker_fetch_num_rows > 0)
	{
  ?>
      <tr>
        <td height="30" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" align="center"><table width="80%" border="0">
          <tr>
            <td width="79%" height="30" align="center" class="lsit_head"><table width="100%" border="0">
              <tr>
                <td width="32%">&nbsp;</td>
                <td width="39%" align="center">L I S T </td>
                <td width="29%" align="center"><table width="100%" border="0">
                  <tr>
                    <td width="52%" align="right">Search By Floor </td>
                    <td width="7%" align="center">:</td>
                    <td width="41%"><select name="floor" class="inner_tab_index_txt_box" id="floor" style="width:100px" onchange="chk_locker_list()" >
                      <option value="0">... Select ...</option>
             <?php
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
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="30" align="center"><div id="showList"><?php include "find_locker_list.php";?></div></td>
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
