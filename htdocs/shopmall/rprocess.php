<?

if(!$writer){
	echo("
		<script>
		window.alert('�̸��� �����ϴ�. �ٽ� �Է��ϼ���.')
		history.go(-1)
		</script>
	");
	exit;
}

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// �亯 ���� ���� �ۺ��� ���̰� 1 ������
$result=mysql_query("select space from $board where id=$id", $con);
$space=mysql_result($result, 0, "space");
$space=$space+1;

$wdate=date("Y-m-d H:i:s"); // �ܺ� ���� �� ��¥ ����

// �亯���� �߰��Ǹ� ���� ������ �ϳ� �����ϹǷ� �� ��ȣ�� ����
$tmp = mysql_query("select id from $board", $con);
$total = mysql_num_rows($tmp);

//���� ó�� ��ƾ
if ($userfile) {
   $savedir = "./svfile";	//÷�� ������ ����� ����
   $temp = $userfile_name;
   copy($userfile, "$savedir/$temp");
   unlink($userfile);
}

while($total >= $id):
	mysql_query("update $board set id=id+1 where id=$total", $con);
	$total--;
endwhile;

mysql_query("create table $topic(num int(5) auto_increment NOT NULL, name varchar(20), wdate varchar(20), message varchar(100), passwd varchar(20), primary key(num))");

// ���� �� ��ȣ ��ġ�� �亯 ���� ������
mysql_query("insert into   $board(id, writer, email, topic, content, hit, wdate, space, filename, filesize, comment) values ($id, '$writer', '$email', '$topic','$content', 0, '$wdate',   $space, '$userfile_name', '$userfile_size', '$topic')", $con);

mysql_close($con);

echo("<meta http-equiv='Refresh' content='0; url=show.php?board=$board'>");

?>
