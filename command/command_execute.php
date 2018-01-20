<html>
<head>
<meta charset="UTF-8" >
</head>
<body>
<?php
@session_start();
function rmdirAll($dir) {
   $dirs = dir($dir);
   while(false !== ($entry = $dirs->read())) {
      if(($entry != '.') && ($entry != '..')) {
         if(is_dir($dir.'/'.$entry)) {
            rmdirAll($dir.'/'.$entry);
         } else {
            @unlink($dir.'/'.$entry);
         }
       }
    }
    $dirs->close();
    @rmdir($dir);
}
	if(preg_match("/\.\.|sudo|system/i",$_POST['command'])){
		echo "NOP";
		exit(0);
	}
	if($_POST['command']===""){
		echo "No Command";
		exit(0);
	}
	
	else{
		$command=$_POST['command'];
		switch($_POST['chk_info']){
			case "mkdir":
				echo "mkdir : ".$command;
				mkdir("../data/$_SESSION['ID']/$_GET['path']/$_POST['command']");
				break;
			case "del":
				echo "del : ".$command;
				unlink("../data/$_SESSION['ID']/$_GET['path']/$_POST['command']");
				break;
			case "rmdir":
				echo "rmdir : ".$command;
				rmdirAll("../data/$_SESSION['ID']/$_GET['path']/$_SESSION['command']");
				break;
		}
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