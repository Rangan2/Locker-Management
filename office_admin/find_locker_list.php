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
		$locker_fetch_sql = "select * from locker_master where added_by = '$_SESSION[admin_id]'";
	}
	$locker_fetch_rec = mysql_query($locker_fetch_sql);
?>
<table width="100%" border="0">
  <tr class="list_sec_row">
    <td width="9%" align="center">Sl . No . </td>
    <td width="18%" height="30" align="center">Floor Number </td>
    <td width="17%" align="center">Locker Number </td>
    <td width="18%" align="center">Status</td>
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
			$floor_fetch_sql = "select * from floor_master where floor_id='$locker_fetch_res[floor_id]'";
			$floor_fetch_rec = mysql_query($floor_fetch_sql);
			$floor_fetch_res = mysql_fetch_assoc($floor_fetch_rec);
	  ?>
  <tr class="list_dyn_row" <?php echo $bg;?>>
    <td height="30" align="center"><?php echo $i;?></td>
    <td height="30" align="center"><?php echo $floor_fetch_res['floor_number'];?></td>
    <td height="30" align="center"><?php echo $locker_fetch_res['locker_number'];?></td>
    <td height="30" align="center"><span style="cursor:pointer">
      <?php
			if($locker_fetch_res['locker_status'] == 1)
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
        <td width="38%" height="30" align="right"><a href="<?php echo "add_locker.php?locker=".base64_encode($locker_fetch_res['locker_id']);?>"><img src="../images/edit.gif" width="25" height="25" /></a></td>
        <td width="26%">&nbsp;</td>
        <td width="36%" align="left" onClick="deleteFunc('<?php echo 'add_locker.php?delLocker='.base64_encode($locker_fetch_res['locker_id']);?>')"><img src="../images/del.gif" width="25" height="25" /></td>
      </tr>
    </table></td>
  </tr>
  <?php
				$i++;
	  	}
	  ?>
  <tr class="list_dyn_row">
    <td height="10" colspan="5" align="center">&nbsp;</td>
  </tr>
</table>