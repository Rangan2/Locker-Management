<?php
@session_start();
    include "../connection/connection.php";
    include "include/chk_login.php";



    if(isset($_GET['floorId']) || isset($_GET['lockerNum']) || isset($_GET['officeId']))
    {
        @$floor_id = $_GET['floorId'];
        @$locker_number = $_GET['lockerNum'];
        @$office_id = $_GET['officeId'];
        //echo $floor_id."@".$office_id."@".$office_id;
        if($locker_number != "" && $floor_id != "" && $office_id != "")
        {
            /*$locker_fetch_sql = "select * from locker_master where office_id='$office_id' and floor_id='$floor_id' and locker_number = '$locker_number'";*/
            $locker_fetch_sql = "select * from office_master offMaster, floor_master fMaster , locker_master lMaster where offMaster.office_id = '$office_id' and fMaster.floor_id = '$floor_id' and lMaster.locker_number = '$locker_number' and lMaster.floor_id = fMaster.floor_id";

        }elseif($locker_number == "" && $floor_id != 0 && $office_id != "")
        {
           /* $locker_fetch_sql = "select * from locker_master where office_id='$office_id' and floor_id='$floor_id'";*/
           $locker_fetch_sql = "select * from office_master offMaster, floor_master fMaster , locker_master lMaster  where offMaster.office_id = '$office_id' and fMaster.floor_id = lMaster.floor_id and fMaster.floor_id = $floor_id";

        }elseif($locker_number != "" && $floor_id == 0 && $office_id != ""){
           /* $locker_fetch_sql = "select * from locker_master where office_id='$office_id' and locker_number = '$locker_number'";*/
           $locker_fetch_sql = "select * from office_master offMaster, locker_master lMaster, floor_master fMaster where offMaster.office_id = $office_id and lMaster.office_id = $office_id and fMaster.floor_id = lMaster.floor_id and lMaster.locker_number = $locker_number";
        }else{

             $locker_fetch_sql  = "select * from office_master offMaster where offMaster.office_id = $office_id";
        }
    }else{

       $locker_fetch_sql = "select * from office_admin_credentials_master credMaster, office_master offMaster, office_admin_assigned_floor_number assFloor, floor_master fMaster, locker_master lMaster where credMaster.email_id = '$_SESSION[email_id]' and credMaster.office_id = offMaster.office_id and assFloor.credential_id = credMaster.credential_id and assFloor.floor_id = fMaster.floor_id and lMaster.floor_id = assFloor.floor_id";
    }
 //echo $locker_fetch_sql;
    $locker_fetch_rec = mysql_query($locker_fetch_sql);
?>


<table class="table table-hover table-responsive">
<tr>
    <td width="15%" align="center">#</td>
    <td width="15%" height="30" align="eft">Office Location </td>
    <td width="20%" height="30" align="center">Floor Number </td>
    <td width="20%" align="center">Locker Number </td>
    <td width="33%" align="center">Options</td>
</tr>

 <?php
        $i = 1;
        while($locker_fetch_res = mysql_fetch_assoc($locker_fetch_rec))
        {
           /* $assignment_check_sql = "select * from locker_assign where locker_id=$locker_fetch_res[locker_id] and assignment_status=1";
            //echo $assignment_check_sql;
            $assignment_check_rec = mysql_query($assignment_check_sql);
            $assignment_check_num = mysql_num_rows($assignment_check_rec);*/
            if($i % 2 == 0)
            {
                $bg = "bgcolor=#E1E1E1";
            }else{
                $bg = "bgcolor=#B9B9B9";
            }
          /*  $floor_fetch_sql = "select * from floor_master where floor_id='$locker_fetch_res[floor_id]'";
            $floor_fetch_rec = mysql_query($floor_fetch_sql);
            $floor_fetch_res = mysql_fetch_assoc($floor_fetch_rec);*/
?>

<tr <?php echo $bg;?>>
    <td width="15%" align="center"><?php echo $i;?></td>
    <td width="15%"><?php echo $locker_fetch_res['office_location']; ?></td>
    <td width="20%" height="30" align="center"><?php echo @$locker_fetch_res['floor_number'];?></td>
    <td width="20%" align="center"><?php echo @$locker_fetch_res['locker_number'];?></td>
   <td width="26%"  >
        <table width="100%">
            <tr>
                <td width="50%">
                    <table id="edit<?php echo $i;?>" width="72%" border="0" style="border:0px solid #ccc;  border-radius: 5px ;margin-left: 2em; margin-right: 0.8em ; cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4; background-color:#96CF9D; color: white" data-toggle="modal" data-target="#asLocker<?php echo $i;?>">
                                    <tr height="25px">
                                       <td align="center">Edit</td>
                                  </tr>
          </table>
                </td>

 <div class="modal fade" id="asLocker<?php echo $i;?>" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header modalHeader">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style="text-align: left;">UPDATE ASSIGN LOCKER</h4>
               </div>
               <div class="modal-body">
                  <form name="assignLockerForm" action="" method="POST">
                      <div class="form-group">
                        <label for="officeloc">Office Location</label>
                        <select class="form-control" id="officelocation" name="officelocation" onchange="chk_floor_ass()">
                        <option value="0">... Select ...</option>
                         <?php
                           $location_sql = "select * from office_admin_credentials_master offCred, office_master oofMaster where offCred.email_id = '$_SESSION[email_id]' and offCred.office_id = oofMaster.office_id";
                          // echo $location_sql;
                           $location_rec = mysql_query($location_sql);
                           while($location_res = mysql_fetch_assoc($location_rec))
                           {
                         ?>
                           <option value="<?php echo $location_res['office_id'];?>"><?php echo $location_res['office_location'];?></option>
                           <?php
                        }
                           ?>
                           </select>
                    </div>
                      <div class="form-group" id="showFloor">
                        <?php include "seeFloor.php";?>
                     </div>
                      <div class="form-group" id="lockerList">
                        <?php include "find_locker.php";?>
                     </div>
                      <div class="form-group">
                        <label for="offfloor">Employee ID</label>
                        <input type="txt" class="form-control" id="emp_id" name="emp_id" value="<?php echo $locker_assign_res['emp_id'];?>">
                     </div>
                      <div class="form-group">
                        <label for="offfloor">Employee Name</label>
                        <input type="txt" class="form-control" id="emp_name" name="emp_name" value="<?php echo $locker_assign_res['emp_name']; ?>">
                     </div>
                     <button type="submit" class="btn btn-default btn-success" name="Submit" value="assLocker">Update</button>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>

                <td width="50%">
                   <table id="inactive" width="75%" border="0" style="border:0px solid #ccc;  border-radius: 5px ;margin-left: 2em; margin-right: 0.8em ;cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4; background-color:#C70039; color: white"  onclick="deleteFunc('view_locker.php?locker=<?php echo base64_encode($locker_fetch_res['locker_id'])?>&office=<?php echo base64_encode($locker_fetch_res['office_id'])?>&floor=<?php echo base64_encode($locker_fetch_res['floor_id'])?>')">
          <tr height="25px">
            <td align="center">Delete</td>
          </tr>
        </table>
                </td>
            </tr>
        </table>

    </td>
</tr>

 <?php
                $i++;
        }
      ?>

</table>