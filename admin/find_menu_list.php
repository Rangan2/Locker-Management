<?php
	include "../connection/connection.php";
	$menu_fetch_sql = "select * from site_admin_menu_master";
	$menu_fetch_rec = mysql_query($menu_fetch_sql);
?>
<table width="100%" border="0">
  <tr class="list_sec_row">
    <td width="9%" align="center">Sl . No . </td>
    <td width="18%" height="30" align="center">Menu Name </td>
    <td width="17%" align="center">Menu Parent </td>
    <td width="17%" align="center">Menu Link </td>
    <td width="18%" align="center">Status</td>
    <td width="17%" align="center">Options</td>
  </tr>
  <?php
	  	$i = 1;
	  	while($menu_fetch_res = mysql_fetch_assoc($menu_fetch_rec))
		{
			if($i % 2 == 0)
			{
				$bg = "bgcolor=#E1E1E1";	
			}else{
				$bg = "bgcolor=#B9B9B9";
			}
			$parent_menu_fetch_sql = "select * from site_admin_menu_master where menu_id = $menu_fetch_res[menu_parent]";
			//echo $parent_menu_fetch_sql;
			$parent_menu_fetch_rec = mysql_query($parent_menu_fetch_sql);
			$parent_menu_fetch_res = mysql_fetch_assoc($parent_menu_fetch_rec);
	  ?>
  <tr class="list_dyn_row" <?php echo $bg;?>>
    <td height="30" align="center"><?php echo $i;?></td>
    <td height="30" align="center"><?php echo $menu_fetch_res['menu_name'];?></td>
    <td align="center"><?php if($menu_fetch_res['menu_parent'] == 0){echo "Parent";}else{echo $parent_menu_fetch_res['menu_name'];}?></td>
    <td height="30" align="center"><?php echo $menu_fetch_res['menu_link'];?></td>
    <td height="30" align="center"><span style="cursor:pointer">
      <?php
			if($menu_fetch_res['menu_status'] == 1)
			{
		?>
      <a href="add_menu.php?status=<?php echo base64_encode(0);?>&amp;menu=<?php echo base64_encode($menu_fetch_res['menu_id']);?>"><img src="../images/green.gif" width="24" height="24" /></a>
      <?php
			}else{
		?>
      <a href="add_menu.php?status=<?php echo base64_encode(1);?>&amp;menu=<?php echo base64_encode($menu_fetch_res['menu_id']);?>"><img src="../images/red.gif" width="24" height="24" /></a>
      <?php
			}
		?>
    </span></td>
    <td align="center" style="cursor:pointer"><table width="100%" border="0">
      <tr>
        <td width="38%" height="30" align="right"><a href="<?php echo "add_menu.php?Emenu=".base64_encode($menu_fetch_res['menu_id']);?>"><img src="../images/edit.gif" width="25" height="25" /></a></td>
        <td width="26%">&nbsp;</td>
        <td width="36%" align="left" onClick="deleteFunc('<?php echo 'add_menu.php?delMenu='.base64_encode($menu_fetch_res['menu_id']);?>')"><img src="../images/del.gif" width="25" height="25" /></td>
      </tr>
    </table></td>
  </tr>
  <?php
				$i++;
	  	}
	  ?>
  <tr class="list_dyn_row">
    <td height="10" colspan="6" align="center">&nbsp;</td>
  </tr>
</table>
