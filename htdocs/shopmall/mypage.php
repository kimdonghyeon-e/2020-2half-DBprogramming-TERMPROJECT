<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>

<?
echo("
	<link rel='stylesheet' href='style.css'/>
");

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall",   $con);
$result = mysql_query("select * from member where uid='$UserID'", $con);

$uid = mysql_result($result, 0,   "UID");
$uname = mysql_result($result, 0,   "UNAME");
$email = mysql_result($result, 0,   "EMAIL");
$zip = mysql_result($result, 0,   "ZIPCODE");
$addr1 = mysql_result($result, 0,   "ADDR1");
$addr2 = mysql_result($result, 0,   "ADDR2");
$mphone = mysql_result($result, 0,   "MPHONE");
$point = mysql_result($result, 0, "point");

?>
<table width=690 border=0>
<tr><td align=center><h1>����������<h1><hr></td></tr>
<tr><td align=center><h2>ȸ������<h2></td></tr>
<tr><td align=right><a href=umodify.php><img src=https://www.flaticon.com/svg/static/icons/svg/650/650725.svg width=35 height=35 align=center valign=center></a></td></tr>
<tr><td align=right><font size=2>����&nbsp;</font></td></tr>
</table>

<table border=1 width=690 style='border:1px solid black; border-collapse:collapse;'>
<tr><td width=100 style='border:1px solid black; border-collapse:collapse;'><font size=2>�̸�</td>
<td width=120 style='border:1px solid black; border-collapse:collapse;'><font size=2><? echo $uname; ?></td>
<td width=80 style='border:1px solid black; border-collapse:collapse;'><font size=2>�޴���ȭ</td>
<td width=140 style='border:1px solid black; border-collapse:collapse;'><font size=2><? echo $mphone; ?></td>
<td width=80 style='border:1px solid black; border-collapse:collapse;'><font size=2>�̸���</td>
<td width=170 style='border:1px solid black; border-collapse:collapse;'><font size=2><? echo $email; ?></td></tr>
<tr><td style='border:1px solid black; border-collapse:collapse;'><font size=2>�ּ�</td>
<td colspan=5 style='border:1px solid black; border-collapse:collapse;'><font   size=2><? echo $zip . " " . $addr1 . " " . $addr2;   ?></td></tr>
<tr><td style='border:1px solid black; border-collapse:collapse;'><font size=2>�ܿ� ����Ʈ</td>
<td colspan=5 style='border:1px solid black; border-collapse:collapse;'><font   size=2><? echo ("<b>$point</b> ����Ʈ");   ?></td></tr>
</table>
<br><br>

<?
$result = mysql_query("select * from receivers where id='$UserID' order by buydate desc", $con);
$total = mysql_num_rows($result);

echo ("
	<table width=690 border=0>
	<tr><td align=center><h2>���ų���<h2></td></tr>
	<tr><td>* <font color=red   size=2>�ֹ� ��ǰ�� ��� ���� �ܰ��̸� �¶������� �ֹ�   ��Ұ� �����մϴ�.</td></tr>
	<tr><td>* <font size=2>������̰ų� ���� �Ϸ�� ��ǰ�� ���� ��ǰ �� ȯ�� ��û��     ��� ������(��ȭ: 070-1234-1234)�� ���ǹٶ��ϴ�.</td></tr>
	</table>

	<table border=1 width=690 style='border:1px solid black; border-collapse:collapse;'>
	<tr><td align=center style='border:1px solid black; border-collapse:collapse;'><font size=2>���Ź�ȣ</td>
	<td align=center style='border:1px solid black; border-collapse:collapse;'><font size=2>��������</td>
	<td align=center style='border:1px solid black; border-collapse:collapse;'><font size=2>�ֹ�����</td>
	<td align=center style='border:1px solid black; border-collapse:collapse;'><font size=2>�ݾ�</td>
	<td align=center style='border:1px solid black; border-collapse:collapse;'><font size=2>�ֹ�����</td></tr>");

if ($total > 0) {
	$counter = 0;
	while($counter < $total) :
		$session = mysql_result($result, $counter, "session");
		$buydate = mysql_result($result, $counter, "buydate");
		$ordernum = mysql_result($result, $counter, "ordernum");
		$status = mysql_result($result, $counter, "status");
		$totalmount = mysql_result($result, $counter, "totalmount");
		$oldstatus = $status;

		switch ($status) {
		  case 1:
				$status = "�ֹ���û";
				break;
		  case 2:
				$status = "�ֹ�����";
				break;
		  case 3:
				$status = "����غ���";
				break;
		  case 4:
				$status = "�����";
				break;
		  case 5:
				$status = "��ۿϷ�";
				break;
		  case 6:
				$status = "���ſϷ�";
				break;
		}

		$subresult = mysql_query("select * from orderlist where session='$session'",   $con);
        $subtotal =  mysql_num_rows($subresult);

        $subcounter=0;
        $totalprice=0;

        while ($subcounter <   $subtotal) :
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

        echo ("<tr height=45><td align=center><font size=2>
			<a href=# onclick=\"window.open('detailview.php?ordernum=$ordernum', '_new',   'width=940, height=250, scrollbars=yes');\">$ordernum</a></td><td   align=center><font size=2>$buydate</td>
			<td><font size=2>$pname �� $items ��</td><td align=right><font   size=2><b>$totalmount</b> ��</td>
			<td align=center><font size=2 height=30>$status");

		if ($oldstatus < 4) echo ("<br><a href=ordercancel.php?ordernum=$ordernum class='mbx' style='
    padding-top: 1px;
    padding-left: 1px;
    padding-bottom: 1px;
    padding-right: 1px;
    margin-top: 8px;
    margin-left: 2px;
    margin-bottom: 2px;
    margin-right: 2px;
    border-top-width: 2px;
'>�ֹ����</a>");

		echo ("</td></tr>");

		$counter++;
	endwhile;

} else {

	echo ("<tr><td align=center colspan=5><font size=2><b>�ֹ� ������ �������� �ʽ��ϴ�</b></td></tr>");

}

echo ("</table>");

mysql_close($con);

?>


</td></tr>
</table>
<? include ("bottom.html");   ?>
