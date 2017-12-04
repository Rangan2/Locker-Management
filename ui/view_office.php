<?php
   session_start();
   include "connection/connection.php";
   include "include/chk_login.php";
   $company_name_sql = "select * from company_master where company_id='$_SESSION[company_id]'";
   $company_name_rec = mysql_query($company_name_sql);
   $company_name_res = mysql_fetch_assoc($company_name_rec);

if(isset($_POST['Submit']))
{
   if($_POST['Submit'] == "editOffice")
   {


            $floorId = $_POST['fid'];
            $location = $_POST['autocomplete'];
            $officeName = $_POST['offname'];
            $officeFloor = $_POST['offfloor'];

            $chkOfficeSql = "select * from office_master where office_location='$location'";
            $chkOfficeRec = mysql_query($chkOfficeSql);
            $chkOfficeNum = mysql_num_rows($chkOfficeRec);
            if( $chkOfficeNum > 0)
            {
                  $chkOfficeRes = mysql_fetch_assoc($chkOfficeRec);
                  $floorCheckSql = "select * from floor_master where office_id = '$chkOfficeRes[office_id]' and floor_number = '$officeFloor'";
                  $floorCheckRec = mysql_query($floorCheckSql);
                  $floorCheckNum = mysql_num_rows($floorCheckRec);
                  if($floorCheckNum > 0)
                  {
                     echo "<script>
                              alert('Floor Already Exist For The Office');
                              location.replace('view_office.php?');
                           </script>";
                  }else{
                     $floorUpdateSql = "update floor_master set office_id = '$chkOfficeRes[office_id]' , floor_number='$officeFloor' where floor_id = '$floorId'";
                     //echo $floorUpdateSql;exit;
                     $floorUpdateRec = mysql_query($floorUpdateSql);
                     if($floorUpdateRec)
                     {
                          echo "<script>
                                    alert('Floor Updated For The Office');
                                    location.replace('view_office.php?');
                                 </script>";
                     }else{
                           echo "<script>
                                    alert('Floor Does Not Updated For The Office');
                                    location.replace('view_office.php?');
                                 </script>";
                     }
                  }

            }else{

                   echo "<script>
                              alert('No Office is Registered At the Location');
                              location.replace('view_office.php?');
                         </script>";
            }

      /*$update_sql = "update office_master set office_location='$location', office_name='$office_name' where office_id='$office_id'";
      //echo $update_sql;exit;
      $update_rec = mysql_query($update_sql);
      if($update_rec)
      {
         $update_floor_sql = "update floor_master set floor_number = '$floor_num' where floor_id='$floor_id'";
         $update_floor_rec = mysql_query($update_floor_sql);
         if($update_floor_rec)
         {
            echo "<script>
                  alert('Office Details Updated')
                  location.replace('add_office.php?');
                 </script>";
         }else{

            echo "<script>
                  alert('Floor Details Does Not Updated')
                  location.replace('add_office.php?');
                 </script>";
         }
      }else{

         echo "<script>
               alert('Data Not Updated')
               location.replace('add_office.php?');
              </script>";
      }*/
   }

}



   if(isset($_GET['status']))
   {
   $status = base64_decode($_GET['status']);
   $office_id = base64_decode($_GET['office']);
   $floor_id = base64_decode($_GET['floor']);

   $update_floor_sql = "update floor_master set floor_status = '$status' where floor_id='$floor_id'";
   $update_floor_rec = mysql_query($update_floor_sql);
   if($update_floor_rec)
   {
      echo "<script>
               alert('Office Details Updated')
               location.replace('view_office.php?');
            </script> ";
   }else{

      echo "<script>
               alert('Floor Details Does Not Updated')
               location.replace('view_office.php?');
            </script> ";

   }


   }

   if(isset($_GET['Del']))
   {
   $floor_id = base64_decode($_GET['Del']);
   $delete_floor_sql = "delete from floor_master where floor_id='$floor_id'";
   $delete_floor_rec = mysql_query($delete_floor_sql);
   if($delete_floor_sql)
   {
      echo "<script>
                 alert('Office Details Deleted')
                 location.replace('view_office.php?');
             </script> ";
   }else{
      echo "<script>
                 alert('Floor Details Does Not Deleted')
                 location.replace('view_office.php?');
            </script> ";
   }
   }

   ?>
