<?php
   include "connection/connection.php";
       if(isset($_POST['Submit']))
       {
           if($_POST['Submit'] == "submit")
           {
            $full_name = $_POST['fname'];
           $company_name = $_POST['cname'];
           $company_email = $_POST['cemail'];
           $password = md5($_POST['password']);
           $company_field = $_POST['cfield'];
           $location = $_POST['location'];

           list($email_first_part, $email_second_part) = explode("@",$company_email);

           $company_admin_fetch = "select * from  company_admin_master";
           //echo $company_admin_fetch;exit;
           $company_admin_rec = mysql_query($company_admin_fetch);
           $company_admin_num_rows = mysql_num_rows($company_admin_rec );
           $company_fetch = "select * from company_master";
           $company_fetch_rec = mysql_query($company_fetch);
           $company_fetch_row = mysql_num_rows($company_fetch_rec);
           if($company_admin_num_rows > 0 && $company_fetch_row > 0)
           {
               while($company_admin_res = mysql_fetch_assoc($company_admin_rec))
               {
                   $each_email_id = $company_admin_res['email_id'];
                   list($each_email_id_first, $each_email_id_last) = explode("@", $each_email_id);
                   if($email_second_part == $each_email_id_last)
                   {
                       echo "<script>
                               alert('Your Company Already Registered')
                               location.replace('index.php?');
                             </script>";
                   }else{

                       $insert_record = "insert into company_master(company_name, company_field, company_location) values('$company_name', '$company_field', '$location')";
                       $insert_record_query = mysql_query($insert_record);
                       if($insert_record_query)
                       {

                           $last_inserted_key = mysql_insert_id();
                           $company_adming_register = "insert into company_admin_master(company_id, admin_name, email_id, password) values('$last_inserted_key', '$full_name', '$company_email', '$password')";
                           $company_adming_register_query = mysql_query($company_adming_register);

                           if($company_adming_register_query)
                           {
                               echo "<script>
                                       alert('Thank You For Registering , Your Account will activate after verification ')
                                       location.replace('index.php?');
                                    </script>";
                           }else{

                               echo "<script>
                                       alert('Your Company Not Registered Properly')
                                       location.replace('index.php?');
                                     </script>";
                           }
                       }else{

                           echo "<script>
                                   alert('Your Company Not Registered Properly')
                                   location.replace('index.php?');
                               </script>";
                       }
                   }
               }
           }else{
               //echo "Inside Else";

                   $insert_record = "insert into company_master(company_name, company_field, company_location) values('$company_name', '$company_field', '$location')";
                       $insert_record_query = mysql_query($insert_record);
                       //echo "Company insert Id : ".$insert_record_query;exit;
                       if($insert_record_query)
                       {
                           //echo "Inside if";exit;
                           $last_inserted_key = mysql_insert_id();
                           $company_adming_register = "insert into company_admin_master(company_id, admin_name, email_id, password) values('$last_inserted_key', '$full_name', '$company_email', '$password')";
                           //echo $company_adming_register;exit;
                           $company_adming_register_query = mysql_query($company_adming_register);

                           if($company_adming_register_query)
                           {
                               echo "<script>
                                       alert('Thank You For Registering , Your Account will activate after verification ')
                                       location.replace('index.php?');
                                    </script>";
                           }else{

                               echo "<script>
                                       alert('Your Company's Admin Does Not Registered Properly')
                                       location.replace('index.php?');
                                     </script>";
                           }
                   }else{

                           echo "<script>
                                   alert('Your Company Not Registered Properly')
                                   location.replace('index.php?');
                               </script>";
                   }
           }


           }elseif($_POST['Submit'] == "login"){

                $email = $_POST['email'];
               /* echo "<script>
                        alert('Login');
                </script>";*/
                $passwd = md5($_POST['passwd']);
                $sql = "select * from company_admin_master where email_id = '$email' and status = 1";
               // echo $sql;exit;
                $rec = mysql_query($sql);
                //echo $rec;
                $row = mysql_num_rows($rec);
                //echo $row; exit;
                if($row > 0)
                {
                    $res = mysql_fetch_assoc($rec);
                    if($passwd == $res['password'])
                    {
                        session_start();
                        $_SESSION['email_id'] = $email;
                        $_SESSION['full_name'] = $res['admin_name'];
                        $_SESSION['user_id'] = $res['admin_id'];
                        $_SESSION['company_id'] = $res['company_id'];
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
      <link rel="stylesheet" type="text/css" href="css/styles.css">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
   <body style="background-color: #F0F0F0">
      <div class="container-fluid">
         <div>
            &nbsp;
         </div>
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <img src="images/office.jpg" class="indexImage">
               <section class="text">
                  Welcome To Locker Management System
               </section>
               <section>
                  <button type="button" class="btn btn-primary login" data-toggle="modal" data-target="#myModal">Login</button>
                  <!-- <input type="button" name="Login" class="btn btn-primary login" value="Login" data-toggle="modal" data-target="#loginModal"> -->
                  <!-- <input type="button" name="register" class="btn btn-danger signup" value=" Sign Up " > -->
                  <button type="button" class="btn btn-danger signup" data-toggle="modal" data-target="#signUpModal">Sign Up</button>
               </section>
            </div>
         </div>
         <div class="row featureAddOffice">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" align="left">
               <img src="images/office3.jpg" width="500em" height="200em" style="padding-right: 2em;">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="background-color: #900C3F; height: 14.3em;">
               <h2>Add Office</h2>
               <section style="padding-top: 3em">
                  A company can have multiple offices . Here you can add multiple offices for your company.
               </section>
            </div>
         </div>
         <div class="row featureAddOfficeAdmin">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
               <img src="images/admin.png" width="500em" height="200em" style="padding-right: 2em;">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="background-color: #900C3F; height: 14.3em">
               <h2>Office Admin</h2>
               <section style="padding-top: 3em">
                  An office can have multiple admins . Here you can add admins who also can be the receptionists who will maintain locker details of the office.
               </section>
            </div>
         </div>
         <div class="row featureTrackDetails">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >
               <img src="images/tracking.jpg" width="500em" height="200em" style="padding-right: 2em;">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="background-color: #900C3F; height: 14.3em">
               <h2>Track Details</h2>
               <section style="padding-top: 3em">
                  Here you can track the locker details of your company like who have the lockers and who all returned the keys.
               </section>
            </div>
         </div>
      </div>
      <!-- Modal Login -->
      <div class="modal fade" id="myModal" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header modalHeader">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Login</h4>
               </div>
               <div class="modal-body">
                  <form name="loginForm" action="" method="POST">
                     <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" id="email" name="email">
                     </div>
                     <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="pwd" name="passwd">
                     </div>
                     <button type="submit" class="btn btn-default btn-primary" name="Submit" value="login">Submit</button>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal Register -->
      <div class="modal fade" id="signUpModal" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header modalHeader">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Sign Up</h4>
               </div>
               <div class="modal-body">
                  <form name="formSignup" action="" method="POST">
                     <div class="form-group">
                        <label for="email">Full Name</label>
                        <input type="txt" class="form-control" id="fname" name="fname">
                     </div>
                     <div class="form-group">
                        <label for="pwd">Company Name</label>
                        <input type="txt" class="form-control" id="cname" name="cname">
                     </div>
                     <div class="form-group">
                        <label for="pwd">Company Email Id</label>
                        <input type="txt" class="form-control" id="cemail" name="cemail">
                     </div>
                     <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                     </div>
                     <div class="form-group">
                        <label for="pwd">Re-Type Password</label>
                        <input type="password" class="form-control" id="repassword" name="repassword">
                     </div>
                     <div class="form-group">
                        <label for="pwd">Company Field of Work</label>
                        <input type="txt" class="form-control" id="cfield" name="cfield">
                     </div>
                     <div class="form-group">
                        <label for="pwd">Location</label>
                        <input type="txt" class="form-control" id="location" name="location">
                     </div>
                     <button type="submit" class="btn btn-default btn-success" value="submit" name="Submit">Submit</button>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>