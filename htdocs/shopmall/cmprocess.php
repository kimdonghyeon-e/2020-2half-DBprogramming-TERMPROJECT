<?

if (!$name){
	echo("
		<script>
		window.alert('�̸��� �����ϴ�. �ٽ� �Է��ϼ���')
		history.go(-1)
		</script>
	");
	exit;
}

if (!$message){
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
$wdate =   date("Y-m-d H:i:s");

// ���� ������ ���̺� ������
mysql_query("update $comment set  name='$name', message='$message', passwd='$passwd', wdate='$wdate' where   num=$num", $con);

if ($pmode==1) {
	echo("<meta http-equiv='Refresh' content='0; url=p-show.php?code=$code'>");
}
else {
	echo("<meta http-equiv='Refresh' content='0; url=content.php?board=$board&id=$id'>");
}

mysql_close($con);

?>
