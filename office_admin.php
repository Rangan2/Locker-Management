<?php
session_start();
include "connection/connection.php";
if(isset($_POST['Submit']))
{
	$location = $_POST['officeloc'];	
	$floor_num = $_POST['fnum'];
	$admin_name = $_POST['admin_name'];
	$email_id = $_POST['uname'];
	if($_POST['Submit'] == "Enter")
	{	
		$password = md5($_POST['passwd']);
		$admin_fetch_sql = "select * from office_admin_credentials_master where office_id = '$location' and added_by = '$_SESSION[admin_id]'";
		//echo $admin_fetch_sql;
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
								location.replace('office_admin.php?');
				 		  </script>	";
			}else{
			
				$insert_admin_floor_sql = "insert into office_admin_assigned_floor_number(credential_id, floor_id) values('$admin_fetch_res[credential_id]','$floor_num')";
				$insert_admin_floor_rec = mysql_query($insert_admin_floor_sql);
				if($insert_admin_floor_rec)
				{
						echo "<script>
								alert('Floor Assigned To The Admin')
								location.replace('office_admin.php?');
				 		  </script>	";
				}else{
				
						echo "<script>
								alert('Floor Does Not Assigned To The Admin')
								location.replace('office_admin.php?');
				 		  </script>	";
				}
			}
			
		}else{
			
				$insert_admin_credentials_sql = "insert into office_admin_credentials_master(office_id, added_by, admin_name, email_id, password) values('$location', '$_SESSION[admin_id]', '$admin_name', '$email_id', '$password')";
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
								location.replace('office_admin.php?');
				 		 	  </script>	";
					}else{
				
						echo "<script>
								alert('Admin Does Not Assigned To The Floor')
								location.replace('office_admin.php?');
				 		  	  </script>	";
					}
						
				}else{
	
					echo "<script>
								alert('Admin Does Not Assigned To The Floor')
								location.replace('office_admin.php?');
				 		  	  </script>	";			
				}
		}
	}elseif($_POST['Submit'] == "Edit")
	{
		$admin_id = base64_decode($_GET['Edit']);
		$update_sql = "update office_admin_master set floor_id='$floor_num', admin_name='$admin_name', admin_email_id='$user_name' where admin_id='$admin_id'";
		$update_rec = mysql_query($update_sql);
		if($update_rec)
		{
			echo "<script>
					alert('Office Admin Details Updated')
					location.replace('office_admin.php?')
				  </script>";
		}else{
		
			echo "<script>
					alert('Office Admin Details Does Not Updated')
					location.replace('office_admin.php?')
				  </script>";
		}	
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
	//	echo $update_assign_floor_sql;exit;
		if($update_assign_floor_rec)
		{
			echo "<script>
					alert('Admin Details Updated')
					location.replace('office_admin.php?');
				  </script>	";
		}else{
		
			echo "<script>
					alert('Admin Details Does Not Updated')
					location.replace('office_admin.php?');
				  </script>	";
		}
	}else{
		
		echo "<script>
					alert('Admin Details Does Not Updated')
					location.replace('office_admin.php?');
			  </script>	";
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
					alert('Admin Details Deleted')
					location.replace('office_admin.php?');
			  </script>	";
		
	}else{
	
		echo "<script>
					alert('Admin Details Does Not Deleted Successfully')
					location.replace('office_admin.php?');
			  </script>	";
	}
}

if(isset($_GET['Edit']))
{
	$admin_id = base64_decode($_GET['Edit']);
	$floor_id = base64_decode($_GET['floor']);
	$admin_fetch_sql = "select * from office_admin_credentials_master where credential_id='$admin_id'";
	//echo $office_add_sql;
	$admin_fetch_rec = mysql_query($admin_fetch_sql);
	$admin_fetch_res = mysql_fetch_assoc($admin_fetch_rec);
	$floor_master_fetch = "select * from office_admin_assigned_floor_number where assign_floor_id='$floor_id' and credential_id = '$admin_id'";
	$floor_master_fetch_rec = mysql_query($floor_master_fetch);
	$floor_master_fetch_res = mysql_fetch_assoc($floor_master_fetch_rec);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Locker Management | Dashboard</title>
<link rel="stylesheet" type="text/css" href="css/all.css" />
<script src="js/all.js" language="javascript" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
	
	var placeSearch, offloc;
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

 function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }
		
		
