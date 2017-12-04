<?php
   session_start();
   include "../connection/connection.php";
   include "include/chk_login.php";
   $company_name_sql = "select * from company_master where company_id='$_SESSION[company_id]'";
   $company_name_rec = mysql_query($company_name_sql);
   $company_name_res = mysql_fetch_assoc($company_name_rec);

   if(isset($_POST['Submit']))
   {
     // echo $offLocker;
      if($_POST['Submit'] == "addLocker")
      {
        $officeLocation = $_POST['officeloc'];
        $floorNum = $_POST['fnum'];
        $offLocker = $_POST['off_locker'];
        $offLockerArray = explode(",", $offLocker);
         $extstLockerDetails = "";
         for($i = 0; $i < count($offLockerArray); $i++)
         {
              // echo $i."@";
               $locker_fetch_sql = "select * from locker_master where locker_number=' $offLockerArray[$i]' and floor_id=$floorNum and office_id = '$officeLocation'";
               //echo $locker_fetch_sql;exit;
               $locker_fetch_rec = mysql_query($locker_fetch_sql);
               $locker_fetch_num = mysql_num_rows($locker_fetch_rec);
              // echo $locker_fetch_num ;exit;
               if($locker_fetch_num > 0){

                    /* echo "<script>
                              alert($offLockerArray[$i]);
                           </script>";*/
                  if($extstLockerDetails == "")
                  {
                         $extstLockerDetails = $offLockerArray[$i];
                  }else{
                         $extstLockerDetails= $extstLockerDetails . ',' . $offLockerArray[$i];
                  }

                 }else{
                         $locker_sql = "insert into locker_master(office_id, floor_id, locker_number, added_by) values('$officeLocation', '$floorNum', '$offLockerArray[$i]', '$_SESSION[admin_id]')";
                         //echo $locker_sql;exit;
                         $locker_rec = mysql_query($locker_sql);
                         if($locker_rec)
                         {
                           echo "<script>
                                       alert('All Locker Details Added')
                                       location.replace('dashboard.php?');
                                 </script>";
                         }
               }
         }

        /* // echo count($extstLockerDetailsArr);exit;
               if(count($extstLockerDetails) != 0)
               {
                  $extstLockerDetailsArr = explode(',', $extstLockerDetails);
                  $str = implode(",", $extstLockerDetailsArr);
                  echo $str;
                  echo "<script>
                                 alert('The Lockers Already Exist For The Floor Number :'+$floorNum+' is :'+$str);
                                 location.replace('dashboard.php?');
                              </script>";
               }*/
      }elseif($_POST['Submit'] == "assLocker")
      {
          $officelocation = $_POST['officelocation'];
          $floorNum = $_POST['floornum'];
          $locker_num = $_POST['locker_num'];
          $emp_id = $_POST['emp_id'];
          $emp_name = $_POST['emp_name'];
          $date = date('Y-m-d H:i:s');
          $locker_fetch_sql = "select * from locker_assign where locker_id= '$locker_num' and floor_id = '$floorNum' and assignment_status = 1";
           //echo $locker_fetch_sql;exit;
          $locker_fetch_rec = mysql_query($locker_fetch_sql);
          $locker_fetch_num = mysql_num_rows($locker_fetch_rec);
          if( $locker_fetch_num  > 0)
          {
              echo "<script>
                      alert('Locker Already Assigned')
                      location.replace('dashboard.php?');
                    </script>";
          }else{

            $locker_assign_sql = "insert into locker_assign(office_id, floor_id, locker_id, emp_name, emp_id, assign_date) values('$officelocation', '$floorNum', '$locker_num', '$emp_name', '$emp_id', '$date')";
            $locker_assign_rec = mysql_query($locker_assign_sql);
            if($locker_assign_rec)
            {
              $locker_status_update_sql = "update locker_master set locker_status = 0 where office_id = '$officelocation' and floor_id = '$floorNum' and locker_id = '$locker_num'";
             // echo $locker_status_update_sql;exit;
              $locker_status_update_rec = mysql_query($locker_status_update_sql);
              if($locker_status_update_rec)
              {
                echo "<script>
                      alert('Locker Details Assigned')
                      location.replace('dashboard.php?');
                      </script>";
              }

            }else{

              echo "<script>
                  alert('Locker Not Asaigned')
                  location.replace('dashboard.php?');
                  </script>";

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
      <script type="text/javascript" src="../js/all.js"></script>
      <link rel="stylesheet" type="text/css" href="../css/styles.css">
      <link href="https://fonts.googleapis.com/css?family=Roboto | Orbitron | Audiowide" rel="stylesheet">
   </head>

   <body style="background-color: #303030">
      <div class="container-fluid">
         <div class="dashboardOuterDiv">
            <div class="dashboardInnerDiv">
               <div>
                  &nbsp;
               </div>
               <?php include "include/header.php";?>
               <?php include "include/sider.php";?>
                  <div class="col-lg-9" style="margin-top: 1.5em">
                     <table class="table table-hover features" width="90%" align="center">
                        <tr>
                           <td class="featureHeader" colspan="3">
                              Project Features
                           </td>
                        </tr>
                        <?php
                           $i = 1;
                           if(isset($_GET['menu']))
                           {
                              $menuId = base64_decode($_GET['menu']);
                              $menu_master_sql = "select * from  office_menu_master where company_id = $_SESSION[company_id] and menu_status = 1 and menu_parent = $menuId";
                           }else{
                              $menu_master_sql = "select * from office_menu_master where menu_status = 1 and menu_parent = 0";
                           }
                            // echo $menu_master_sql;
                           $menu_master_rec = mysql_query($menu_master_sql);
                           while ($menu_master_res = mysql_fetch_assoc($menu_master_rec))
                           {

                           ?>
                        <tr style="font-family: 'Play', sans-serif">
                           <td><?php echo $menu_master_res['menu_name'];?></td>
                           <td>
                           </td>
                           <td>
                            <?php
                                if($menu_master_res['menu_link'] != '#')
                                {
                                    if($menu_master_res['view_option'] == 1)
                                    {

                           ?>
                           <a href="<?php echo $menu_master_res['menu_link'];?>">
                              <table id="view<?php echo $i;?>" width="30%" border="0" align="right" style="border:0px solid #ccc;  border-radius: 5px ;margin-left: 2em; cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4; background-color:#88B0DC">
                                 <tr height="25px">
                                    <td align="center">View</td>
                                 </tr>
                              </table>
                              </a>
                                    <?php
                                    }
                                     if($menu_master_res['add_option'] == 1)
                                    {
                                    ?>
                              <table  width="30%" border="0" align="right" style="border:0px solid #ccc; background-color: #FC4778; border-radius: 5px ;margin-left: 2em; cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4;" >
                                 <tr height="25px">
                                    <td align="center" data-toggle="modal" data-target="#<?php echo $menu_master_res['add_id'];?>">Add</td>
                                 </tr>
                              </table>
                                    <?php
                                    }
                                    ?>
                               <?php
                                }else{
                           ?>
                                       <table width="30%" border="0" align="right" style="border:0px solid #ccc; background-color: #50C4A4; border-radius: 5px ;margin-left: 2em; cursor: pointer; color: #fff; box-shadow: 2px 2px 2px #c4c4c4;">
                                 <tr height="25px">
                                    <td align="center"><a href="dashboard.php?menu=<?php echo base64_encode($menu_master_res['menu_id']);?>" style="text-decoration: none; color: white;">Show More</a></td>
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
      <div class="modal fade" id="aLocker" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header modalHeader">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">ADD LOCKER</h4>
               </div>
               <div class="modal-body">
                  <form name="addOfficeForm" action="" method="POST">
                      <div class="form-group">
                        <label for="officeloc">Office Location</label>
                        <select class="form-control" id="officeloc" name="officeloc" onchange="chk_floor()">
                        <option value="0">... Select ...</option>
                         <?php
                           $location_sql = "select * from office_admin_credentials_master offCred, office_master oofMaster where offCred.email_id = '$_SESSION[email_id]' and offCred.office_id = oofMaster.office_id and oofMaster.office_status = 1 ";
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
                        <label for="offfloor">Locker Numbers</label>
                        <input type="txt" class="form-control" id="off_locker" name="off_locker">
                     </div>
                     <button type="submit" class="btn btn-default btn-success" name="Submit" value="addLocker">Add Locker</button>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>

          <div class="modal fade" id="asLocker" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header modalHeader">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">ASSIGN LOCKER</h4>
               </div>
               <div class="modal-body">
                  <form name="assignLockerForm" action="" method="POST">
                      <div class="form-group">
                        <label for="officeloc">Office Location</label>
                        <select class="form-control" id="officelocation" name="officelocation" onchange="chk_floor_ass()">
                        <option value="0">... Select ...</option>
                         <?php
                           $location_sql = "select * from office_admin_credentials_master offCred, office_master oofMaster where offCred.email_id = '$_SESSION[email_id]' and offCred.office_id = oofMaster.office_id and oofMaster.office_status = 1";
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
                        <input type="txt" class="form-control" id="emp_id" name="emp_id">
                     </div>
                      <div class="form-group">
                        <label for="offfloor">Employee Name</label>
                        <input type="txt" class="form-control" id="emp_name" name="emp_name">
                     </div>
                     <button type="submit" class="btn btn-default btn-success" name="Submit" value="assLocker">Assign Locker</button>
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