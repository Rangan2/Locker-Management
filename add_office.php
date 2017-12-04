<?php
session_start();
include "connection/connection.php";
if(isset($_POST['Submit']))
{
	$location = $_POST['autocomplete'];	
	$office_name = $_POST['offname'];
	$floor_num = $_POST['offfloor'];
	if($_POST['Submit'] == "Enter")
	{	
		$office_add_sql = "select * from office_master where office_location='$location' and company_id='$_SESSION[company_id]'";
		$office_add_rec = mysql_query($office_add_sql);
		$office_add_num_rows = mysql_num_rows($office_add_rec);
		$office_add_res = mysql_fetch_assoc($office_add_rec);
		$floor_sql = "select * from floor_master where office_id = '$office_add_res[office_id]' and floor_number = '$floor_num'";
		$floor_rec = mysql_query($floor_sql);
		$floor_num_rows = mysql_num_rows($floor_rec);
		if($floor_num_rows > 0)
		{
			echo "<script>
					alert('Floor Aready Exist For The Office')
					location.replace('add_office.php?');
			 	 </script>	";
		}else{
			if($office_add_num_rows > 0)
			{
				$floor_master = "insert into floor_master(office_id, floor_number) values('$office_add_res[office_id]', '$floor_num')";
				$floor_master_rec = mysql_query($floor_master);
				if($floor_master_rec)
				{
						echo "<script>
								alert('Office Details Added')
								location.replace('add_office.php?');
							 </script>	";
				}else{		
						echo "<script>
								alert('Office Details Does Not Added')
								location.replace('add_office.php?');
							 </script>	";
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
								location.replace('add_office.php?');
							 </script>	";
					}else{	
						echo "<script>
								alert('Office Details Does Not Added')
								location.replace('add_office.php?');
							  </script>	";
					} 
				}else{
					echo "<script>
							alert('Office Details Does Not Added')
							location.replace('add_office.php?');
						 </script>	";
				}
			}
		}
	}elseif($_POST['Submit'] == "Edit")
	{
		$office_id = base64_decode($_GET['Edit']);
		$floor_id = base64_decode($_GET['floor_id']);
		$update_sql = "update office_master set office_location='$location', office_name='$office_name' where office_id='$office_id'";
		//echo $update_sql;exit;
		$update_rec = mysql_query($update_sql);
		if($update_rec)
		{
			$update_floor_sql = "update floor_master set floor_number = '$floor_num' where floor_id='$floor_id'";
			$update_floor_rec = mysql_query($update_floor_sql);
			if($update_floor_rec)
			{
				echo "<script>
						alert('Office Details Updated')
						location.replace('add_office.php?');
					  </script>";
			}else{
				
				echo "<script>
						alert('Floor Details Does Not Updated')
						location.replace('add_office.php?');
					  </script>";
			}
		}else{
			
			echo "<script>
					alert('Data Not Updated')
					location.replace('add_office.php?');
				  </script>";
		}	
	}
}
if(isset($_GET['status']))
{
	$status = base64_decode($_GET['status']);
	$office_id = base64_decode($_GET['office']);
	$update_status = "update office_master set office_status='$status' where office_id='$office_id'";
	$update_status_rec = mysql_query($update_status);
	if($update_status_rec)
	{
			$update_floor_sql = "update floor_master set floor_status = '$status' where office_id='$office_id'";
			$update_floor_rec = mysql_query($update_floor_sql);
		if($update_floor_rec)
		{
			echo "<script>
						alert('Office Details Updated')
						location.replace('add_office.php?');
				  </script>	";
		}else{
			
				echo "<script>
						alert('Floor Details Does Not Updated')
						location.replace('add_office.php?');
				  </script>	";
		
		}
	}else{
			echo "<script>
						alert('Office Details Does Not Updated')
						location.replace('add_office.php?');
				  </script>	";
	}
}

if(isset($_GET['Delete']))
{
	$office_id = base64_decode($_GET['Delete']);
	$delete_sql = "delete from office_master where office_id='$office_id'";
	$delete_rec = mysql_query($delete_sql);
	if($delete_rec)
	{
		$delete_floor_sql = "delete from floor_master where office_id='$office_id'";
		$delete_floor_rec = mysql_query($delete_floor_sql);
		if($delete_floor_sql)
		{
			echo "<script>
						alert('Office Details Deleted')
						location.replace('add_office.php?');
				  </script>	";
		}else{
			echo "<script>
						alert('Floor Details Does Not Deleted')
						location.replace('add_office.php?');
				  </script>	";
		}
	}else{
	
		echo "<script>
					alert('Office Details Does Not Deleted Successfully')
					location.replace('add_office.php?');
			  </script>	";
	}
}

