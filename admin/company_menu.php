<?php
session_start();
	include "../connection/connection.php";
	if(isset($_POST['Submit']))
	{
		$menu_parent = $_POST['menu_parent'];
		$menu_name = $_POST['menu_name'];
		$menu_link = $_POST['menu_link'];
		if($_POST['Submit'] == "Enter")
		{
			$menu_insert_sql = "insert into menu_master(menu_name, menu_link, menu_parent) values('$menu_name', '$menu_link', '$menu_parent')";
			$menu_insert_rec = mysql_query($menu_insert_sql);
			if($menu_insert_rec)
			{
				echo "<script>
						alert('Menu Details Added')
						location.replace('company_menu.php?');
				  	  </script>";
				
			}else{
			
			}
							
		}elseif($_POST['Submit'] == "Edit"){
			$menu_id = base64_decode($_GET['Emenu']);
			$update_menu_sql = "update menu_master set menu_name = '$menu_name', menu_link = '$menu_link', menu_parent = '$menu_parent' where menu_id = '$menu_id'";	
		//	echo $update_menu_sql;exit;
			$update_menu_rec = mysql_query($update_menu_sql);
			if($update_menu_rec)
			{
				echo "<script>
						alert('Menu Details Updated Successfully')
						location.replace('company_menu.php?');
					  </script>";
			}else{
			
				echo "<script>
						alert('Menu Details Does Not Updated Successfully')
						location.replace('company_menu.php?');
					  </script>";
		    }
	}
}
if(isset($_GET['menu']))
{
	$menu_id = base64_decode($_GET['menu']);
	$status = base64_decode($_GET['status']);
	$menu_status_update_sql = "update menu_master set menu_status = '$status' where menu_id = '$menu_id'";
	//echo $menu_status_update_sql;exit;
	$menu_status_update_rec = mysql_query($menu_status_update_sql);
	if($menu_status_update_rec)
	{
		
		echo "<script>
				alert('Menu Status Updated Successfully')
				location.replace('company_menu.php?');
			  </script>";
	}else{
		
		echo "<script>
			   alert('Menu Status Does Not Updated Successfully')
			   location.replace('company_menu.php?');
			  </script>";
	}
}
if(isset($_GET['delMenu']))
{
	$menu_id = base64_decode($_GET['delMenu']);
	$del_menu_sql = "delete from menu_master where menu_id = '$menu_id'";
	$del_menu_rec = mysql_query($del_menu_sql);
	if($del_menu_rec)
	{
		echo "<script>
				alert('Menu Details Deleted')
				location.replace('company_menu.php?');
			 </script>";
	}else{
		
		echo "<script>
				alert('Menu Details Not Deleted')
				location.replace('company_menu.php?');
			 </script>";
	}
}

if(isset($_GET['Emenu']))
{
	$menu_id = base64_decode($_GET['Emenu']);
	$menu_update_fetch_sql = "select * from menu_master where menu_id = '$menu_id'";
	$menu_update_fetch_rec = mysql_query($menu_update_fetch_sql);
	$menu_update_fetch_res = mysql_fetch_assoc($menu_update_fetch_rec);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Locker Details | Add Company Menu</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/all.css" />
<script src="../js/all.js" language="javascript" type="text/javascript"></script>
<body>
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
        <td align="center"><form id="form1" name="form1" method="post" action="" onsubmit="return admin_add_menu_chk_null()">
          <table width="35%" border="0" class="inner_tab_index">
            <tr>
              <td height="25" colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr align="left">
              <td width="8%" height="25" >&nbsp;</td>
              <td width="92%" >Menu Parent  </td>
            </tr>
			<?php
				//echo $_SESSION['office_id'];
				$menu_fetch_sql = "select * from menu_master where menu_status = 1";
				//echo $office_sql;
				$menu_fetch_rec = mysql_query($menu_fetch_sql);
			?>
            <tr>
              <td height="25" colspan="2" align="center"><select name="menu_parent" class="inner_tab_index_txt_box" id="menu_parent" style=" width:380px" >
                <option value="0" selected="selected">... Parent ...</option>
				<?php
					while($menu_fetch_res = mysql_fetch_assoc($menu_fetch_rec))
					{
				?>
                <option value="<?php echo $menu_fetch_res['menu_id'];?>" <?php if( @$menu_fetch_res['menu_id'] == @$menu_update_fetch_res['menu_id']){echo "selected";}?>><?php echo $menu_fetch_res['menu_name'];?></option>
				<?php
					}
				?>
              </select></td>
            </tr>
            <tr align="left">
              <td height="25">&nbsp;</td>
              <td height="25">Menu Name </td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center"><input name="menu_name" type="text" class="inner_tab_index_txt_box" id="menu_name" size="50" value="<?php echo @$menu_update_fetch_res['menu_name'];?>" /></td>
            </tr>
            <tr align="left">
              <td height="25">&nbsp;</td>
              <td height="25">Menu Link </td>
            </tr>
            <tr align="left">
              <td height="25" colspan="2" align="center"><input name="menu_link" type="text" class="inner_tab_index_txt_box" id="menu_link" size="50" placeholder="Write # If you have any sub menu inside it" value="<?php echo @$menu_update_fetch_res['menu_link'];?>"/></td>
            </tr>
            <tr>
              <td height="10" colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td height="10" colspan="2" align="center"><input name="Submit" type="submit" class="btn" id="Submit" value="<?php if(isset($_GET['Emenu'])){echo "Edit";}else{echo "Enter";}?>" /></td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td height="25" colspan="2" align="center">&nbsp;</td>
            </tr>
          </table>
        </form></td>
      </tr>
      <?php
  	$locker_fetch_sql = "select * from locker_master where added_by='$_SESSION[admin_id]'";
	$locker_fetch_rec = mysql_query($locker_fetch_sql);
	$locker_fetch_num_rows = mysql_num_rows($locker_fetch_rec);
	if($locker_fetch_num_rows > 0)
	{
  ?>
      <tr>
        <td height="30" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" align="center"><table width="80%" border="0">
          <tr>
            <td width="79%" height="30" align="center" class="lsit_head"><table width="100%" border="0">
              <tr>
                <td width="32%" align="center">L I S T </td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="30" align="center"><div id="showList"><?php include "find_company_menu_list.php";?></div></td>
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
