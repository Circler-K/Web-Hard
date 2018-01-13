<?php
// set
if(!$_POST['path']){
	$uploads_dir = "../data/".$_POST['user']."/";
}
else{
	$uploads_dir = "../data/".$_POST['user']."".$_POST['path'];	
}
$allowed_ext = array('jpg','jpeg','png','gif');
$error = $_FILES['myfile']['error'];
 
// error check
if( $error != UPLOAD_ERR_OK ){
	switch( $error ){
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			echo "Too Big File. ($error)"; //파일의 크기가 너무 큽니다.
			break;
		case UPLOAD_ERR_NO_FILE:
			echo "Not Included. ($error)"; //파일이 첨부되지 않았습니다
			break;
		default:
			echo "Not exactly Uploaded. ($error)"; //파일이 제대로 업로드되지 않았습니다
	}
	exit;
}
 

 
// 파일 이동
move_uploaded_file( $_FILES['myfile']['tmp_name'], "$uploads_dir");

// 파일 정보 출력
echo "<h2>파일 정보</h2>
<ul>
	<li>파일명: {$_FILES['myfile']['name']}</li>
	<li>파일형식: {$_FILES['myfile']['type']}</li>
	<li>파일크기: {$_FILES['myfile']['size']} 바이트</li>
</ul>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<a href='../index.html' ><button>main</button></a>";