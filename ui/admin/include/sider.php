 <div style="padding-bottom: 2em; padding-top: 0.5em; cursor: pointer;"><a class="anchor" href="dashboard.php">DASHBOARD</a></div>
                     <?php
                        $menu_master_sql = "select * from site_admin_menu_master where menu_status = 1 and menu_parent = 0";
                        $menu_master_rec = mysql_query($menu_master_sql);
                        while ($menu_master_res = mysql_fetch_assoc($menu_master_rec))
                        {
                        ?>
                     <div style=" padding-bottom: 2em;"><a class="anchor" href="<?php echo $menu_master_res['menu_link'];?>"> <?php echo strtoupper($menu_master_res['menu_name']);?> </a></div>
                     <?php
                        }
                        ?>
                     <div>
                        MESSAGES
                     </div>
                     <div>
                        &nbsp;
                     </div>