if(isset($_GET['Edit']))
{
	$office_id = base64_decode($_GET['Edit']);
	$floor_id = base64_decode($_GET['floor_id']);
	$office_add_sql = "select * from office_master where office_id='$office_id'";
	//echo $office_add_sql;
	$office_add_rec = mysql_query($office_add_sql);
	$office_add_res = mysql_fetch_assoc($office_add_rec);
	$floor_fetch_sql = "select * from floor_master where floor_id='$floor_id'";
	$floor_fetch_rec = mysql_query($floor_fetch_sql);
	$floor_fetch_res = mysql_fetch_assoc($floor_fetch_rec);
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
        <td align="center"><form id="form1" name="form1" method="post" action="" onsubmit="return office_location_chk()">
          <table width="35%" border="0" class="inner_tab_index">
            <tr>
              <td height="25" colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr align="left">
              <td width="8%" height="25" >&nbsp;</td>
              <td width="92%" >Office Location  </td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center"><input name="autocomplete" type="text" value="<?php echo @$office_add_res['office_location'];?>" class="inner_tab_index_txt_box" onfocus="geolocate()" id="autocomplete" size="50" /></td>
            </tr>




            <tr align="left">
              <td height="25">&nbsp;</td>
              <td height="25">Office Name </td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center"><input name="offname" type="text" class="inner_tab_index_txt_box" id="offname" size="50" placeholder="Enter The Name of The Ofiice" value="<?php echo @$office_add_res['office_name'];?>" /></td>
            </tr>
            <tr align="left">
              <td height="25">&nbsp;</td>
              <td height="25">Floor Number  </td>
            </tr>
            <tr align="left">
              <td height="25" colspan="2" align="center"><input name="offfloor" type="text" class="inner_tab_index_txt_box" id="offfloor" size="50" placeholder="Enter Number 0 For The Total office"value="<?php echo @$floor_fetch_res['floor_number'];?>" /></td>
            </tr>
            <tr>
              <td height="10" colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td height="10" colspan="2" align="center"><input name="Submit" type="submit" class="btn" id="Submit" value="<?php if(isset($_GET['Edit'])){echo "Edit";}else{echo "Enter";}?>"  /></td>
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
  	$office_add_sql = "select * from office_master";
	$office_add_rec = mysql_query($office_add_sql);
	$office_add_num_rows = mysql_num_rows($office_add_rec);
	if($office_add_num_rows > 0)
	{
  ?>
      <tr>
        <td height="30" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" align="center"><table width="80%" border="0">
            <tr>
              <td height="30" colspan="6" align="center" class="lsit_head">L I S T </td>
            </tr>
            <tr class="list_sec_row">
              <td width="9%" align="center">Sl . No . </td>
              <td width="27%" height="30">Office Location </td>
              <td width="12%">Office Name </td>
              <td width="14%" align="center">Floor Number </td>
              <td width="17%" align="center">Status</td>
              <td width="21%" align="center">Option</td>
            </tr>
     <?php
	  	$i = 1;
	  	while($office_add_res = mysql_fetch_assoc($office_add_rec))
		{
			$floor_sql = "select * from floor_master where office_id='$office_add_res[office_id]'";
			//echo $floor_sql;
			$floor_rec = mysql_query($floor_sql);
			if($i % 2 == 0)
			{
				$bg = "bgcolor=#E1E1E1";	
			}else{
				$bg = "bgcolor=#B9B9B9";
			}
			while($floor_res = mysql_fetch_assoc($floor_rec))
			{
	  ?>
            <tr class="list_dyn_row" <?php echo $bg;?>>
              <td height="30" align="center"><?php echo $i;?></td>
              <td height="30"><?php echo $office_add_res['office_location'];?></td>
              <td height="30"><?php echo $office_add_res['office_name'];?></td>
              <td height="30" align="center"><?php  if($floor_res['floor_number'] == 0){ echo "Full";}else{echo $floor_res['floor_number'];}?></td>
              <td align="center" style="cursor:pointer"><?php
			if($office_add_res['office_status'] == 1)
			{
		?>
                  <a href="add_office.php?status=<?php echo base64_encode(0);?>&amp;office=<?php echo base64_encode($office_add_res['office_id']);?>"><img src="images/green.gif" width="24" height="24" /></a>
                  <?php
			}else{
		?>
                  <a href="add_office.php?status=<?php echo base64_encode(1);?>&amp;office=<?php echo base64_encode($office_add_res['office_id']);?>"><img src="images/red.gif" width="24" height="24" /></a>
                  <?php
			}
		?>              </td>
              <td height="30" align="center"><table width="99%" border="0" style="cursor:pointer;">
                  <tr>
                    <td width="48%" align="center"><table width="99%" border="0" class="index_outer_tab">
                        <tr>
                          <td align="center"><a style="text-decoration:none; color:#000000;" href="add_office.php?Edit=<?php echo base64_encode($office_add_res['office_id']);?>&floor_id=<?php echo base64_encode($floor_res['floor_id']);?>">Edit</a></td>
                        </tr>
                    </table></td>
                    <td width="9%">&nbsp;</td>
                    <td width="43%" align="center" ><table width="99%" border="0" class="index_outer_tab">
                        <tr>
                          <td align="center" onclick="deleteFunc('add_office.php?Delete=<?php echo base64_encode($office_add_res['office_id']);?>');">Delete</td>
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
	    <td height="10" colspan="6" align="center">&nbsp;</td>
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
