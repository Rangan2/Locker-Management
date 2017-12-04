<?php
session_start();
//echo "Email : ".$_SESSION['email_id'].", Full Name : ".$_SESSION['full_name'].", Admin Id : ".$_SESSION['admin_id'].", Company Id : ".$_SESSION['company_id'].", Office Id : ".$_SESSION['office_id'].", Floor Id : ".$_SESSION['floor_id']; 
include "../connection/connection.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Locker Management | Dashboard</title>
<link rel="stylesheet" type="text/css" href="../css/all.css" />
<script src="../js/all.js" language="javascript" type="text/javascript"></script>

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
        <td align="center"><table width="80%" border="0" class="lsit_head">
          <tr>
            <td width="81%" align="right">Search By Company Name  </td>
            <td width="3%" align="center">:</td>
            <td width="16%"><input name="company_name" type="text" class="inner_tab_index_txt_box" id="company_name" size="20" onkeyup="findCompany()" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center"><table width="80%" border="0" cellpadding="0" cellspacing="0" class="dashboard_inner_tab">
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><div id="company"><?php include "find_company.php";?></div></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
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
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
</table>
</body>
</html>
