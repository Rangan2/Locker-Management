<?php
include "connection/connection.php";

    if(@$_GET['officId'])
    {
        $sql = "select * from floor_master where office_id=$_GET[officId]";
       // echo $sql;
        $rec = mysql_query($sql);
    }
    //echo @$floor_master_fetch_res['floor_id'];
?>
<label for="fnum">Select Floor Number</label>
<select name="fnum" class="form-control" id="fnum" style=" width:40.5em" >
  <option value="0">... Select ...</option>
  <?php
    while($res = mysql_fetch_assoc($rec))
    {
  ?>
  <option value="<?php echo $res['floor_id'];?>" <?php if(@$floor_num_fetch_res['floor_id']==@$res['floor_id']){echo "selected";}?>><?php if($res['floor_number'] == 0){echo "All";}else{ echo $res['floor_number'];}?></option>
  <?php
    }
  ?>
</select>