<?php
include "../connection/connection.php";
include "include/chk_login.php";
	if(@$_GET['officeId'] && @$_GET['floorId'])
	{
		//echo "<script>alert('Hello')</script>";
		$sql = "select * from locker_master where office_id='$_GET[officeId]' and floor_id='$_GET[floorId]' and locker_status=1";
		//echo $sql;
		$rec = mysql_query($sql);
	}
	//echo @$floor_master_fetch_res['floor_id'];
?>
<label for="locker_num">Select Locker Number</label>
<select name="locker_num" class="form-control" id="locker_num"  style=" width:40.5em" >
  <option value="0">... Select ...</option>
  <?php
  	while($res = mysql_fetch_assoc($rec))
	{
  ?>
  <option value="<?php echo $res['locker_id'];?>"><?php echo $res['locker_number'];?></option>
  <?php
  	}
  ?>
</select>