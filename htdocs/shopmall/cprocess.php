<?

function check($message) {
	echo ("
		<script>
		window.alert(\"$message\");
		history.go(-1);
		</script>
	");
	exit;
}

if (!$wname) check("�α����� �ʿ��� �����Դϴ�.");
if (!$wmemo) check("������ �Է��ϼ���");

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall", $con);

$wdate =   date("Y-m-d H:i:s");

mysql_query("insert into $comment(name, wdate, message, passwd) values ('$wname', '$wdate',   '$wmemo', '$wpasswd')", $con);

mysql_close($con);

if ($pmode==1){
	echo("<meta http-equiv='Refresh' content='0; url=p-show.php?code=$code'>");
}
else {
	echo("<meta http-equiv='Refresh' content='0; url=content.php?board=$board&id=$id'>");
}
?>
