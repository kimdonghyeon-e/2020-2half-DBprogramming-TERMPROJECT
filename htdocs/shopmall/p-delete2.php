<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// ��ǰ �̹��� ������ photo ���� ������ ����
$tmp = mysql_query("select userfile from product where code='$code'", $con);
$fname = mysql_result($tmp, 0, "userfile");
$savedir = "./photo";
unlink("$savedir/$fname");
	
$result = mysql_query("delete from product where code='$code'", $con);

if (!$result) {
   echo("
      <script>
      window.alert('��ǰ ������ �����߽��ϴ�')
      history.go(-1)
      </script>
   ");
   exit;
} else {
   echo("
      <script>
      window.alert('��ǰ�� ���������� �����Ǿ����ϴ�')
      </script>
   ");
}

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=p-adminlist.php'>");

?>