<!DOCTYPE html>
<html>
   <head>
      <title></title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="js/all.js"></script>
      <link rel="stylesheet" type="text/css" href="css/styles.css">
      <link href="https://fonts.googleapis.com/css?family=Roboto | Orbitron | Audiowide" rel="stylesheet">
   </head>
   <!--  <script type="text/javascript">
      function chk_floor(){
         alert('Avijit Datta');
      }


      </script> -->
   <body style="background-color: #303030">
      <div class="container-fluid">
         <div class="dashboardOuterDiv">
            <div class="dashboardInnerDiv">
               <div>
                  &nbsp;
               </div>
               <div class="col-lg-3 dashboardSider">
                  <h5> <?php echo $_SESSION['full_name'];?></h5>
                  <?php echo $company_name_res['company_name'];?>
               </div>
               <div class="col-lg-9 dashboardHead">
                  <h4> Admin Console </h4>
                  <div class="dropdown">
                     <img src="images/options.png" width="40" height="40" class="optionsImage dropdown-toggle" data-toggle="dropdown">
                     <ul class="dropdown-menu optionsImage">
                        <li><a href="change_password.php">Change Password</a></li>
                        <li style="padding-left: 1.5em" onClick="redirect('logout.php')">Logout</li>
                     </ul>
                  </div>
               </div>
               <div>
                  <div class="col-lg-3 dashboardNavSider">
                     <div style="padding-bottom: 2em; padding-top: 0.5em; cursor: pointer;"><a class="anchor" href="dashboard.php">DASHBOARD</a></div>
                     <?php
                        $menu_master_sql = "select * from menu_master where menu_status = 1 and menu_parent = 0";
                        $menu_master_rec = mysql_query($menu_master_sql);
                        while ($menu_master_res = mysql_fetch_assoc($menu_master_rec))
                        {
                        ?>
                     <div style=" padding-bottom: 2em;"><a class="anchor" href="<?php echo $menu_master_res['menu_link'];?>"> <?php echo strtoupper($menu_master_res['menu_name']);?></a> </div>
                     <?php
                        }
                        ?>
                     <div>
                        MESSAGES
                     </div>
                     <div>
                        &nbsp;
                     </div>
                  </div>
                  <div class="col-lg-9" style="margin-top: 1.5em;">
                     <table class="table table-hover table-responsive table-hover features" width="90%" align="center">
                        <tr>
                           <td class="featureHeader" colspan="8">
                              View Office
                           </td>
                        </tr>
                        <tr class="viewOfficeTabHeader">
                           <td width="3%" align="center">
                              #
                           </td>
                           <td width="22%">
                              Location
                           </td>
                           <td width="15%">
                              Office Name
                           </td>
                           <td width="15%" align="center">
                              Floor Number
                           </td>
                           <td width="14%" align="center">
                              Office Status
                           </td>
                           <td colspan="3" align="center">
                              Options
                           </td>
                        </tr>
                        <?php
                           $office_add_sql = "select * from office_master where admin_id='$_SESSION[user_id]'";
                           $office_add_rec = mysql_query($office_add_sql);
                           $office_add_num_rows = mysql_num_rows($office_add_rec);
                           if($office_add_num_rows > 0)
                           {
                                 $i = 1;
                                 while($office_add_res = mysql_fetch_assoc($office_add_rec))
                                 {
                                    $floor_sql = "select * from floor_master where office_id='$office_add_res[office_id]'";
                                    //echo $floor_sql;
                                    $floor_rec = mysql_query($floor_sql);
                                    if($i % 2 == 0)
                                    {
                                       $bg = "bgcolor=#E1E1E1";
                                    }else{
                                       $bg = "bgcolor=#B9B9B9";
                                    }
                                    while($floor_res = mysql_fetch_assoc($floor_rec))
                                    {
                           ?>
                        <tr>
                           <td align="center"><?php echo $i;?>
                           </td>
                           <td><?php echo $office_add_res['office_location'];?>
                           </td>
                           <td><?php echo $office_add_res['office_name'];?>
                           </td>
                           <td align="center"><?php  if($floor_res['floor_number'] == 0){ echo "Full";}else{echo $floor_res['floor_number'];}?>
                           </td>
                           <td>
                              <?php
                                 if($floor_res['floor_status'] == 1)
                                 {
                                 ?>
                              <a href="view_office.php?status=<?php echo base64_encode(0);?>&amp;office=<?php echo base64_encode($office_add_res['office_id']);?>&floor=<?php echo base64_encode($floor_res['floor_id']);?>">
                                 <table id="active<?php echo $office_add_res['office_id'];?>" width="80%" border="0" align="right" style="border:0px solid #ccc;  border-radius: 5px ;margin-left: 2em; margin-right: 0.8em ; cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4; background-color:#96CF9D; color: white">
                                    <tr height="25px">
                                       <td align="center">Active</td>
                                    </tr>
                                 </table>
                              </a>
                              <?php
                                 }else{
                                 ?>
                              <a href="view_office.php?status=<?php echo base64_encode(1);?>&amp;office=<?php echo base64_encode($office_add_res['office_id']);?>&floor=<?php echo base64_encode($floor_res['floor_id']);?>">
                                 <table id="inactive<?php echo $office_add_res['office_id'];?>" width="80%" border="0" align="right" style="border:0px solid #ccc;  border-radius: 5px ;margin-left: 2em; margin-right: 0.8em ;cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4; background-color:#C70039; color: white">
                                    <tr height="25px">
                                       <td align="center">Inactive</td>
                                    </tr>
                                 </table>
                              </a>
                              <?php
                                 }
                                 ?>
                           </td>
                           <td width="10%">
                              <table id="editDetails"  width="100%" border="0" align="right" style="border:0px solid #ccc;  border-radius: 5px ;margin-left: 2em; cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4; background-color:#88B0DC">
                                 <tr height="25px">
                                    <td align="center" data-toggle="modal" data-target="#edit<?php echo $i;?>"
                                       >Edit</td>
                                 </tr>
                              </table>
                              <!-- Modal Edit Office -->
                              <div class="modal fade" id="edit<?php echo $i;?>" role="dialog">
                                 <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                       <div class="modal-header modalHeader">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title">EDIT OFFICE</h4>
                                       </div>
                                       <div class="modal-body">
                                          <form name="addOfficeForm" action="" method="POST">
                                             <div class="form-group">
                                                <label for="autocomplete">Office Location</label>
                                                <input type="txt" class="form-control" id="autocomplete" name="autocomplete" value="<?php echo $office_add_res['office_location'];?>">
                                             </div>
                                             <div class="form-group">
                                                <label for="offname">Office Name</label>
                                                <input type="txt" class="form-control" id="offname" name="offname" value="<?php echo $office_add_res['office_name'];?>">
                                             </div>
                                             <div class="form-group">
                                                <label for="offfloor">Floor Number</label>
                                                <input type="hidden" name="fid" id="fid" value="<?php echo $floor_res['floor_id'];?>">
                                                <input type="txt" class="form-control" id="offfloor" name="offfloor" value="<?php  if($floor_res['floor_number'] == 0){ echo "Full";}else{echo $floor_res['floor_number'];}?>">
                                             </div>
                                             <button type="submit" class="btn btn-default btn-success" name="Submit" value="editOffice">Edit Office</button>
                                          </form>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </td>
                           <td width="11%">
                              <table  width="100%" border="0" align="right" style="border:0px solid #ccc; background-color: #FC4778; border-radius: 5px ;margin-left: 2em; cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4;" >
                                 <tr height="25px">
                                    <td align="center" onclick="deleteFunc('view_office.php?Del=<?php echo base64_encode($floor_res['floor_id']);?>');">Delete</td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <?php
                           $i++;
                           }
                           }
                           }
                           ?>
                        <tr>
                           <td align="center" colspan="7">&nbsp;
                           </td>
                        </tr>
                     </table>
                  </div>
               </div>
               <div>
                  &nbsp;
               </div>
            </div>
            <div>
               &nbsp;
            </div>
            <div>
               &nbsp;
            </div>
         </div>
      </div>
   </body>
</html>