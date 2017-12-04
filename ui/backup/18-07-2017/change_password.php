<?php
   session_start();
   include "connection/connection.php";
   $company_name_sql = "select * from company_master where company_id='$_SESSION[company_id]'";
   $company_name_rec = mysql_query($company_name_sql);
   $company_name_res = mysql_fetch_assoc($company_name_rec);

if(isset($_POST['Submit']))
{
   $oldpass = md5($_POST['oldpass']);
   $new_pass = md5($_POST['newpass']);
   $pass_sql = "select * from company_admin_master where company_id='$_SESSION[company_id]'";
   $pass_rec = mysql_query($pass_sql);
   //$pass_row = mysql_num_rows($pass_rec);
   $pass_res = mysql_fetch_assoc($pass_rec);
   if( $pass_res['password'] == $oldpass)
   {
      $update_password = "update company_admin_master set password='$new_pass' where company_id='$_SESSION[company_id]'";
      $update_password_rec = mysql_query($update_password);
      if($update_password_rec)
      {
         echo "<script>
                  alert('Password Updated')
                  location.replace('logout.php?');
              </script>";
      }else{
         echo "<script>
                  alert('Password Does Not Updated')
                  location.replace('change_password.php?');
              </script>";
      }
   }else{
      echo "<script>
               alert('Old Password Does Not Matched')
               location.replace('change_password.php?');
           </script>";
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
                        <li >Change Password</li>
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
                           <td width="73" class="featureHeader modalHeader">
                              Change Password
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <form name="addOfficeForm" action="" method="POST">
                                 <div class="form-group">
                                    <label for="autocomplete">Enter Old Password</label>
                                    <input type="Password" class="form-control" id="oldpass" name="oldpass" >
                                 </div>
                                 <div class="form-group">
                                    <label for="offname">Enter New Password</label>
                                    <input type="Password" class="form-control" id="newpass" name="newpass">
                                 </div>
                                 <div class="form-group">
                                    <label for="offfloor">Confirm New Password</label>
                                    <input type="Password" class="form-control" id="rnewpass" name="rnewpass">
                                 </div>
                                 <button type="submit" class="btn btn-default btn-success" name="Submit" value="editOffice">Change Password</button>
                              </form>
                           </td>
                        </tr>
                        <tr>
                           <td align="center">&nbsp;</td>
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