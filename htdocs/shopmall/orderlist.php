<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>

<?
echo("
	<link rel='stylesheet' href='style.css'/>
");

if ($UserID != 'admin') {
	echo ("<script>
		window.alert('�����ڸ� ���� ������ ����Դϴ�')
		history.go(-1)
		</script>");
    exit;
}
echo("
<center><h1>�����޴�</h1><hr></center>
<center><h2>�ֹ����� ��ȸ</h2></center>
");

echo ("<table border=0 width=690>
<tr><td align=right><a href=admin.php><img src=https://www.flaticon.com/svg/static/icons/svg/2223/2223615.svg width=30 height=30></a></td>
<tr><td align=right><font size=2>����</font></td>
	</tr></table>");

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall",   $con);

$result = mysql_query("select * from receivers order by buydate desc", $con);
$total = mysql_num_rows($result);

echo (" <table border=0 width=690 style='border:1px solid black; border-collapse:collapse;'>
	<tr height=25 valign=center>
	<td align=center width=90><font size=2><b>�ֹ���ȣ</b></td>
	<td width=140 align=center><font size=2><b>�ֹ�����</b></td>
	<td width=300 align=center><font size=2><b>�ֹ�����</b></td>
	<td width=70 align=center><font size=2><b>�ֹ��Ѿ�</b></td>
	<td width=90 align=center><font size=2><b>���º���</b></td></tr>");

if ($total > 0) {

	$counter = 0;

	while($counter < $total) :

		$session =  mysql_result($result, $counter, "session");
		$buydate = mysql_result($result, $counter, "buydate");
		$ordernum = mysql_result($result, $counter, "ordernum");
		$status = mysql_result($result, $counter, "status");
		$totalmount = mysql_result($result, $counter, "totalmount");

		switch ($status) {
			case 1:
				$tstatus = "�ֹ���û";
				break;
			case 2:
				$tstatus = "�ֹ�����";
				break;
			case 3:
				$tstatus = "����غ���";
				break;
			case 4:
				$tstatus = "�����";
				break;
			case 5:
				$tstatus = "��ۿϷ�";
				break;
			case 6:
				$tstatus = "���ſϷ�";
				break;
		}

		$subresult = mysql_query("select * from orderlist where session='$session'",   $con);
		$subtotal = mysql_num_rows($subresult);

		$subcounter=0;
		$totalprice=0;

		while ($subcounter < $subtotal) :
			$pcode = mysql_result($subresult, $subcounter, "pcode");
			$quantity = mysql_result($subresult, $subcounter, "quantity");
			$tmpresult = mysql_query("select * from product where code='$pcode'", $con);
			$pname = mysql_result($tmpresult, 0, "name");
			$price = mysql_result($tmpresult, 0, "price2");

			$subtotalprice = $quantity * $price;
			$totalprice = $totalprice + $subtotalprice;
			$subcounter++;
		endwhile;

		$items = $subtotal - 1;

		echo ("<tr><td align=center style='border:1px solid black; border-collapse:collapse;'><a href=#   onclick=\"window.open('detailview.php?ordernum=$ordernum', '_new', 'width=940, height=250, scrollbars=yes');\"><font size=2>$ordernum</a></td>
			<td align=center style='border:1px solid black; border-collapse:collapse;'><font size=2>$buydate</td>
			<td style='border:1px solid black; border-collapse:collapse;'><font size=2>$pname �� $items ��</td>
			<td align=right style='border:1px solid black; border-collapse:collapse;'><font size=2>$totalmount ��</td>
			<td align=center style='border:1px solid black; border-collapse:collapse;'><font size=2>");
		if ($status < 6) {
			echo ("<a href=changestatus.php?ordernum=$ordernum class=mbx> <b>$tstatus</b></a></td></tr>");
		} else {
		  echo ("<b>$tstatus</b></td></tr>");
		}

		$counter++;

	endwhile;

} else {
       echo ("<tr><td align=center colspan=5><font size=2 style='border:1px solid black; border-collapse:collapse;'><b>�ֹ� ������ �������� �ʽ��ϴ�</b></td></tr>");
}

echo ("</table>");

mysql_close($con);

?>

</td></tr>
</table>
<? include ("bottom.html");   ?>
