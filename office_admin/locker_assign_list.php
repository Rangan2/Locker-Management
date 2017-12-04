<?php
@session_start();
	include "../connection/connection.php";
	if(isset($_GET['floorId']))
	{
		$floor_id = $_GET['floorId'];
		if($floor_id == 0)
		{
			$locker_fetch_sql = "select * from locker_master where added_by = '$_SESSION[admin_id]'";
		}else{
			$locker_fetch_sql = "select * from locker_master where added_by = '$_SESSION[admin_id]' and floor_id='$floor_id'";
		}
	}else{
		$locker_fetch_sql = "select * from locker_assign where office_id = '$_SESSION[office_id]'";
	}
	$locker_fetch_rec = mysql_query($locker_fetch_sql);


/*$locker_assign_fetch_sql = "";
$locker_assign_fetch_rec = mysql_query($locker_assign_fetch_sql);
$locker_assign_fetch_res = mysql_fetch_assoc($locker_assign_fetch_rec);*/

?>
<table width="100%" border="0">
  <tr class="list_sec_row">
    <td width="6%" align="center">Sl . No . </td>
    <td width="17%" height="30" align="center">Office Location</td>
    <td width="8%" align="center">Floor Number  </td>
    <td width="10%" align="center">Locker Number </td>
    <td width="16%" align="center">Employee Name </td>
    <td width="10%" align="center">Employee Id </td>
    <td width="16%" align="center">Status</td>
    <td width="17%" align="center">Options</td>
  </tr>
  <?php
	  	$i = 1;
	  	while($locker_fetch_res = mysql_fetch_assoc($locker_fetch_rec))
		{
			if($i % 2 == 0)
			{
				$bg = "bgcolor=#E1E1E1";	
			}else{
				$bg = "bgcolor=#B9B9B9";
			}
			$office_fetch_sql = "select * from office_master where office_id = '$locker_fetch_res[office_id]'";
			$office_fetch_rec = mysql_query($office_fetch_sql);
			$office_fetch_res = mysql_fetch_assoc($office_fetch_rec);
			$floor_fetch_sql = "select * from floor_master where floor_id='$locker_fetch_res[floor_id]'";
			$floor_fetch_rec = mysql_query($floor_fetch_sql);
			$floor_fetch_res = mysql_fetch_assoc($floor_fetch_rec);
			$locker_master_fetch_sql = "select * from locker_master where locker_id = $locker_fetch_res[locker_id]";
			//echo $locker_master_fetch_sql;exit;
			$locker_master_fetch_rec = mysql_query($locker_master_fetch_sql);
			$locker_master_fetch_res = mysql_fetch_assoc($locker_master_fetch_rec);
			
	  ?>
  <tr class="list_dyn_row" <?php echo $bg;?>>
    <td height="30" align="center"><?php echo $i;?></td>
    <td height="30" align="center"><?php echo $office_fetch_res['office_location'];?></td>
    <td height="30" align="center"><?php echo $floor_fetch_res['floor_number'];?></td>
    <td align="center"><?php echo $locker_master_fetch_res['locker_number'];?></td>
    <td align="center"><?php echo $locker_fetch_res['emp_name'];?></td>
    <td align="center"><?php echo $locker_fetch_res['emp_id'];?></td>
    <td height="30" align="center"><span style="cursor:pointer">
      <?php
			if($locker_fetch_res['assignment_status'] == 1)
			{
		?>
      <a href="add_locker.php?status=<?php echo base64_encode(0);?>&amp;locker=<?php echo base64_encode($locker_fetch_res['locker_id']);?>"><img src="../images/green.gif" width="24" height="24" /></a>
      <?php
			}else{
		?>
      <a href="add_locker.php?status=<?php echo base64_encode(1);?>&amp;locker=<?php echo base64_encode($locker_fetch_res['locker_id']);?>"><img src="../images/red.gif" width="24" height="24" /></a>
      <?php
			}
		?>
    </span></td>
    <td align="center" style="cursor:pointer"><table width="100%" border="0">
      <tr>
        <td width="38%" height="30" align="right"><a href="<?php echo "assign_locker.php?assign=".base64_encode($locker_fetch_res['assign_id']);?>"><img src="../images/edit.gif" width="25" height="25" /></a></td>
        <td width="26%">&nbsp;</td>
        <td width="36%" align="left" onClick="deleteFunc('<?php echo 'assign_locker.php?delAssign='.base64_encode($locker_fetch_res['assign_id']);?>')"><img src="../images/del.gif" width="25" height="25" /></td>
      </tr>
    </table></td>
  </tr>
  <?php
				$i++;
	  	}
	  ?>
  <tr class="list_dyn_row">
    <td height="10" colspan="8" align="center">&nbsp;</td>
  </tr>
</table>
