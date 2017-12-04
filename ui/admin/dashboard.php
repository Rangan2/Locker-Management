<?php
   session_start();
   include "../connection/connection.php";
   //include "../include/chk_login.php";
   $company_name_sql = "select * from site_admin_login_master where login_id='$_SESSION[admin_id]'";
   $company_name_rec = mysql_query($company_name_sql);
   $company_name_res = mysql_fetch_assoc($company_name_rec);

   if(isset($_POST['Submit']))
   {
      if($_POST['Submit'] == "addMenu")
      {
            $menu_parent = $_POST['menu_parent'];
            $menu_name = $_POST['menu_name'];
            $menu_link = $_POST['menu_link'];
            $menu_insert_sql = "insert into site_admin_menu_master(menu_name, menu_link, menu_parent) values('$menu_name', '$menu_link', '$menu_parent')";
            $menu_insert_rec = mysql_query($menu_insert_sql);
            if($menu_insert_rec)
            {
              echo "<script>
                  alert('Menu Details Added')
                  location.replace('dashboard.php?');
                    </script>";

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

     <script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
      {types: ['geocode']});

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();
  console.log (place);

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }
  document.getElementById('save').disabled = false;
  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
  if (place.geometry.location.H && place.geometry.location.L)
  {
      document.getElementById("H").value = place.geometry.location.H;
      document.getElementById("L").value = place.geometry.location.L;
      document.getElementById("addr").value = place.formatted_address;
  }

}
// [END region_fillform]

// [START region_geolocation]
        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });
                    autocomplete.setBounds(circle.getBounds());
                });
            }
        }
        // [END region_geolocation]
    </script>
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
                    <?php include "include/sider.php";?>
                  </div>
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
                            $menu_master_sql = "select * from menu_master where menu_status = 1 and menu_parent = '$menuId' and company_id='$_SESSION[company_id]'";
                           }else{
                             $menu_master_sql = "select * from site_admin_menu_master where menu_status = 1 and menu_parent = 0 ";
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
      <div class="modal fade" id="addMenu" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header modalHeader">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">ADD OFFICE</h4>
               </div>
               <div class="modal-body">
                  <form name="addMenuForm" action="" method="POST">
                    <div class="form-group">
                      <label for="menu_parent">Menu Parent</label>
                       <select  id="menu_parent" class="form-control"  name="menu_parent">
                               <option value="0">... Select ...</option>
                               <?php
                                //echo $_SESSION['office_id'];
                                $menu_fetch_sql = "select * from site_admin_menu_master where menu_status = '1'";
                                //echo $office_sql;
                                $menu_fetch_rec = mysql_query($menu_fetch_sql);
                                while($menu_fetch_res = mysql_fetch_assoc($menu_fetch_rec))
                                {
                               ?>
                              <option value="<?php echo $menu_fetch_res['menu_id'];?>" <?php if( @$menu_fetch_res['menu_id'] == @$menu_update_fetch_res['menu_id']){echo "selected";}?>><?php echo $menu_fetch_res['menu_name'];?></option>
                               <?php
                                }
                               ?>
                        </select>
                    </div>
                     <div class="form-group">
                        <label for="menu_name">Menu Name</label>
                        <input type="txt" class="form-control" id="menu_name" name="menu_name">
                     </div>
                      <div class="form-group">
                        <label for="offfloor">Menu Link</label>
                        <input type="txt" class="form-control" id="menu_link" name="menu_link">
                     </div>
                     <button type="submit" class="btn btn-default btn-success" name="Submit" value="addMenu">Add Menu</button>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>


    <!-- Modal Add Office Admin -->
      <div class="modal fade" id="companyMenu" role="dialog">
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