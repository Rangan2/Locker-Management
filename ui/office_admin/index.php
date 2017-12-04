<?php
include "../connection/connection.php";
if(isset($_POST['Submit']))
  {
    $email = $_POST['email'];
    $passwd = md5($_POST['passwd']);
    $sql = "select * from office_admin_credentials_master where email_id = '$email' and admin_status = 1";
    //echo $sql;exit;
    $rec = mysql_query($sql);
    //echo $rec;
    $row = mysql_num_rows($rec);
    //echo $row; exit;
    if($row > 0)
    {
      $res = mysql_fetch_assoc($rec);
      if($passwd == $res['password'])
      {
        $floor_id = "";
        $office_fetch_sql = "select * from office_master where office_id='$res[office_id]'";
        $office_fetch_rec = mysql_query($office_fetch_sql);
        $office_fetch_res = mysql_fetch_assoc($office_fetch_rec);
        $assign_floor_fetch_sql = "select * from office_admin_assigned_floor_number where credential_id = '$res[credential_id]' and assign_floor_status = '1'";
      //  echo $assign_floor_fetch_sql;
        $assign_floor_fetch_rec = mysql_query($assign_floor_fetch_sql);
        while($assign_floor_fetch_res = mysql_fetch_assoc($assign_floor_fetch_rec))
        {
          if($floor_id == "")
          {
            $floor_id = $assign_floor_fetch_res['floor_id'];
          }else{
            $floor_id = $floor_id.",".$assign_floor_fetch_res['floor_id'];
          }
        }
        //echo $floor_id;exit;
        session_start();
        $_SESSION['email_id'] = $email;
        $_SESSION['full_name'] = $res['admin_name'];
        $_SESSION['admin_id'] = $res['credential_id'];
        $_SESSION['floor_id'] = $floor_id;
        $_SESSION['company_id'] = $office_fetch_res['company_id'];
        $_SESSION['office_id'] = $res['office_id'];
        echo "<script>
            alert(' Admin Panle Welcomes You ');
            location.replace('dashboard.php');
              </script>";
      }else{

        echo "<script>
            alert('Password Does Not Matched');
            location.replace('index.php?');
              </script>";
      }

    }else{
      echo "<script>
          alert('Email Id Does Not Exist');
          location.replace('index.php?');
          </script>";
    }
  }

?>
<!DOCTYPE html>
<html>
   <head>
      <title>Locker Management</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="../css/styles.css">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
   <body style="background-color: #F0F0F0">
      <div class="container-fluid">
         <div>
            &nbsp;
         </div>
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <img src="../images/office.jpg" class="indexImage">
               <section class="text">
                  Welcome To Office Admin Console
               </section>
            </div>
         </div>
         <div class="row featureAddOffice">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" align="left">
               <img src="../images/login.jpg" width="500em" height="280em" style="padding-right: 2em">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="background-color: #900C3F; height: 20.3em;">
               <h2>Log In</h2>
               <section style="padding-top: 1em">
                  <form name="loginForm" action="" method="POST">
                     <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                     </div>
                     <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="pwd" name="passwd" required>
                     </div>
                     <button type="submit" class="btn btn-default btn-primary" name="Submit" value="login"  style="width: 40%"  >Log In</button>

                  </form>
               </section>
            </div>
         </div>
      </div>
   </body>
</html>