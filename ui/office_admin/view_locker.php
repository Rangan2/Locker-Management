<?php
   session_start();
   include "../connection/connection.php";
   include "../include/paginator.php";
   include "include/chk_login.php";
   $company_name_sql = "select * from company_master where company_id='$_SESSION[company_id]'";
   $company_name_rec = mysql_query($company_name_sql);
   $company_name_res = mysql_fetch_assoc($company_name_rec);

   if(isset($_POST['Submit']))
   {
      $officeLocation = $_POST['officeloc'];
      $floorNum = $_POST['fnum'];
      $offLocker = $_POST['off_locker'];
      $offLockerArray = explode(",", $offLocker);
     // echo $offLocker;
      if($_POST['Submit'] == "addLocker")
      {
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
      }
}


if(isset($_GET['locker']))
    {

      $locker = base64_decode($_GET['locker']);
      $office = base64_decode($_GET['office']);
      $floor = base64_decode($_GET['floor']);
      $lockerAssignChkSql = "select * from locker_assign where office_id = $office and floor_id = $floor and locker_id = $locker";
    // echo $lockerAssignChkSql;
      $lockerAssignChkRec = mysql_query($lockerAssignChkSql);
      $lockerAssignChkNum = mysql_num_rows($lockerAssignChkRec);
     // echo  $lockerAssignChkNum;exit;
      if( $lockerAssignChkNum > 0)
      {

        echo "<script>
                      alert('Locker Already Assigned, Kindly Delete The Assigned Locker First')
                      location.replace('view_locker.php?');
                  </script>";

      }else{
        $lockerDelSql = "delete from locker_master where locker_id = $locker";
        //echo $lockerDelSql;
        $lockerDelRec = mysql_query($lockerDelSql);
        if($lockerDelRec)
        {
            echo "<script>
                      alert('Locker Details Deleted')
                      location.replace('view_locker.php?');
                  </script>";

        }else{
             echo "<script>
                      alert('Locker Details Does Not Deleted')
                      location.replace('view_locker.php?');
                  </script>";

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
                    <table class="table table-hover table-responsive features" width="90%" align="center">
                    <input type="hidden" name="officeId" id="officeId" value="<?php echo $_SESSION['office_id'];?>" />
                        <tr>
                           <td width="12%" class="featureHeader" style="padding-top: 2em">
                              Search Locker                           </td>
                            <td width="10%" class="featureHeader" align="center" style="padding-top: 2em; color: #5D6D7E;">
                              Office</td>
                           <td width="20%" class="featureHeader"><select class="form-control" id="office" name="office" onchange="search_locker_floor()" style="width: 9em;">
                             <option value="0">... Select ...</option>
                             <?php
                                   $office_sql = "select * from office_admin_credentials_master cOffice, office_master officeMaster where cOffice.email_id = '$_SESSION[email_id]' and cOffice.office_id = officeMaster.office_id";
                                  // echo $floor_sql;exit;
                                   $office_rec = mysql_query($office_sql);
                                   while($office_res = mysql_fetch_assoc($office_rec))
                                   {
                                 ?>
                             <option value="<?php echo $office_res['office_id'];?>"><?php echo $office_res['office_location'];?></option>
                             <?php
                                }
                                   ?>
                           </select></td>
                            <td width="12%" class="featureHeader" align="center" style="padding-top: 2em; color: #5D6D7E">
                              Floor Number                           </td>
                           <td width="20%" class="featureHeader"><div id="showFloor"><?php include "search_locker_floor.php";?></div></td>
                            <td width="12%" align="center" class="featureHeader" style="padding-top: 2em;  color: #5D6D7E">
                              Locker Number</td>
                <td width="20%"><input type="txt" style="width: 100%" class="form-control" id="locker_number" name="locker_number" onkeyup="search_added_locker()">
                </td>
                 <tr>
            <td height="30" align="center" colspan="7"><div id="showList"><?php include "view_added_locker.php";?></div></td>
          </tr>
                        </tr>
                    </table>
                 </div>
               </div>
         </div>
      </div>

   </body>
</html>