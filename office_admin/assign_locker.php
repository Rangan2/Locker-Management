<?php
session_start();
	include "../connection/connection.php";
	if(isset($_POST['Submit']))
	{
		$officeloc = $_POST['officeloc'];
		$floor_num = $_POST['fnum'];
		$locker_num = $_POST['locker_num'];
		$emp_id = $_POST['emp_id'];
		$emp_name = $_POST['emp_name'];	
		$locker_fetch_sql = "select * from locker_assign where locker_id= '$locker_num' and floor_id = '$floor_num' and assignment_status = 1";
		//echo $locker_fetch_sql;exit;
		$locker_fetch_rec = mysql_query($locker_fetch_sql);
		$locker_fetch_num = mysql_num_rows($locker_fetch_rec);
		if($_POST['Submit'] == "Enter")
		{
			$locker_assign_sql = "insert into locker_assign(office_id, floor_id, locker_id, emp_name, emp_id) values('$officeloc', '$floor_num', '$locker_num', '$emp_name', '$emp_id')";
			$locker_assign_rec = mysql_query($locker_assign_sql);
			if($locker_assign_rec)
			{
				$locker_status_update_sql = "update locker_master set locker_status = 0 where office_id = '$officeloc' and floor_id = '$floor_num' and locker_id = '$locker_num'";
				//echo $locker_status_update_sql;exit;
				$locker_status_update_rec = mysql_query($locker_status_update_sql);
				if($locker_status_update_rec)
				{
					echo "<script>
								alert('Locker Details Asaigned')
								location.replace('assign_locker.php?');
					  	  </script>";
				}
				
			}else{
			
				echo "<script>
						alert('Locker Not Asaigned')
						location.replace('assign_locker.php?');
					  </script>";
				
			}
		}elseif($_POST['Submit'] == "Edit"){
		$assign_id = base64_decode($_GET['assign']);
		$update_assign_sql = "update locker_assign set floor_id = '$floor_num' , locker_id = '$locker_num' , emp_name = '$emp_name' , emp_id = '$emp_id' where assign_id = '$assign_id'";	
		//echo $update_assign_sql;exit;
		$update_assign_rec = mysql_query($update_assign_sql);
		if($update_assign_rec)
		{
				echo "<script>
						alert('Locker Details Updated Successfully')
						location.replace('assign_locker.php?');
					  </script>";
		}else{
			
				echo "<script>
						alert('Locker Details Does Not Updated Successfully')
						location.replace('assign_locker.php?');
					  </script>";
		}
	}
}
if(isset($_GET['assign']))
{
	$assign_id = base64_decode($_GET['assign']);
	$assign_fetch_sql = "select * from locker_assign where assign_id='$assign_id'";
	//echo $office_add_sql;
	$assign_fetch_rec = mysql_query($assign_fetch_sql);
	$assign_fetch_res = mysql_fetch_assoc($assign_fetch_rec);
	$floor_fetch_sql = "select * from floor_master where floor_id='$assign_fetch_res[floor_id]'";
	//echo $floor_fetch_sql;exit;
	$floor_fetch_rec = mysql_query($floor_fetch_sql);
	$floor_fetch_res = mysql_fetch_assoc($floor_fetch_rec);
}
if(isset($_GET['delAssign']))
{
	$assign_id = base64_decode($_GET['delAssign']);
	$locker_id_fetch_sql = "select * from locker_assign where assign_id = '$assign_id'";
	$locker_id_fetch_rec = mysql_query($locker_id_fetch_sql);
	$locker_id_fetch_res = mysql_fetch_assoc($locker_id_fetch_rec);
	$update_locker_status_sql = "update locker_master set locker_status = 1 where locker_id = '$locker_id_fetch_res[locker_id]'";
	$update_locker_status_rec = mysql_query($update_locker_status_sql);
	if($update_locker_status_rec)
	{
		$del_assign_sql = "delete from locker_assign where assign_id = '$assign_id'";
		$del_assign_rec = mysql_query($del_assign_sql);
		if($del_assign_rec)
		{
			echo "<script>
					alert('Locker Details Deleted')
					location.replace('assign_locker.php?');
				 </script>";
		}else{
			
			echo "<script>
					alert('Locker Details Cannot be deleted')
					location.replace('assign_locker.php?');
				 </script>";
		}
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
        <td align="center"><form id="form1" name="form1" method="post" action="" onsubmit="return assign_locker_chk_null()">
          <table width="35%" border="0" class="inner_tab_index">
            <tr>
              <td height="25" colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr align="left">
              <td width="8%" height="25" >&nbsp;</td>
              <td width="92%" >Office Location </td>
            </tr>
			<?php
				//echo $_SESSION['office_id'];
				$office_sql = "select * from office_master where office_id='$_SESSION[office_id]'";
				//echo $office_sql;
				$office_rec = mysql_query($office_sql);
			?>
            <tr>
              <td height="25" colspan="2" align="center"><select name="officeloc" class="inner_tab_index_txt_box" id="officeloc" style=" width:380px" onchange="chk_floor()">
				<?php
					while($office_res = mysql_fetch_assoc($office_rec))
					{
				?>
				<option value="<?php echo $office_res['office_id'];?>" ><?php echo $office_res['office_location'];?></option>
				<?php
					}
				?>
              </select></td>
            </tr>
            <tr align="left">
              <td height="25">&nbsp;</td>
              <td height="25">Floor Number</td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center"><select name="fnum" class="inner_tab_index_txt_box" id="fnum" style=" width:380px"  onchange="find_locker()">
                <option value="0">... Select ...</option>
                <?php
					$floor_id_arr = explode(",",$_SESSION['floor_id']);
					for($i = 0; $i < count($floor_id_arr); $i++)
					{
						$sql = "select * from floor_master where office_id='$_SESSION[office_id]' and floor_id = '$floor_id_arr[$i]' and floor_status = 1 ";
						//echo $sql;
						$rec = mysql_query($sql);
  						$res = mysql_fetch_assoc($rec)
 				?>
                <option value="<?php echo $res['floor_id'];?>" <?php if(@$floor_fetch_res['floor_id']==@$res['floor_id']){echo "selected";}?>>
                  <?php if($res['floor_number'] == 0){echo "All";}else{ echo $res['floor_number'];}?>
                  </option>
                <?php
  					}
 				 ?>
              </select></td>
            </tr>
            <tr align="left">
              <td height="25">&nbsp;</td>
              <td height="25">Locker Number</td>
            </tr>
            <tr align="left">
              <td height="25" colspan="2" align="center"><div id="lockerList"><?php include "find_locker.php";?></div></td>
            </tr>
            <tr align="left">
              <td height="25">&nbsp;</td>
              <td height="25">Employee Id </td>
            </tr>
            <tr align="left">
              <td height="25">&nbsp;</td>
              <td height="25"><input name="emp_id" type="text" class="inner_tab_index_txt_box" id="emp_id" size="50" value="<?php echo @$assign_fetch_res['emp_id'];?>" placeholder="Enter The Employee Id"/></td>
            </tr>
            <tr align="left">
              <td height="25">&nbsp;</td>
              <td height="25">Employee Name </td>
            </tr>
            <tr align="left">
              <td height="25">&nbsp;</td>
              <td height="25"><input name="emp_name" type="text" class="inner_tab_index_txt_box" id="emp_name" size="50" value="<?php echo @$assign_fetch_res['emp_name'];?>" placeholder="Enter The Employee Name"/></td>
            </tr>
            <tr>
              <td height="10" colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td height="10" colspan="2" align="center"><input name="Submit" type="submit" class="btn" id="Submit" value="<?php if(isset($_GET['assign'])){echo "Edit";}else{echo "Enter";}?>" /></td>
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
        <td height="30" align="center"><table width="90%" border="0">
          <tr>
            <td width="79%" height="30" align="center" class="lsit_head"><table width="100%" border="0">
              <tr>
                <td width="32%">&nbsp;</td>
                <td width="39%" align="center">L I S T </td>
                <td width="29%" align="center"><table width="100%" border="0">
                  <tr>
                    <td width="52%" align="right">Search By Floor </td>
                    <td width="7%" align="center">:</td>
                    <td width="41%"><select name="floor" class="inner_tab_index_txt_box" id="floor" style=" width:100px"  onchange="search_locker()" >
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
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="30" align="center"><div id="showList"><?php include "locker_assign_list.php";?></div></td>
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
