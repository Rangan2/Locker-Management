<?php
   session_start();
   include "connection/connection.php";
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
           // echo $floor_sql;exit;
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

   if(isset($_GET['del']))
   {
        $officeId = base64_decode($_GET['del']);
        $status = base64_decode($_GET['status']);
        $update_office_master_sql = "update office_master set office_status = '$status' where office_id = '$officeId'";
        $update_office_master_rec = mysql_query($update_office_master_sql);
        if($update_office_master_rec){
          $updateFloorSql = "update floor_master set floor_status = '$status' where office_id = '$officeId'";
          //echo $updateFloorSql;
          $updateFloorRec = mysql_query($updateFloorSql);
          if($updateFloorRec)
          {
              $fetchcredentialSql = "select * from office_admin_credentials_master where office_id = '$officeId'";
              $fetchcredentialRec = mysql_query($fetchcredentialSql);
              $fetchcredentialRes = mysql_fetch_assoc($fetchcredentialRec);
              $updateAdminSql = "update office_admin_credentials_master set admin_status = '$status' where office_id = '$officeId'";
              //echo $updateAdminSql;
              $updateAdminRec = mysql_query($updateAdminSql);
              if($updateAdminSql)
              {
                  $updateAssFloorSql = "update office_admin_assigned_floor_number set assign_floor_status = '$status' where credential_id = '$fetchcredentialRes[credential_id]'";
                  // echo $updateAssFloorSql;
                   $updateAssFloorRec = mysql_query($updateAssFloorSql);
                  // $updateAssFloorRes = mysql_fetch_assoc($updateAssFloorRec);
                  if($updateAssFloorRec)
                  {
                      $updateAssLockerSql = "update locker_assign set assignment_status = '$status' where office_id = '$officeId'";
                     // echo $updateAssLockerSql;exit;
                      $updateAssLockerRec = mysql_query($updateAssLockerSql);

                      if($updateAssLockerRec){

                          $updateLockerSql = "update locker_master set locker_status = '$status' where added_by = '$fetchcredentialRes[credential_id]'";
                   //       echo $updateLockerSql;exit;
                          $updateLockerRec = mysql_query($updateLockerSql);

                          if($updateLockerRec)
                          {

                                  echo "<script>
                                              alert('Office Details Updated')
                                              location.replace('company_details.php?');
                                        </script> ";

                          }else{
                           echo "<script>
                                      alert('Office Details Does Not Updated')
                                      location.replace('company_details.php?');
                                 </script> ";
                          }
                      }
                  }
              }
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
                     <div style="padding-bottom: 2em; padding-top: 0.5em; cursor: pointer;"><a class="anchor" href="dashboard.php">DASHBOARD</a></div>
                     <?php
                        $menu_master_sql = "select * from menu_master where menu_status = 1 and menu_parent = 0";
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
                           <td class="featureHeader" colspan="4">
                              Project Features                           </td>
                        </tr>
                        <?php

                           $i = 1;
                           if(isset($_GET['menu']))
                           {
                                $menuId = base64_decode($_GET['menu']);
                            $office_master_sql = "";
                           }else{
                             $office_master_sql = "select * from office_master where company_id=$_SESSION[company_id]";
                           }
                          //  echo $company_master_sql;
                           $office_master_rec = mysql_query($office_master_sql);
                           while ($office_master_res = mysql_fetch_assoc($office_master_rec))
                           {

                           ?>
                        <tr style="font-family: 'Play', sans-serif">
                           <td width="29%"><?php echo $office_master_res['office_name'];?></td>
                           <td width="30%">
                                <?php echo $office_master_res['office_location'];?>                           </td>
                           <td width="15%">
                           <?php
                              if($office_master_res['office_status'] == 0)
                              {
                           ?>
                          <a href="company_details.php?del=<?php echo base64_encode($office_master_res['office_id']);?>&status=<?php echo base64_encode(1)?>">
                          <table id="view<?php echo $i;?>" width="67%" border="0" align="right" style="border:0px solid #ccc;  border-radius: 5px ;margin-left: 2em; cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4; background-color:#96CF9D">
                            <tr height="25px">
                              <td align="center">Reactivate</td>
                            </tr>
                          </table>
                          </a>
                          <?php
                            }else{
                          ?>

                             <a href="company_details.php?del=<?php echo base64_encode($office_master_res['office_id']);?>&status=<?php echo base64_encode(0)?>">
                          <table id="view<?php echo $i;?>" width="67%" border="0" align="right" style="border:0px solid #ccc;  border-radius: 5px ;margin-left: 2em; cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4; background-color:#FC4778">
                            <tr height="25px">
                              <td align="center">Deactivate</td>
                            </tr>
                          </table>
                          </a>
                          <?php
                            }
                          ?>
                          </td>

                        </tr>
                        <?php
                           $i++;
                           }
                        ?>
                     </table>                  </div>
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