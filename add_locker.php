<?php
	session_start();
	include "connection/connection.php";
	include "include/function.php";
	if(isset($_POST['Submit']))
	{
		$employee_id = $_POST['eid'];
		$office_name = $_POST['office_name'];
		$employee_name = $_POST['ename'];
		$seat_num = $_POST['snum'];
		$date = mysql_real_escape_string($_POST['idate']);
		$issue_date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
		$key_num = $_POST['key_num'];
		if($_POST['Submit'] == "Submit")
		{

			$fetch_sql = "select * from locker_master where emp_id='$employee_id' and status=1";
			//echo $fetch_sql;exit;
			$fetch_rec = mysql_query($fetch_sql);
			$fetch_row = mysql_num_rows($fetch_rec);
			//echo $fetch_row;exit;
			if($fetch_row > 0)
			{
					$fetch_res = mysql_fetch_assoc($fetch_rec);
					echo "<script>
							alert('Locker Id : '+$fetch_res[key_number]+' is Assigned To The Employee');
							location.replace('dashboard.php?');
						  </script>";
			}else{
					$sql = "insert into locker_master(emp_id, office_id, emp_name, seat_number, key_number, issue_date, issued_by) values('$employee_id', '$office_name', '$employee_name', '$seat_num', '$key_num', '$issue_date', '$_SESSION[user_id]')";
					//echo $sql;exit;
					$rec = mysql_query($sql);
					if($rec)
					{
						echo "<script>
								alert('Locker Assigned To The Employee');
								location.replace('dashboard.php?');
							  </script>";
					}else{
						echo "<script>
								alert('Locker Does Not Assigned To The Employee');
								location.replace('dashboard.php?');
							  </script>";
					}
				}
			}elseif($_POST['Submit'] == "Edit")
			{
				$emp_id = base64_decode($_GET['emp']);
				$update_status_sql = "update locker_master set status=0 where emp_id='$emp_id' and status = 1";
				$update_status_rec = mysql_query($update_status_sql);
				if($update_status_rec)
				{
					$check_sql = "select * from locker_master where emp_id='$emp_id' and status =1";
					$check_rec = mysql_query($check_sql);	
					$check_num_row = mysql_num_rows($check_rec);
					if( $check_num_row > 0 )
					{
							echo "<script>
									alert('Employee Already Have a Locker');
									location.replace('dashboard.php?');		
								  </script>";
								  
							update_status($emp_id);
					}else{
					
						$check_seat_sql = "select * from locker_master where seat_number='$seat_num' and status = 1";
						$check_seat_rec = mysql_query($check_seat_sql);
						$check_seat_num = mysql_num_rows($check_seat_rec);
						if( $check_seat_num > 0 )
						{
							echo "<script>
									alert('This Sear Number : '+$seat_num+' Already Have A Locker');
									location.replace('dashboard.php?');		
								  </script>";
							update_status($emp_id);
						}else{
						
							$check_key_sql = "select * from locker_master where key_number='$key_num' and status = 1";
							$check_key_rec = mysql_query($check_key_sql);
							$check_key_num = mysql_num_rows($check_key_rec);
							if($check_key_num > 0)
							{
								echo "<script>
										alert('This Key : '+$key_num+' Is Already Assigned To Someone Else , Please Choose Another One');
										location.replace('dashboard.php?');			
								  </script>";
								update_status($emp_id);
							}else{
									
								$update_sql = "update locker_master set emp_id='$employee_id', emp_name='$employee_name', seat_number='$seat_num', key_number='$key_num', issue_date='$issue_date' where emp_id='$emp_id'";
								$update_rec = mysql_query($update_sql);
								if($update_rec)
								{
									echo "<script>
												alert('Locker Details Updated Successfully');
												location.replace('dashboard.php?');
										  </script>";
									update_status($emp_id);
								}else{
									echo "<script>
												alert('Locker Details Does Not Updated Successfully');
												location.replace('dashboard.php?');
										  </script>";
									update_status($emp_id);
								}
							}
														
						}
					}
				}
				
			}
	}
	
	if(isset($_GET['emp']))
	{
		$status = base64_decode($_GET['emp']);
		$stat_sql = "select * from locker_master where emp_id ='$status'";
		//echo $stat_sql;
		$stat_rec = mysql_query($stat_sql);
		$stat_res = mysql_fetch_assoc($stat_rec);
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Altimetrik | Locker Management</title>
<link rel="stylesheet" type="text/css"  href="css/all.css" />
<script type="text/javascript" language="javascript" src="js/all.js"></script></head>

<body>
<table width="100%" border="0">
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="39%"><table width="57%" border="0">
          <tr>
            <td><img src="images/download.png" width="237" height="79" /></td>
          </tr>
        </table></td>
        <td width="22%" align="center" class="session_name"><?php echo $_SESSION['full_name'];?></td>
        <td width="39%" align="right"><table width="100%" border="0">
          <tr>
            <td width="40%">&nbsp;</td>
            <td width="35%" align="center" valign="middle">&nbsp;</td>
            <td width="25%"><table width="99%" border="0" class="logout">
              <tr>
                <td align="center">Log Out </td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><form id="form1" name="form1" method="post" action="" onsubmit="return chk_null()">
      <table width="95%" border="0" class="index_outer_tab">
        <tr>
          <td height="30" align="right">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
        <tr>
          <td height="30" align="right">Office Name </td>
          <td align="center">:</td>
          <td align="left"><select name="office_name" id="office_name">
		  	<?php
				$office_sql = "select * from office_master where office_id=(select office_id from login_master where user_id='$_SESSION[user_id]')";
				$office_rec = mysql_query($office_sql);
				$office_res = mysql_fetch_assoc($office_rec);
				$location_sql = "select * from location_master where location_id='$office_res[location]'";
				echo $location_sql;
				$location_rec = mysql_query($location_sql);
				$location_res = mysql_fetch_assoc($location_rec);
			?>
			<option value="<?php echo $office_res['office_id'];?>"><?php echo $office_res['office_name']." ( ".$location_res['location_name']." ) ";?></option>
          </select>
          </td>
        </tr>
        <tr>
          <td width="47%" height="30" align="right">Employee Id </td>
          <td width="6%" align="center">:</td>
          <td width="47%" align="left"><input name="eid" type="text" id="eid" value="<?php echo @$stat_res['emp_id'];?>" /></td>
        </tr>
        <tr>
          <td height="30" align="right">Employee Name</td>
          <td align="center">:</td>
          <td align="left"><input name="ename" type="text" id="ename" value="<?php echo @$stat_res['emp_name'];?>" /></td>
        </tr>
        <tr>
          <td height="30" align="right">Seat Number</td>
          <td align="center">:</td>
          <td align="left"><input name="snum" type="text" id="snum" value="<?php echo @$stat_res['seat_number'];?>" /></td>
        </tr>
        <tr>
          <td height="30" align="right">Key Number </td>
          <td align="center">:</td>
          <td align="left"><input name="key_num" type="text" id="key_num" value="<?php echo @$stat_res['key_number'];?>" /></td>
        </tr>
		<?php
			if(!isset($_GET['emp']))
			{
		?>
		
        <tr>
          <td height="30" align="right">Issue Date </td>
          <td align="center">:</td>
          <td align="left"><input name="idate" type="text" id="idate" readonly value="<?php echo date('Y-m-d'); ?>" /></td>
        </tr>
		<?php
			}
		?>
        <tr>
          <td height="30" align="right">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="left"><input type="submit" name="Submit" value="<?php if(isset($_GET['emp'])){echo "Edit";}else{echo "Submit";}?>" class="btn" /></td>
        </tr>
        <tr>
          <td height="30" align="right">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
      </table>
        </form>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <?php
  		$locker_sql = "select * from locker_master where status=1 and issued_by=$_SESSION[user_id]";
		$locker_rec = mysql_query($locker_sql);
		$locaker_num_row = mysql_num_rows($locker_rec);
		if($locaker_num_row > 0)
		{
  ?>
  <tr>
    <td align="center" valign="middle"><table width="95%" border="0">
      <tr class="lsit_head">
        <td colspan="12" align="center" valign="middle">L i s t</td>
        </tr>
      <tr>
        <td width="5%" align="center" class="list_sec_row">Sl. No. </td>
        <td width="8%" align="center" class="list_sec_row">Emp Id </td>
        <td width="9%" class="list_sec_row">Emp Name </td>
        <td width="8%" class="list_sec_row">Office Name </td>
        <td width="9%" align="center" class="list_sec_row">Seat Number </td>
        <td width="10%" align="center" class="list_sec_row">Key Number </td>
        <td width="8%" class="list_sec_row">Issue Date </td>
        <td width="8%" class="list_sec_row">Issued By </td>
        <td width="8%" class="list_sec_row">Return Date </td>
        <td width="9%" class="list_sec_row">Received By </td>
        <td width="6%" align="center" class="list_sec_row">Status</td>
        <td width="12%" align="center" class="list_sec_row">Options</td>
        </tr>
	  <?php
		$row = 1;
		while($locker_res = mysql_fetch_assoc($locker_rec))
		{
			$issued_sql = "select * from login_master where user_id='$_SESSION[user_id]'";
			$issued_rec = mysql_query($issued_sql);
			$issued_res = mysql_fetch_assoc($issued_rec);
			$office_fetch_sql = "select * from office_master where office_id='$locker_res[office_id]'";
			$office_fetch_rec = mysql_query($office_fetch_sql);
			$office_fetch_res = mysql_fetch_assoc($office_fetch_rec);
			if($row%2==0)
			{
				$bg="bgcolor='#C4C4C4'";
			}else{
				$bg="bgcolor='#D4D4D4'";
			}
		?>
      <tr class="list_dyn_row" <?php echo $bg;?>>
        <td align="center"><?php echo $row;?></td>
        <td align="center"><?php echo $locker_res['emp_id'];?></td>
        <td><?php echo $locker_res['emp_name'];?></td>
        <td><?php echo $office_fetch_res['office_name'];?></td>
        <td align="center"><?php echo $locker_res['seat_number'];?></td>
        <td align="center"><?php echo $locker_res['key_number'];?></td>
        <td><?php echo $locker_res['issue_date'];?></td>
        <td><?php echo $issued_res['full_name'];?></td>
        <td><?php echo $locker_res['return_date'];?></td>
        <td><?php echo $locker_res['received_by'];?></td>
        <td align="center" title="Change The Statuse To Received"><?php if($locker_res['status'] == 1){?><a href="dashboard.php?status=<?php echo base64_encode($locker_res['id']);?>"><img src="images/green.gif" width="24" height="24" /></a><?php }?></td>
        <td align="center"><a href="<?php echo 'dashboard.php?emp='.base64_encode($locker_res['emp_id']);?>"><img src="images/edit.gif" width="25" height="25" /></a></td>
        </tr>
	  <?php
	  			$row++;
	  		}
	  ?>
    </table></td>
  </tr>
  <?php
  	}
  ?>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