for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }
	  
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
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAc8fHUqmTfv9jmfACtihZ1wV0CHf0Pks&libraries=places&callback=initAutocomplete"
        async defer></script>
<body onload="startclock()">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"><table width="99%" border="0" cellpadding="0" cellspacing="0" class="dashboard_mid_row_tab">
      <tr>
        <td><?php  include "include/header.php"?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30" align="center"><table width="99%" border="0" align="left" cellpadding="0" cellspacing="0" class="dashboard_mid_row_tab">
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><form id="form1" name="form1" method="post" action="" onsubmit="return office_admin_chk()">
          <table width="35%" border="0" class="inner_tab_index">
            <tr>
              <td height="25" colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr align="left">
              <td width="8%" height="25" >&nbsp;</td>
              <td width="92%" >Office Location  </td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center">
			  <?php 
			  	$sql = "select * from office_master where admin_id='$_SESSION[user_id]' and office_status=1";
				$rec = mysql_query($sql);
			  ?>
			  <select name="officeloc" class="inner_tab_index_txt_box" id="officeloc" style=" width:380px" onchange="chk_floor()" >
			  <option value="0">Select</option>
			  <?php
			  	while($res = mysql_fetch_assoc($rec))
				{
			  ?>
			  <option value="<?php echo $res['office_id'];?>" <?php if(@$admin_fetch_res['office_id']==@$res['office_id']){echo "selected";}?>><?php echo $res['office_location'];?></option>
			  <?php
			  	}
			  ?>
              </select>              </td>
            </tr>
            <tr align="left">
              <td height="25">&nbsp;</td>
              <td height="25">Floor Number </td>
            </tr>
            <tr align="left">
              <td height="25" colspan="2" align="center"><div id="areaHint"><?php include "find_floors.php";?></div></td>
            </tr>

            <tr align="left">
              <td height="25">&nbsp;</td>
              <td height="25">Admin Name </td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center"><input name="admin_name" type="text" class="inner_tab_index_txt_box" id="admin_name" size="50" placeholder="Enter The Full Name of The Admin" value="<?php echo @$admin_fetch_res['admin_name'];?>" /></td>
            </tr>
            <tr>
              <td height="10" align="center">&nbsp;</td>
              <td height="25">Email Id </td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center"><input name="uname" type="text" class="inner_tab_index_txt_box" id="uname" size="50" placeholder="Enter The Email Id of The Admin" value="<?php echo @$admin_fetch_res['email_id'];?>" /></td>
            </tr>
			<?php
				if(!isset($_GET['Edit']))
				{
			?>
            <tr>
              <td height="25" align="center">&nbsp;</td>
              <td height="25">Password</td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center"><input name="passwd" type="password" class="inner_tab_index_txt_box" id="passwd" size="50" placeholder="Enter The Password of The Admin" value="<?php echo @$office_add_res['office_name'];?>" /></td>
            </tr>
			<?php
				}
			?>
            <tr>
              <td height="10" colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td height="10" colspan="2" align="center"><input name="Submit" type="submit" class="btn" id="Submit" value="<?php if(isset($_GET['Edit'])){echo "Edit";}else{echo "Enter";}?>" /></td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center">&nbsp;</td>
            </tr>
          </table>
        </form>        </td>
      </tr>
  <?php
  	$office_admin_sql = "select * from office_admin_credentials_master where added_by = '$_SESSION[user_id]'";
	//echo $office_admin_sql;
	$office_admin_rec = mysql_query($office_admin_sql);
	$office_admin_num_rows = mysql_num_rows($office_admin_rec);
	if($office_admin_num_rows > 0)
	{
  ?>
      <tr>
        <td height="30" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" align="center"><table width="80%" border="0">
            <tr>
              <td height="30" colspan="7" align="center" class="lsit_head">L I S T </td>
            </tr>
            <tr class="list_sec_row">
              <td width="7%" align="center">Sl . No . </td>
              <td width="23%" height="30">Office Location </td>
              <td width="10%" align="center">Floor Number</td>
              <td width="11%">Admin Name </td>
              <td width="14%">Email Id </td>
              <td width="11%" align="center">Status</td>
              <td width="24%" align="center">Option</td>
            </tr>
     <?php
	  	$i = 1;
	  	while($office_admin_res = mysql_fetch_assoc($office_admin_rec))
		{
			$office_sql = "select * from office_master where office_id='$office_admin_res[office_id]'";
			$office_rec = mysql_query($office_sql);
			$office_res = mysql_fetch_assoc($office_rec);
			$floor_details_sql = "select * from office_admin_assigned_floor_number where credential_id='$office_admin_res[credential_id]'";
			//echo $floor_details_sql;
			$floor_details_rec = mysql_query($floor_details_sql);
			if($i % 2 == 0)
			{
				$bg = "bgcolor=#E1E1E1";	
			}else{
				$bg = "bgcolor=#B9B9B9";
			}
			while($floor_details_res = mysql_fetch_assoc($floor_details_rec))
			{
				//echo $floor_details_res['floor_id'];
				$floor_num_fetch_sql = "select * from floor_master where floor_id = '$floor_details_res[floor_id]'";
				$floor_num_fetch_rec = mysql_query($floor_num_fetch_sql);
				$floor_num_fetch_res = mysql_fetch_assoc($floor_num_fetch_rec);
	  ?>
            <tr class="list_dyn_row" <?php echo $bg;?>>
              <td height="30" align="center"><?php echo $i;?></td>
              <td height="30"><?php echo $office_res['office_location'];?></td>
              <td height="30" align="center"><?php echo $floor_num_fetch_res['floor_number'];?></td>
              <td height="30"><?php echo $office_admin_res['admin_name'];?></td>
              <td style="cursor:pointer"><?php echo $office_admin_res['email_id'];?></td>
              <td align="center" style="cursor:pointer"><?php
			if($floor_details_res['assign_floor_status'] == 1 )
			{
		?>
                  <a href="office_admin.php?status=<?php echo base64_encode(0);?>&office=<?php echo base64_encode($office_admin_res['credential_id']);?>&assign_floor=<?php echo base64_encode($floor_details_res['assign_floor_id']);?>"><img src="images/green.gif" width="24" height="24" /></a>
                  <?php
			}else{
		?>
                  <a href="office_admin.php?status=<?php echo base64_encode(1);?>&office=<?php echo base64_encode($office_admin_res['credential_id']);?>&assign_floor=<?php echo base64_encode($floor_details_res['assign_floor_id']);?>"><img src="images/red.gif" width="24" height="24" /></a>
                  <?php
			}
		?>              </td>
              <td height="30" align="center"><table width="99%" border="0" style="cursor:pointer;">
                  <tr>
                    <td width="48%" align="center"><table width="99%" border="0" class="index_outer_tab">
                        <tr>
                          <td align="center"><a style="text-decoration:none; color:#000000;" href="office_admin.php?Edit=<?php echo base64_encode($office_admin_res['credential_id']);?>&floor=<?php echo base64_encode($floor_details_res['assign_floor_id']);?>">Edit</a></td>
                        </tr>
                    </table></td>
                    <td width="9%">&nbsp;</td>
                    <td width="43%" align="center" ><table width="99%" border="0" class="index_outer_tab">
                        <tr>
                          <td align="center" onclick="deleteFunc('office_admin.php?Delete=<?php echo base64_encode($office_admin_res['credential_id']);?>&Dfloor=<?php echo base64_encode($floor_details_res['assign_floor_id']);?>');">Delete</td>
                        </tr>
                    </table></td>
                  </tr>
              </table></td>
            </tr>
            <?php
	  		$i++;
	  	}
	}
	  ?>
	  <tr class="list_dyn_row" <?php echo $bg;?>>
              <td height="30" align="center">&nbsp;</td>
              <td height="30">&nbsp;</td>
              <td height="30" align="center">&nbsp;</td>
              <td height="30">&nbsp;</td>
              <td style="cursor:pointer">&nbsp;</td>
              <td align="center" style="cursor:pointer">&nbsp;</td>
              <td height="30" align="center">&nbsp;</td>
            </tr>
        </table></td>
      </tr>
	  <?php
  	}
  ?>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
</table>
</body>
</html>
