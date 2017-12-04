<?php
include "../connection/connection.php";
	if(@$_GET['officId'])
	{
		$sql = "select * from floor_master where office_id=$_GET[officId] and floor_status=1";
		//echo $sql;
		$rec = mysql_query($sql);
	}
	//echo @$floor_master_fetch_res['floor_id'];
?>
<select name="fnum" class="inner_tab_index_txt_box" id="fnum" style=" width:380px"  onchange="find_locker()">
  <option value="0">... Select ...</option>
  <?php
  	while($res = mysql_fetch_assoc($rec))
	{
  ?>
  <option value="<?php echo $res['floor_id'];?>" <?php if(@$floor_master_fetch_res['floor_id']==@$res['floor_id']){echo "selected";}?>><?php if($res['floor_number'] == 0){echo "All";}else{ echo $res['floor_number'];}?></option>
  <?php
  	}
  ?>
</select>