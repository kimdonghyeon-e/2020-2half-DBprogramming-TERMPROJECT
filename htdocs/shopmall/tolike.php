<?

if (!$UserID) {
	echo ("<script>
		window.alert('�α��� ����ڸ� ���� �����մϴ�')
		history.go(-1)
		</script>");
      exit;
}
if ($quantity < 1 || $quantity > 100) {
	echo ("<script>
		window.alert('�����ϰ��� �ϴ� ������ ������ �ʰ��մϴ�')
		history.go(-1)
		</script>");
      exit;
}

if (!isset($quantity)) $quantity = 1;

$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// �̹� ���ι鿡 ���� �����̸� ������ ����
$result = mysql_query("select * from likebag where id='$UserID' and pcode='$code'", $con);
$total = mysql_num_rows($result);

if ($total) $oldnum = mysql_result($result, 0, "quantity");

if ($oldnum) {
     $quantity = $oldnum + $quantity;
     mysql_query("update likebag set quantity=$quantity where   id='$UserID' and pcode='$code'", $con);
} else {
     mysql_query("insert into likebag(id, pcode, quantity) values ('$UserID', '$code', $quantity)", $con);
}

mysql_close($con);	//�����ͺ��̽� ��������

echo ("<script>history.go(-1)</script>");

?>
