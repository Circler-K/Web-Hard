<?php
	if(preg_match("/\.\.|sudo|system/i",$_POST['command'])){
		echo "NOP";
		exit(0);
	}
	else{
		echo $_POST['command'];
		//system($_POST['command']);
	}
	
?>