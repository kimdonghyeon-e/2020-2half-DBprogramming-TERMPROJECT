<?

if (!$writer){
	echo("
		<script>
		window.alert('이름이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

if(!$topic){
	echo("
		<script>
		window.alert('제목이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

if(!$content){
	echo("
		<script>
		window.alert('내용이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

// 데이터베이스에 연결
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result=mysql_query("select id from $board",$con);
$total=mysql_num_rows($result);

// 글에 대한 id부여
if (!$total){
	$id = 1;
} else {
	$id = $total + 1;
}

//파일 처리 루틴
if ($userfile) {
   $savedir = "./svfile";	//첨부 파일이 저장될 폴더
   $temp = $userfile_name;
   copy($userfile, "$savedir/$temp");
   unlink($userfile);
}

$wdate = date("Y-m-d H:i:s");	//   글 쓴 날짜 저장
$wrdate = date("YmdHis");
$na=$UserID.$wrdate;

mysql_query("create table $na(num int(5) auto_increment NOT NULL, name varchar(20), wdate varchar(20), message varchar(100), passwd varchar(20), primary key(num))");

// 테이블에 입력 글 내용을 저장
mysql_query("insert into $board(id, writer, email, topic, content, hit, wdate, space, filename, filesize, comment) values($id, '$writer', '$email', '$topic', '$content', 0, '$wdate', 0, '$userfile_name', '$userfile_size', '$na')", $con);

mysql_close($con);	// 데이터베이스 연결해제

//show.php 프로그램을 호출하면서 테이블 이름을 전달
echo("<meta http-equiv='Refresh' content='0; url=show.php?board=$board'>");

?>
