<?php
    session_start();
    include "connection/connection.php";
    $company_name_sql = "select * from company_master where company_id='$_SESSION[company_id]'";
    $company_name_rec = mysql_query($company_name_sql);
    $company_name_res = mysql_fetch_assoc($company_name_rec);
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <script type="text/javascript" src="js/all.js"></script>
     <link rel="stylesheet" type="text/css" href="css/styles.css">
     <link href="https://fonts.googleapis.com/css?family=Roboto | Orbitron | Audiowide" rel="stylesheet">
</head>
<body style="background-color: #303030">
        <div class="container-fluid">
            <div class="dashboardOuterDiv">
                 <div class="dashboardInnerDiv">
                     <div>
                         &nbsp;
                     </div>
                        <div class="col-lg-3 dashboardSider">
                                <h5> <?php echo $_SESSION['full_name'];?></h5>
                                <?php echo $company_name_res['company_name'];?>
                        </div>
                        <div class="col-lg-9 dashboardHead">
                               <h4> Admin Console </h4>
                               <div class="dropdown">
                                 <img src="images/options.png" width="40" height="40" class="optionsImage dropdown-toggle" data-toggle="dropdown">
                                 <ul class="dropdown-menu optionsImage">
                                  <li><a href="#">Change Password</a></li>
                                  <li style="padding-left: 1.5em" onclick="redirect('logout.php')">Logout</li>
                                </ul>
                                </div>
                        </div>

                            <div class="col-lg-3">

                            </div>
                            <div class="col-lg-9 col-md-12">
                                    <div class="col-lg-3 lockerAssigned">
                                            Hello
                                    </div>
                                    <div class="col-lg-6 featuresDiv">
                                        <h6 class="featureHeader">Project Features</h6>
                                        <table class="table table-hover" width="100%">
                                    <?php
                                        $menu_master_sql = "select * from menu_master where menu_status = 1";
                                        $menu_master_rec = mysql_query($menu_master_sql);
                                    ?>
                                        <tbody>
                                        <?php
                                            $i = 1;
                                            while ($menu_master_res = mysql_fetch_assoc($menu_master_rec))
                                             {

                                                   if($i % 2 == 0)
                                                    {
                                                        $bg = "bgcolor=#88B0DC";
                                                    }else{
                                                        $bg = "bgcolor=#FC4778";
                                                    }
                                         ?>
                                            <tr>
                                                    <td class="features"><?php echo $menu_master_res['menu_name'];?></td>
                                                    <td style="padding-left: 25em; cursor: pointer; color: #fff">
                                                    <table width="120%" border="0" style="border:1px solid #ccc; background-color: #88B0DC  ">
                                                      <tr <?php echo $bg;?>>
                                                        <td align="center">view</td>
                                                      </tr>
                                                    </table>
                                                    </td>
                                            </tr>
                                        <?php
                                                $i++;
                                             }
                                        ?>
                                        </tbody>
                                        </table>
                                    </div>
                            </div>

                </div>

            </div>
        </div>
</body>
</html>