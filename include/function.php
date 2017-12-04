<?php
	function update_status($emp_id){
		
		$up_status_sql = "update locker_master set status=1 where emp_id='$emp_id' and status = 0";
		$up_status_rec = mysql_query($up_status_sql);
	}
?>