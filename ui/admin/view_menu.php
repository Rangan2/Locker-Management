<?php
   session_start();
   include "../connection/connection.php";
   include "include/chk_login.php";
   $company_name_sql = "select * from company_master where company_id='$_SESSION[company_id]'";
   $company_name_rec = mysql_query($company_name_sql);
   $company_name_res = mysql_fetch_assoc($company_name_rec);

   if(isset($_POST['Submit']))
   {
      if($_POST['Submit'] == "addOffice")
      {


            $location = $_POST['autocomplete'];
            $office_name = $_POST['offname'];
            $floor_num = $_POST['offfloor'];

            $office_add_sql = "select * from office_master where office_location='$location' and company_id='$_SESSION[company_id]'";
            //echo $office_add_sql;
            $office_add_rec = mysql_query($office_add_sql);
            $office_add_num_rows = mysql_num_rows($office_add_rec);
            $office_add_res = mysql_fetch_assoc($office_add_rec);
            $floor_sql = "select * from floor_master where office_id = '$office_add_res[office_id]' and floor_number = '$floor_num'";
            $floor_rec = mysql_query($floor_sql);
           //echo $floor_sql;
            $floor_num_rows = mysql_num_rows($floor_rec);
      if($floor_num_rows > 0)
      {
         echo "<script>
               alert('Floor Aready Exist For The Office')
               location.replace('dashboard.php?');
             </script>  ";
      }else{
         if($office_add_num_rows > 0)
         {
            $floor_master = "insert into floor_master(office_id, floor_number) values('$office_add_res[office_id]', '$floor_num')";
            // echo $floor_master;exit;
            $floor_master_rec = mysql_query($floor_master);
            if($floor_master_rec)
            {
                  echo "<script>
                        alert('Office Details Added')
                        location.replace('dashboard.php?');
                      </script>  ";
            }else{
                  echo "<script>
                        alert('Office Details Does Not Added')
                        location.replace('dashboard.php?');
                      </script>  ";
            }

         }else{
            $add_office = "insert into office_master(admin_id, company_id, office_location, office_name) values('$_SESSION[user_id]', '$_SESSION[company_id]', '$location', '$office_name')";
            $add_office_rec = mysql_query($add_office);
            $last_inserted_office = mysql_insert_id();
            if($add_office_rec)
            {
               $floor_master = "insert into floor_master(office_id, floor_number) values('$last_inserted_office', '$floor_num')";
               $floor_master_rec = mysql_query($floor_master);
               if($floor_master_rec)
               {
                  echo "<script>
                        alert('Office Details Added')
                        location.replace('dashboard.php?');
                      </script>  ";
               }else{
                  echo "<script>
                        alert('Office Details Does Not Added')
                        location.replace('dashboard.php?');
                       </script> ";
               }
            }else{
               echo "<script>
                     alert('Office Details Does Not Added')
                     location.replace('dashboard.php?');
                   </script>  ";
            }
         }
      }
      }elseif($_POST['Submit'] == "addOfficeAdmin"){

         $location = $_POST['officeloc'];
         $floor_num = $_POST['fnum'];
         $admin_name = $_POST['admin_name'];
         $email_id = $_POST['uname'];
         $password = md5($_POST['passwd']);

         $admin_fetch_sql = "select * from office_admin_credentials_master where office_id = '$location' and added_by = '$_SESSION[user_id]'";
      //echo $admin_fetch_sql;exit;
      $admin_fetch_rec = mysql_query($admin_fetch_sql);
      $admin_fetch_num = mysql_num_rows($admin_fetch_rec);
      $admin_fetch_res = mysql_fetch_assoc($admin_fetch_rec);
      $assign_floor_sql = "select * from office_admin_assigned_floor_number where credential_id = '$admin_fetch_res[credential_id]' and floor_id = '$floor_num'";
      //echo $assign_floor_sql;exit;
      $assign_floor_rec = mysql_query($assign_floor_sql);
      $assign_floor_num = mysql_num_rows($assign_floor_rec);
      if($admin_fetch_num > 0)
      {
         if($assign_floor_num > 0)
         {
               echo "<script>
                        alert('Admin Details Already Assigned For The Floor')
                        location.replace('dashboard.php?');
                    </script> ";
         }else{

            $insert_admin_floor_sql = "insert into office_admin_assigned_floor_number(credential_id, floor_id) values('$admin_fetch_res[credential_id]','$floor_num')";
            $insert_admin_floor_rec = mysql_query($insert_admin_floor_sql);
            if($insert_admin_floor_rec)
            {
                  echo "<script>
                        alert('Floor Assigned To The Admin')
                        location.replace('dashboard.php?');
                    </script> ";
            }else{

                  echo "<script>
                        alert('Floor Does Not Assigned To The Admin')
                        location.replace('dashboard.php?');
                    </script> ";
            }
         }

      }else{

            $insert_admin_credentials_sql = "insert into office_admin_credentials_master(office_id, added_by, admin_name, email_id, password) values('$location', '$_SESSION[user_id]', '$admin_name', '$email_id', '$password')";
            $insert_admin_credentials_rec = mysql_query($insert_admin_credentials_sql);
            if($insert_admin_credentials_rec)
            {
               $insert_id = mysql_insert_id();
               $insert_admin_floor_sql = "insert into office_admin_assigned_floor_number(credential_id, floor_id) values('$insert_id','$floor_num')";
               $insert_admin_floor_rec = mysql_query($insert_admin_floor_sql);
               if($insert_admin_floor_rec)
               {
                  echo "<script>
                        alert('Admin Assigned To The Floor')
                        location.replace('dashboard.php?');
                       </script> ";
               }else{

                  echo "<script>
                        alert('Admin Does Not Assigned To The Floor')
                        location.replace('dashboard.php?');
                       </script> ";
               }

            }else{

               echo "<script>
                        alert('Admin Does Not Assigned To The Floor')
                        location.replace('dashboard.php?');
                       </script> ";
            }

         }

      }
   }

   if(isset($_GET['menu']))
   {
      $menuId = base64_decode($_GET['menu']);
      $delMenuSql = "delete from site_admin_menu_master where menu_id = '$menuId'";
      $delMenuRec = mysql_query($delMenuSql);
      if($delMenuRec)
      {

               echo "<script>
                        alert('Menu Details Deleted')
                        location.replace('view_menu.php?');
                       </script> ";
      }else{

               echo "<script>
                        alert('Menu Details Does Not Deleted')
                        location.replace('view_menu.php?');
                       </script> ";
      }
   }

   if(isset($_GET['status']))
   {
    $status = base64_decode($_GET['status']);
    $menuId = base64_decode($_GET['menuId']);
    $updateStatusSql = "update site_admin_menu_master set menu_status = '$status' where menu_id = '$menuId'";
    $updateStatusRec = mysql_query($updateStatusSql);
    if($updateStatusRec)
    {
       echo "<script>
              alert('Menu Status Updated')
              location.replace('view_menu.php?');
             </script> ";
    }else{

        echo "<script>
              alert('Menu Status Not Updated')
              location.replace('view_menu.php?');
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
     <!--  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCq8ldkEVqlrZ6A3iCY0NsNOU4ED7SO7jQ&libraries=places&callback=initAutocomplete" async defer></script> -->
      <script type="text/javascript" src="../js/all.js"></script>
      <link rel="stylesheet" type="text/css" href="../css/styles.css">
      <link href="https://fonts.googleapis.com/css?family=Roboto | Orbitron | Audiowide" rel="stylesheet">
   </head>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCq8ldkEVqlrZ6A3iCY0NsNOU4ED7SO7jQ&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>

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
                     <img src="../images/options.png" width="40" height="40" class="optionsImage dropdown-toggle" data-toggle="dropdown">
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
                        $menu_master_sql = "select * from site_admin_menu_master where menu_status = 1 and menu_parent = 0";
                        $menu_master_rec = mysql_query($menu_master_sql);
                        while ($menu_master_res = mysql_fetch_assoc($menu_master_rec))
                        {
                        ?>
                     <div style=" padding-bottom: 2em;"><a class="anchor" href="<?php echo $menu_master_res['menu_link'];?>"> <?php echo strtoupper($menu_master_res['menu_name']);?> </a></div>
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
                  <div class="col-lg-9" style="margin-top: 1.5em">
                     <table class="table table-hover features" width="90%" align="center">
                        <tr>
                           <td class="featureHeader" colspan="10">
                              Menu List
                           </td>
                        </tr>
                        <tr>
                          <td align="center">#</td>
                          <td>Name</td>
                          <td>Link</td>
                          <td>Parent</td>
                          <td>Add</td>
                          <td>View</td>
                          <td>Id</td>
                          <td align="center">Status</td>
                          <td colspan="2" align="center">Options</td>
                        </tr>
                        <?php
                           $i = 1;
                           if(isset($_GET['menu']))
                           {
                                $menuId = base64_decode($_GET['menu']);
                            $menu_master_sql = "select * from menu_master where menu_status = 1 and menu_parent = '$menuId' and company_id='$_SESSION[company_id]'";
                           }else{
                             $menu_master_sql = "select * from site_admin_menu_master";
                           }
                            // echo $menu_master_sql;
                           $menu_master_rec = mysql_query($menu_master_sql);
                           while ($menu_master_res = mysql_fetch_assoc($menu_master_rec))
                           {

                           ?>
                        <tr style="font-family: 'Play', sans-serif">
                           <td align="center"><?php echo $i;?></td>
                           <td><?php echo $menu_master_res['menu_name'];?></td>
                           <td>
                              <?php echo $menu_master_res['menu_link'];?>
                           </td>
                           <td>
                           <?php
                              if($menu_master_res['menu_parent'] == 0)
                              {
                                echo "Parent";
                              }else{
                                $parent_fetch_sql = "select * from site_admin_menu_master where menu_id = '$menu_master_res[menu_parent]'";
                                $parent_fetch_rec = mysql_query($parent_fetch_sql);
                                $parent_fetch_res = mysql_fetch_assoc($parent_fetch_rec);
                                echo $parent_fetch_res['menu_name'];
                              }
                           ?>
                          </td>
                          <td>
                               <?php if($menu_master_res['add_option'] == 1){

                                    echo "Yes";
                                }else{
                                    echo "No";
                                }
                                ?>
                          </td>
                           <td>
                              <?php if($menu_master_res['view_option'] == 1){

                                    echo "Yes";
                                }else{
                                    echo "No";
                                }
                                ?>
                          </td>
                           <td>
                              <?php echo $menu_master_res['add_id'];?>
                          </td>
                          <td>
                              <?php

                               if($menu_master_res['menu_status'])
                               {
                               ?>
                               <a href="view_menu.php?status=<?php echo base64_encode(0);?>&menuId=<?php echo base64_encode($menu_master_res['menu_id']);?>">
                               <table  width="80%" border="0" align="right" style="border:0px solid #ccc;  border-radius: 5px ;margin-left: 2em; margin-right: 0.8em ; cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4; background-color:#96CF9D; color: white">
                                    <tr height="25px">
                                       <td align="center">Active</td>
                                    </tr>
                            </table>
                            </a>
                                <?php
                                }else{
                                ?>
                                <a href="view_menu.php?status=<?php echo base64_encode(1);?>&menuId=<?php echo base64_encode($menu_master_res['menu_id']);?>">
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
                          <td>
                         <table  width="80%" border="0" align="right" style="border:0px solid #ccc;  border-radius: 5px ;margin-left: 2em; margin-right: 0.8em ; cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4; background-color:#96CF9D; color: white">
                                    <tr height="25px">
                                       <td align="center">Edit</td>
                                    </tr>
                            </table>
                          </td>
                          <td>
                          <a href="view_menu.php?menu=<?php echo base64_encode($menu_master_res['menu_id']);?>">
                             <table width="80%" border="0" align="right" style="border:0px solid #ccc;  border-radius: 5px ;margin-left: 2em; margin-right: 0.8em ;cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4; background-color:#C70039; color: white">
                                    <tr height="25px">
                                       <td align="center">Delete</td>
                                    </tr>
                            </table>
                            </a>
                          </td>
                        </tr>
                        <?php
                           $i++;
                           }
                        ?>
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



        <!-- Modal Add Office -->
      <div class="modal fade" id="office" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header modalHeader">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">ADD OFFICE</h4>
               </div>
               <div class="modal-body">
                  <form name="addOfficeForm" action="" method="POST">
                     <div class="form-group">
                        <label for="autocomplete">Office Location</label>
                        <input type="txt" class="form-control" id="autocomplete" name="autocomplete" >
                     </div>
                     <div class="form-group">
                        <label for="offname">Office Name</label>
                        <input type="txt" class="form-control" id="offname" name="offname" onfocus="geolocate()">
                     </div>
                      <div class="form-group">
                        <label for="offfloor">Floor Number</label>
                        <input type="txt" class="form-control" id="offfloor" name="offfloor">
                     </div>
                     <button type="submit" class="btn btn-default btn-success" name="Submit" value="addOffice">Add Office</button>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>


    <!-- Modal Add Office Admin -->
      <div class="modal fade" id="admin" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header modalHeader">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">ADD OFFICE ADMIN</h4>
               </div>
               <div class="modal-body">
                  <form name="addOfficeAdminForm" action="" method="POST">
                     <!-- <div class="form-group">
                        <label for="autocomplete">Office Locaation:</label>
                        <input type="txt" class="form-control" id="autocomplete" name="autocomplete">
                     </div> -->

                     <div class="form-group">
                        <label for="officeloc">Select Office Location</label>
                        <select class="form-control" id="officeloc" name="officeloc" onchange="chk_floor()">
                        <option value="0">... Select ...</option>
                         <?php
                           $location_sql = "select * from office_master where admin_id='$_SESSION[user_id]' and office_status=1";
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
                    <div class="form-group" id="areaHint">
                        <?php include "find_floors.php";?>
                    </div>
                     <div class="form-group">
                        <label for="admin_name">Admin Name</label>
                        <input type="txt" class="form-control" id="admin_name" name="admin_name">
                     </div>
                      <div class="form-group">
                        <label for="uname">Email Id</label>
                        <input type="email" class="form-control" id="uname" name="uname">
                     </div>
                      <div class="form-group">
                        <label for="passwd">Password</label>
                        <input type="password" class="form-control" id="passwd" name="passwd">
                     </div>
                     <button type="submit" class="btn btn-default btn-success" name="Submit" value="addOfficeAdmin" >Add Office Admin</button>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>


   </body>
</html>