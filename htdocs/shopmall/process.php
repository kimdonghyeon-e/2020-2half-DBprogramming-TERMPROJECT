<?

if (!$writer){
	echo("
		<script>
		window.alert('�̸��� �����ϴ�. �ٽ� �Է��ϼ���.')
		history.go(-1)
		</script>
	");
	exit;
}

if(!$topic){
	echo("
		<script>
		window.alert('������ �����ϴ�. �ٽ� �Է��ϼ���.')
		history.go(-1)
		</script>
	");
	exit;
}

if(!$content){
	echo("
		<script>
		window.alert('������ �����ϴ�. �ٽ� �Է��ϼ���.')
		history.go(-1)
		</script>
	");
	exit;
}

// �����ͺ��̽��� ����
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result=mysql_query("select id from $board",$con);
$total=mysql_num_rows($result);

// �ۿ� ���� id�ο�
if (!$total){
	$id = 1;
} else {
	$id = $total + 1;
}

//���� ó�� ��ƾ
if ($userfile) {
   $savedir = "./svfile";	//÷�� ������ ����� ����
   $temp = $userfile_name;
   copy($userfile, "$savedir/$temp");
   unlink($userfile);
}

$wdate = date("Y-m-d H:i:s");	//   �� �� ��¥ ����
$wrdate = date("YmdHis");
$na=$UserID.$wrdate;

mysql_query("create table $na(num int(5) auto_increment NOT NULL, name varchar(20), wdate varchar(20), message varchar(100), passwd varchar(20), primary key(num))");

// ���̺� �Է� �� ������ ����
mysql_query("insert into $board(id, writer, email, topic, content, hit, wdate, space, filename, filesize, comment) values($id, '$writer', '$email', '$topic', '$content', 0, '$wdate', 0, '$userfile_name', '$userfile_size', '$na')", $con);

mysql_close($con);	// �����ͺ��̽� ��������

//show.php ���α׷��� ȣ���ϸ鼭 ���̺� �̸��� ����
echo("<meta http-equiv='Refresh' content='0; url=show.php?board=$board'>");

?>
