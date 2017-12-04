<?php
   session_start();
   include "connection/connection.php";
   $company_name_sql = "select * from company_master where company_id='$_SESSION[company_id]'";
   $company_name_rec = mysql_query($company_name_sql);
   $company_name_res = mysql_fetch_assoc($company_name_rec);



   if(isset($_GET['admin']))
   {
      $admin_id = base64_decode($_GET['admin']);
      $delete_assign_floor_sql = "delete from office_admin_assigned_floor_number where credential_id = '$admin_id'";
      $delete_assign_floor_rec = mysql_query( $delete_assign_floor_sql);
      if($delete_assign_floor_rec)
      {
            $delete_admin_sql = "delete from office_admin_credentials_master where credential_id='$admin_id'";
   //echo $delete_sql;exit;
            $delete_admin_rec = mysql_query($delete_admin_sql);
            if($delete_admin_rec)
            {

               echo "<script>
                        alert('Admin Removed Successfully')
                        location.replace('remove_admin.php?');
                    </script> ";

            }else{

               echo "<script>
                        alert('Admin Does Not Removed Successfully')
                        location.replace('remove_admin.php?');
                    </script> ";
            }
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
                           <td class="featureHeader" colspan="7">
                              Remove Office Admin                           </td>
                        </tr>
                        <tr class="viewOfficeTabHeader">
                           <td width="7%" align="center">
                              #                           </td>
                           <td width="22%">
                              Location                           </td>
                           <td width="12%" align="center">
                              Floor Number                           </td>
                           <td width="14%" align="center">
                              Admin Name                           </td>
                           <td width="18%" align="center">
                              Email Id                           </td>
                           <td align="center">
                              Options                           </td>
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
                           <td align="center"><table  width="70%" border="0" align="center" style="border:0px solid #ccc; background-color: #FC4778; border-radius: 5px ;margin-left: 3.3em; cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4;" >
                             <tr height="25px">
                               <td align="center" onclick="deleteFunc('remove_admin.php?admin=<?php echo base64_encode($office_admin_res['credential_id']);?>');">Remove</td>
                             </tr>
                           </table></td>
                        </tr>
                        <?php
                           $i++;
                           }
                           }
                           ?>
                        <tr>
                           <td colspan="7">&nbsp;</td>
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