<html>
<head>
<meta charset="UTF-8" >
</head>
<body>
<?php
@session_start();
	if(preg_match("/\.\.|sudo|system/i",$_POST['command'])){
		echo "NOP";
		exit(0);
	}
	else{
		$command=$_POST['command'];
	}
	

?>
<br>
<br>
<br>
<br>
<br>
<br>
<a href=<?php echo "../main/?user=".$_SESSION['ID'].""; ?>><button>Back</button></a>
</body>
</html>