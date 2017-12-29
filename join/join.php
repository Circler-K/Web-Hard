<meta charset="utf-8" />
<?php
	//session setting
	@session_start(); // sometimes it throw error
	if($_SESSION){ // if logined
		echo "<script>";
		echo "alert('Already Login!!'); history.go(-1);"; // NO access for logined user
		echo "</script>";
	}
	
?>
<?php
	//주로 처음기준 *4
	$ID = $_POST['ID']; // 6~24
	$password = $_POST['password']; // 8자부터 32자까지 , 해싱하기 &Salting
	$username = $_POST['username']; // 4자부터 18자까지 (한글은 strlen하면 3이나와서,,,ㅠㅠ)
	$phone = $_POST['phone']; // 정규식으로 숫자가 아니면 거르기
	$age = $_POST['age'];
	$intro = $_POST['intro']; // 500자로 자르기
	
	$intro = substr($intro,0,500);
	$ID = addslashes($ID);
	$password = addslashes($password);
	$username = addslashes($username);
	$phone = addslashes($phone);
	$intro = addslashes($intro);
	//$MYSQLconnect=mysql_connect('localhost', 'root', 'apmsetup');
	//str_replace(chr(0), '', $input); 이런거 처럼 널바이트 체크해줘야할듯 str_replace 쓰지말고 preg_match로
	$check=0;
	if(strlen($ID)>=6 && strlen($ID)<=24){
		if(strlen($password)>=8 && strlen($password)<=32){
			if(strlen($username)<=18 && strlen($username)>=4){
				if(!preg_match('/[^0-9]/i', $phone)){
					if($age>0 && $age<150){
						$ID = base64_encode($ID);
						$temp_ID=base64_decode($ID);
						//$password=substr($password,"!@#$%"); // 특수문자 salting
						$password=$password." PLUS salting string"; //  일반 스트링 salting
						//password sha 로 감싸주기
						$password=hash('sha512',hash('sha256',$password));
						//echo $password."<br>";
						$check=1;
					}
				}
			}
		}
	}
	if($check){
		// db연결
		require_once("DB_connect_for_join.php");
		if($DB_connect){
			$DB_SQL_query="SELECT ID from member where ID='{$ID}' or username='{$username}'";
			$result = mysqli_query($DB_connect, $DB_SQL_query);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC); //
			if($row){
				echo "<script>alert('Already ID! || Already Nick'); history.go(-1);</script>";
			}
			else{
				$DB_SQL_query="INSERT INTO member (`ID`, `password`, `username`, `phone`, `age`,`intro`) VALUES ('{$ID}', '{$password}', '{$username}', {$phone},'{$age}', '{$intro}')";
				//echo $DB_SQL_query."<br>";
				mysqli_query($DB_connect,$DB_SQL_query) or die('query error');
				mkdir("../data/$temp_ID");
				echo "<script>alert('Welcome!');</script>";
				echo "<meta http-equiv='refresh' content='0;url=/FTP-Project'>";
			}
		}
		else{
			die("Connect Failed OTL");
		}
	}
	else{
		echo "<script>alert('Worng Data!'); history.go(-1);</script>";
	}
	/*
		mysqli_fetch_array는 select문을 이용했을 때 그 결과값을 파이썬의 딕셔너리형식으로 불러온다.
		mysqli_query 는 ,,,,
		mysqli_fetch_all
	*/
?>