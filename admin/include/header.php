<table width="100%" border="0">
  <tr>
    <td align="right"><table width="100%" border="0" align="center">
      <tr>
        <td width="41%" align="center" class="dashboard_header_coompany_name">Locker Management System</td>
        <td width="39%">&nbsp;</td>
        <td width="20%" class="dashboard_sider"><?php include "include/sider.php"?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="session_name"><?php echo $_SESSION['full_name'];?></td>
  </tr>
  <tr>
    <td align="right"><table width="50%" border="0">
      <tr>
        <td width="34%">&nbsp;</td>
        <td width="50%" align="center" ><div id="clock"></div></td>
        <td width="16%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="95%" border="0" cellpadding="0" cellspacing="0">
      <tr class="dashboard_header_menu_bacground dashboard_header">
        <td height="20" align="center" valign="middle"><table width="80%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="22%" align="right" valign="bottom" onclick="location.replace('dashboard.php')">Home </td>
            <td width="59%" align="center"><table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <?php
						$sql = "select * from site_admin_menu_master where menu_status=1";
						$rec = mysql_query($sql);
						while($res = mysql_fetch_assoc($rec))
						{
				?>
                  <td width="14%" align="center" valign="bottom" onclick="location.replace('<?php echo $res['menu_link'];?>')">| <?php echo $res['menu_name'];?></td>
                  <?php
						}
					?>
                </tr>
            </table></td>
            <td width="19%" valign="bottom">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr style="background-color:#FF9122">
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
