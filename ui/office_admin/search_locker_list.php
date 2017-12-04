<?php
@session_start();
    include "../connection/connection.php";
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
// echo $locker_fetch_sql;
    $locker_fetch_rec = mysql_query($locker_fetch_sql);
?>


<table class="table table-hover table-responsive">
<tr>
    <td width="15%" align="center">#</td>
    <td width="15%" height="30" align="left">Office Name </td>
    <td width="15%" height="30" align="eft">Office Location </td>
    <td width="20%" height="30" align="center">Floor Number </td>
    <td width="20%" align="center">Locker Number </td>
    <td width="33%" align="center">Assigned Status</td>
</tr>

 <?php
        $i = 1;
        while($locker_fetch_res = mysql_fetch_assoc($locker_fetch_rec))
        {
            $assignment_check_sql = "select * from locker_assign where  office_id =  $locker_fetch_res[office_id] and floor_id = $locker_fetch_res[floor_id] and locker_id=$locker_fetch_res[locker_id] and assignment_status=1";
          //  echo $assignment_check_sql;
            $assignment_check_rec = mysql_query($assignment_check_sql);
            $assignment_check_num = mysql_num_rows($assignment_check_rec);
            $assignment_res = mysql_fetch_assoc($assignment_check_rec);
            if($i % 2 == 0)
            {
                $bg = "bgcolor=#E1E1E1";
            }else{
                $bg = "bgcolor=#B9B9B9";
            }

           // echo $assignment_check_num;
          /*  $floor_fetch_sql = "select * from floor_master where floor_id='$locker_fetch_res[floor_id]'";
            $floor_fetch_rec = mysql_query($floor_fetch_sql);
            $floor_fetch_res = mysql_fetch_assoc($floor_fetch_rec);*/
?>

<tr <?php echo $bg;?>>
    <td width="15%" align="center"><?php echo $i;?></td>
    <td width="15%"><?php echo $locker_fetch_res['office_name']; ?></td>
    <td width="15%"><?php echo $locker_fetch_res['office_location']; ?></td>
    <td width="20%" height="30" align="center"><?php echo @$locker_fetch_res['floor_number'];?></td>
    <td width="20%" align="center"><?php echo @$locker_fetch_res['locker_number'];?></td>
    <td width="33%" align="center">

      <?php
        if($assignment_check_num > 0)
        {

        ?>
        <a href="search_locker.php?locker_id=<?php echo base64_encode($locker_fetch_res['locker_id']);?>&status=<?php echo base64_encode(0);?>&assignment=<?php echo base64_encode($assignment_res['assign_id']);?>">
     <table id="inactive<?php echo $locker_fetch_res['locker_id'];?>" width="80%" border="0" align="right" style="border:0px solid #ccc;  border-radius: 5px ;margin-left: 2em; margin-right: 0.8em ;cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4; background-color:#C70039; color: white">
                                    <tr height="25px">
                                       <td align="center">Assigned</td>
                                    </tr>
                                 </table>
        </a>
      <?php
        }else{
        ?>

        <table id="active" width="80%" border="0" align="right" style="border:0px solid #ccc;  border-radius: 5px ;margin-left: 2em; margin-right: 0.8em ; cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4; background-color:#96CF9D; color: white">
                                    <tr height="25px">
                                       <td align="center">Not Assigned</td>
                                    </tr>
                                 </table>
      <?php
        }
        ?>

    </td>
</tr>

 <?php
                $i++;
        }
      ?>

</table>