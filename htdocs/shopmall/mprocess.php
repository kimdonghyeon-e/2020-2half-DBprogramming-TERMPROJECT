<?

if (!$writer){
	echo("
		<script>
		window.alert('�̸��� �����ϴ�. �ٽ� �Է��ϼ���')
		history.go(-1)
		</script>
	");
	exit;
}

if (!$topic){
	echo("
		<script>
		window.alert('������ �����ϴ�. �ٽ� �Է��ϼ���')
		history.go(-1)
		</script>
	");
	exit;
}

if (!$content){
	echo("
		<script>
		window.alert('������ �����ϴ�. �ٽ� �Է��ϼ���')
		history.go(-1)
		</script>
	");
	exit;
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from $board where id=$id", $con);


//���� ó�� ��ƾ
if ($userfile) {
   $savedir = "./svfile";	//÷�� ������ ����� ����
   $temp = $userfile_name;
   copy($userfile, "$savedir/$temp");
   unlink($userfile);
}


// ���� �ʵ尪�� ������ �׸��� ������
$space = mysql_result($result, 0, "space");
$hit = mysql_result($result, 0, "hit");

$wdate = date("Y-m-d H:i:s");	//�� ������ ��¥ ����

// ���� ������ ���̺� ������
mysql_query("update $board set  writer='$writer', email='$email', topic='$topic', content='$content', hit=$hit, wdate='$wdate', space=$space, filename='$userfile_name', filesize='$userfile_size' where   id=$id", $con);

echo("<meta http-equiv='Refresh' content='0; url=show.php?board=$board'>");

mysql_close($con);

?>
