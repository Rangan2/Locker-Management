<?php
     include "../connection/connection.php";
     include "include/chk_login.php";
   if(isset($_GET['office'])){
    $floor_sql = "select * from office_admin_credentials_master offCred, office_admin_assigned_floor_number assFloor, floor_master fMaster where offCred.office_id = '$_GET[office]' and assFloor.credential_id = offCred.credential_id and assFloor.floor_id = fMaster.floor_id";
}

//echo $floor_sql;

?>
<select  id="floor" class="form-control"  name="floor" onchange="search_locker()">
                             <option value="0">... Select ...</option>
                             <?php
                             $floor_rec = mysql_query($floor_sql);
                              while ($floor_res = mysql_fetch_assoc($floor_rec))
                              {
                                  echo $floor_res['floor_number'];
                             ?>
<option value="<?php echo $floor_res['floor_id']?>"><?php echo $floor_res['floor_number'];?></option>
                              <?php
                              }
                              ?>
                           </select>