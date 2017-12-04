<?php
include "../connection/connection.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table width="80%" border="0" cellpadding="0" cellspacing="0" class="dashboard_inner_tab">
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <?php
		  	if(isset($_GET['companyName']))
			{
				
				$companyName = $_GET['companyName'];
				$company_sql = "select * from company_master where company_name like '$companyName%'";
			}else{
				
		  		$company_sql = "select * from company_master";
			}
			//echo $company_sql;exit;
		//	echo $company_sql;
			$company_rec = mysql_query($company_sql);
			$i = 1;
			while($company_res = mysql_fetch_assoc($company_rec))
			{
				$company_admin_sql = "select * from company_admin_master where company_id = $company_res[company_id]";
				$company_admin_rec = mysql_query($company_admin_sql);
				$company_admin_res = mysql_fetch_assoc($company_admin_rec);
		  ?>
    <td align="center"><table width="60%" border="0">
      <tr>
        <td align="center"><table width="300" border="0" cellpadding="0" cellspacing="0" class="dashboard_all_menu">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="center"><?php echo $company_res['company_name'];?></td>
          </tr>
          <tr>
            <td height="25" align="center"><?php echo $company_admin_res['admin_name'];?></td>
          </tr>
          <tr>
            <td height="25" align="center"><?php echo $company_admin_res['email_id'];?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <?php
				
				if($i % 2 == 0)
				{
					echo "</tr><td height='20'>&nbsp;</td><tr>";
				}
				$i++;
			}
			?>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
</table>
</body>
</html>
