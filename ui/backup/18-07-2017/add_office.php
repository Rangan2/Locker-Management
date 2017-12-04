<?php
   session_start();
   include "connection/connection.php";
   $company_name_sql = "select * from company_master where company_id='$_SESSION[company_id]'";
   $company_name_rec = mysql_query($company_name_sql);
   $company_name_res = mysql_fetch_assoc($company_name_rec);
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
                        <li><a href="#">Change Password</a></li>
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
                        &nbsp
                     </div>
                  </div>
                  <div class="col-lg-9" style="border: 1px solid #000; background-color: white; margin-top: 1em; margin-left: 0em;">
                     <div class="col-lg-9 headerAddOffice">
                           ADD OFFICE
                     </div>
                        <form name="loginForm addOfficeBody" action="" method="POST">
                           <div class="addOfficeBody">
                                    <label for="autocomplete">Office Location</label>
                                    <input type="txt" class="form-control" id="autocomplete" name="autocomplete">
                           </div>
                            <div class="addOfficeBody">
                                    <label for="autocomplete">Office Name</label>
                                    <input type="txt" class="form-control" id="autocomplete" name="autocomplete">
                           </div>
                            <div class="addOfficeBody">
                                    <label for="autocomplete">Floor Number</label>
                                    <input type="txt" class="form-control" id="autocomplete" name="autocomplete">
                           </div>
                        </form>
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