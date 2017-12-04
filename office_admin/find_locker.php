<?php
include "../connection/connection.php";
	if(@$_GET['officeId'] && @$_GET['floorId'])
	{
		echo "<script>alert('Hello')</script>";
		$sql = "select * from locker_master where office_id='$_GET[officeId]' and floor_id='$_GET[floorId]' and locker_status=1";
		//echo $sql;
		$rec = mysql_query($sql);
	}
	//echo @$floor_master_fetch_res['floor_id'];
?>
<select name="locker_num" class="inner_tab_index_txt_box" id="locker_num" style=" width:380px" >
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