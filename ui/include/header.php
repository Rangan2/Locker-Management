<?php
    $company_name_sql = "select * from company_master where company_id='$_SESSION[company_id]'";
    $company_name_rec = mysql_query($company_name_sql);
    $company_name_res = mysql_fetch_assoc($company_name_rec);
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
     <div class="row">
                        <div class="col-lg-6"><h2 style="color: #900C3F"><?php echo $company_name_res['company_name'];?></h2></div>
                        <div class="col-lg-6"> <?php include "include/sider.php"; ?> </div>
    </div>
</body>
</html>