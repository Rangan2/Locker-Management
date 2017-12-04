<?php
if(@$_SESSION['email_id'] == "")
{
    echo "<script>
                alert('Please Log In First');
                location.replace('index.php');
          </script>";
}
?>