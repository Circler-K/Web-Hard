<?php
	@session_start();
	session_destroy();
	echo "<script>alert('L0G0UT!@#$');</script>";
	echo "<meta http-equiv='refresh' content='0;url=/FTP-Project'>";
?>