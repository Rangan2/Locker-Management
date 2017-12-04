<?php
   session_start();
   include "connection/connection.php";
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
   }

   }

   if(isset($_GET['Delete']))
   {
   $admin_id = base64_decode($_GET['Delete']);
   $floor_id = base64_decode($_GET['Dfloor']);
   $delete_sql = "delete from office_admin_assigned_floor_number where credential_id='$admin_id' and assign_floor_id = '$floor_id'";
   //echo $delete_sql;exit;
   $delete_rec = mysql_query($delete_sql);
   if($delete_rec)
   {

      echo "<script>
               alert('Assigned Floor To Admin Deleted')
               location.replace('view_office_admin.php?');
           </script> ";

   }else{

      echo "<script>
               alert('Assigned Floor To Admin Does Not Deleted Successfully')
               location.replace('view_office_admin.php?');
           </script> ";
   }
   }


   if(isset($_GET['status']))
   {
   $status = base64_decode($_GET['status']);
   $office_id = base64_decode($_GET['office']);
   $floor_id = base64_decode($_GET['assign_floor']);

   $update_floor_sql = "update floor_master set floor_status = '$status' where floor_id='$floor_id'";
   //echo $update_floor_sql;exit;
   $update_floor_rec = mysql_query($update_floor_sql);
   if($update_floor_rec)
   {
      echo "<script>
               alert('Assigned Floor Details Updated')
               location.replace('view_office_admin.php?');
            </script> ";
   }else{

      echo "<script>
               alert('Assigned Floor Details Does Not Updated')
               location.replace('view_office_admin.php?');
            </script> ";

   }

   $office_floor_sql = "select * from floor_master where office_id='$office_id'";
   $office_floor_rec = mysql_query($office_floor_sql);
   $office_floor_num_rows = mysql_num_rows($office_floor_rec);

   $floor_status_sql = "select * from floor_master where office_id = '$office_id' and floor_status='$status'";
   echo  $floor_status_sql;
   $floor_status_rec = mysql_query($floor_status_sql);
   $floor_status_num_rows = mysql_num_rows( $floor_status_rec);
   //echo $floor_status_num_rows;exit;

   /*echo "<script>
            alert($office_floor_num_rows+'@'$floor_status_num_rows);
         </script>";*/

   if( $office_floor_num_rows == $floor_status_num_rows)
   {
      $update_office_status_sql = "update office_master set office_status = '$status' where office_id = '$office_id'";
      $update_office_status_rec = mysql_query($update_office_status_sql);
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



   if(isset($_GET['status']))
   {
   $status = base64_decode($_GET['status']);
   $admin_id = base64_decode($_GET['office']);
   $assign_floor_id = base64_decode($_GET['assign_floor']);
   $update_credentials_status_sql = "update office_admin_credentials_master set admin_status='$status' where credential_id='$admin_id'";
   //echo $update_credentials_status_sql;
   $update_credentials_status_rec = mysql_query($update_credentials_status_sql);
   if($update_credentials_status_rec)
   {
      $update_assign_floor_sql = "update office_admin_assigned_floor_number set assign_floor_status = '$status' where assign_floor_id = '$assign_floor_id'";
      $update_assign_floor_rec = mysql_query($update_assign_floor_sql);
   // echo $update_assign_floor_sql;exit;
      if($update_assign_floor_rec)
      {
         echo "<script>
               alert('Admin Details Updated')
               location.replace('view_office_admin.php?');
              </script> ";
      }else{

         echo "<script>
               alert('Admin Details Does Not Updated')
               location.replace('view_office_admin.php?');
              </script> ";
      }
   }else{

      echo "<script>
               alert('Admin Details Does Not Updated')
               location.replace('view_office_admin.php?');
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
                     <div style="padding-bottom: 2em; padding-top: 0.5em; cursor: pointer;">DASHBOARD</div>
                     <?php
                        $menu_master_sql = "select * from menu_master where menu_status = 1";
                        $menu_master_rec = mysql_query($menu_master_sql);
                        while ($menu_master_res = mysql_fetch_assoc($menu_master_rec))
                        {
                        ?>
                     <div style=" padding-bottom: 2em;"> <?php echo strtoupper($menu_master_res['menu_name']);?> </div>
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
                           <td class="featureHeader" colspan="9">
                              View Office Admin
                           </td>
                        </tr>
                        <tr class="viewOfficeTabHeader">
                           <td width="7%" align="center">
                              #
                           </td>
                           <td width="22%">
                              Location
                           </td>
                           <td width="12%" align="center">
                              Floor Number
                           </td>
                           <td width="14%" align="center">
                              Admin Name
                           </td>
                           <td width="18%" align="center">
                              Email Id
                           </td>
                           <td width="12%" align="center">
                              Admin Status
                           </td>
                           <td colspan="3" align="center">
                              Options
                           </td>
                           <?php
                              $office_admin_sql = "select * from office_admin_credentials_master where added_by = '$_SESSION[user_id]'";
                              //echo $office_admin_sql;
                              $office_admin_rec = mysql_query($office_admin_sql);
                              $i = 1;
                              while($office_admin_res = mysql_fetch_assoc($office_admin_rec))
                              {
                                 $office_sql = "select * from office_master where office_id='$office_admin_res[office_id]'";
                                 $office_rec = mysql_query($office_sql);
                                 $office_res = mysql_fetch_assoc($office_rec);
                                 $floor_details_sql = "select * from office_admin_assigned_floor_number where credential_id='$office_admin_res[credential_id]'";
                                 //echo $floor_details_sql;
                                 $floor_details_rec = mysql_query($floor_details_sql);
                                 while($floor_details_res = mysql_fetch_assoc($floor_details_rec))
                                 {
                                                //echo $floor_details_res['floor_id'];
                                    $floor_num_fetch_sql = "select * from floor_master where floor_id = '$floor_details_res[floor_id]'";
                                    $floor_num_fetch_rec = mysql_query($floor_num_fetch_sql);
                                    $floor_num_fetch_res = mysql_fetch_assoc($floor_num_fetch_rec);
                              ?>
                        <tr>
                           <td align="center"><?php echo $i;?></td>
                           <td align="default"><?php echo $office_res['office_location'];?>                           </td>
                           <td align="center"><?php echo $floor_num_fetch_res['floor_number'];?>                           </td>
                           <td align="center"><?php echo $office_admin_res['admin_name'];?>                           </td>
                           <td align="center"><?php echo $office_admin_res['email_id'];?>                           </td>
                           <td align="center">
                              <?php
                                 if($floor_details_res['assign_floor_status'] == 1 )
                                 {
                                 ?>
                              <a href="view_office_admin.php?status=<?php echo base64_encode(0);?>&office=<?php echo base64_encode($office_admin_res['credential_id']);?>&assign_floor=<?php echo base64_encode($floor_details_res['assign_floor_id']);?>">
                                 <table  width="80%" border="0" align="right" style="border:0px solid #ccc;  border-radius: 5px ;margin-left: 2em; margin-right: 0.8em ; cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4; background-color:#96CF9D; color: white">
                                    <tr height="25px">
                                       <td align="center">Active</td>
                                    </tr>
                                 </table>
                              </a>
                              <?php
                                 }else{
                                 ?>
                              <a href="view_office_admin.php?status=<?php echo base64_encode(1);?>&office=<?php echo base64_encode($office_admin_res['credential_id']);?>&assign_floor=<?php echo base64_encode($floor_details_res['assign_floor_id']);?>">
                                 <table width="80%" border="0" align="right" style="border:0px solid #ccc;  border-radius: 5px ;margin-left: 2em; margin-right: 0.8em ;cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4; background-color:#C70039; color: white">
                                    <tr height="25px">
                                       <td align="center">Inactive</td>
                                    </tr>
                                 </table>
                              </a>
                              <?php
                                 }
                                 ?>
                           </td>
                           <td width="8%">
                              <table id="editDetails"  width="100%" border="0" align="right" style="border:0px solid #ccc;  border-radius: 5px ;margin-left: 2em; cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4; background-color:#88B0DC">
                                 <tr height="25px">
                                    <td align="center" data-toggle="modal" data-target="#edit<?php echo $i;?>"
                                       >Edit
                                    </td>
                                 </tr>
                              </table>
                              <!-- Modal -->
                              <!-- Modal Add Office Admin -->
                              <div class="modal fade" id="edit<?php echo $i;?>" role="dialog">
                                 <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                       <div class="modal-header modalHeader">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title">EDIT OFFICE ADMIN</h4>
                                       </div>
                                       <div class="modal-body">
                                          <form name="addOfficeAdminForm" action="" method="POST">
                                             <!-- <div class="form-group">
                                                <label for="autocomplete">Office Locaation:</label>
                                                <input type="txt" class="form-control" id="autocomplete" name="autocomplete">
                                                </div> -->
                                             <div class="form-group">
                                                <label for="officeloc">Select Office Location <?php echo "select * from office_master where admin_id='$_SESSION[user_id]' and office_status=1";?></label>
                                                <select class="form-control" id="officeloc" name="officeloc" onChange="chk_floor()">
                                                   <option value="0">... Select ...</option>
                                                   <?php
                                                      $location_sql = "select * from office_master where admin_id='$_SESSION[user_id]' and office_status=1";
                                                      $location_rec = mysql_query($location_sql);
                                                      while($location_res = mysql_fetch_assoc($location_rec))
                                                      {
                                                      ?>
                                                   <option value="<?php echo $location_res['office_id'];?>" <?php if( $office_res['office_id'] == $location_res['office_id']){ echo "selected";}?>><?php echo $location_res['office_location'];?></option>
                                                   <?php
                                                      }
                                                         ?>
                                                </select>
                                             </div>
                                             <div class="form-group" id="areaHint">
                                                <?php include "find_floors.php";?>
                                             </div>
                                             <div class="form-group">
                                                <label for="admin_name">Admin Name</label>
                                                <input type="txt" class="form-control" id="admin_name" name="admin_name" value="<?php echo $office_admin_res['admin_name'];?>">
                                             </div>
                                             <div class="form-group">
                                                <label for="uname">Email Id</label>
                                                <input type="email" class="form-control" id="uname" name="uname" value="<?php echo $office_admin_res['email_id'];?>">
                                             </div>
                                             <button type="submit" class="btn btn-default btn-success" name="Submit" value="addOfficeAdmin" >Edit</button>
                                          </form>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </td>
                           <td width="7%" colspan="2" align="center">
                              <table  width="100%" border="0" align="right" style="border:0px solid #ccc; background-color: #FC4778; border-radius: 5px ;margin-left: 2em; cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4;" >
                                 <tr height="25px">
                                    <td align="center" onClick="deleteFunc('view_office_admin.php?Delete=<?php echo base64_encode($office_admin_res['credential_id']);?>&Dfloor=<?php echo base64_encode($floor_details_res['assign_floor_id']);?>');">Delete</td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <?php
                           $i++;
                           }
                           }
                           ?>
                        <tr>
                           <td colspan="9">&nbsp;</td>
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