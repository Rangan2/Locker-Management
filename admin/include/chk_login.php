<?php
if(@$_SESSION['user_id'] == "")
{
    echo "<script>
                alert('Please Log In First');
                location.replace('index.php');
          </script>";
}
?>