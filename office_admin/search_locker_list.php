<?php
@session_start();
	include "../connection/connection.php";
	if(isset($_GET['floorId']) || isset($_GET['lockerNum']) || isset($_GET['officeId']))
	{
		@$floor_id = $_GET['floorId'];
		@$locker_number = $_GET['lockerNum'];
		@$office_id = $_GET['officeId'];
		if($locker_number != "" && $floor_id != 0 && $office_id != "")
		{
			$locker_fetch_sql = "select * from locker_master where office_id='$office_id' and floor_id='$floor_id' and locker_number = '$locker_number'";
		}elseif($locker_number == "" && $floor_id != 0 && $office_id != "")
		{
			$locker_fetch_sql = "select * from locker_master where office_id='$office_id' and floor_id='$floor_id'";
		}elseif($locker_number != "" && $floor_id == 0 && $office_id != ""){
			$locker_fetch_sql = "select * from locker_master where office_id='$office_id' and locker_number = '$locker_number'";
		}else{
			$locker_fetch_sql = "select * from locker_master where office_id='$office_id'";
		}
	}else{
		$locker_fetch_sql = "select * from locker_master where added_by = '$_SESSION[admin_id]'";
	}
	//echo $locker_fetch_sql;
	$locker_fetch_rec = mysql_query($locker_fetch_sql);
?>
<table width="100%" border="0">
  <tr class="list_sec_row">
    <td width="15%" align="center">Sl . No . </td>
    <td width="20%" height="30" align="center">Floor Number </td>
    <td width="32%" align="center">Locker Number </td>
    <td width="33%" align="center">Assigned Status</td>
  </tr>
  <?php
	  	$i = 1;
	  	while($locker_fetch_res = mysql_fetch_assoc($locker_fetch_rec))
		{
			$assignment_check_sql = "select * from locker_assign where locker_id=$locker_fetch_res[locker_id] and assignment_status=1";
			//echo $assignment_check_sql;
			$assignment_check_rec = mysql_query($assignment_check_sql);
			$assignment_check_num = mysql_num_rows($assignment_check_rec);
			if($i % 2 == 0)
			{
				$bg = "bgcolor=#E1E1E1";	
			}else{
				$bg = "bgcolor=#B9B9B9";
			}
			$floor_fetch_sql = "select * from floor_master where floor_id='$locker_fetch_res[floor_id]'";
			$floor_fetch_rec = mysql_query($floor_fetch_sql);
			$floor_fetch_res = mysql_fetch_assoc($floor_fetch_rec);
	  ?>
  <tr class="list_dyn_row" <?php echo $bg;?>>
    <td height="30" align="center"><?php echo $i;?></td>
    <td height="30" align="center"><?php echo $floor_fetch_res['floor_number'];?></td>
    <td height="30" align="center"><?php echo $locker_fetch_res['locker_number'];?></td>
    <td height="30" align="center"><span>
      <?php
		if($assignment_check_num > 0)
		{
		?>
      <a style="cursor:pointer" href="search_locker.php?status=<?php echo base64_encode(0);?>&amp;locker=<?php echo base64_encode($locker_fetch_res['locker_id']);?>"><img src="../images/red.gif" width="24" height="24" title="Click Here To Receive The Key" /></a>
      <?php
		}else{
		?>
      <img src="../images/green.gif" width="24" height="24" />
      <?php
		}
		?>
    </span></td>
  </tr>
  <?php
				$i++;
	  	}
	  ?>
  <tr class="list_dyn_row">
    <td height="10" colspan="4" align="center">&nbsp;</td>
  </tr>
</table>
