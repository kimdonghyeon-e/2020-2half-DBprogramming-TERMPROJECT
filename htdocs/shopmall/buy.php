<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>


<script language='Javascript'>
	function go_zip(){
		window.open('zipcode2.php', 'zipcode',   'width=470, height=180, scrollbars=yes');
	}
</script>



<table width=690 border=0>
<tr><td align=center><h1>��ǰ����</h1><hr></td></tr>
<tr><td align=center><h2>����Ȯ��</h2></td></tr>
<tr><td align=right><font size=2><b><? echo $UserName; ?></b>���� ���� ����   ǰ��</td>
</table>

<?

echo("
	<link rel='stylesheet' href='style.css'/>
");

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from member where uid='$UserID'", $con);
$total = mysql_num_rows($result);
$upoint=mysql_result($result, 0, "point");

if ($usepoint < 0) {
	echo("
		<script>
		window.alert('����Ʈ�� ���� ����� �Ұ����մϴ�.')
		history.go(-1)
		</script>
	");
}

if ($usepoint > $upoint){
	echo("
		<script>
		window.alert('���� ����Ʈ���� �ʰ� ����� �Ұ����մϴ�.')
		history.go(-1)
		</script>
	");
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// ��ü ���ι� ���̺��� Ư�� ������� ���� �������� �о��
$result = mysql_query("select * from shoppingbag where session='$Session'", $con);
$total = mysql_num_rows($result);

echo ("
	<table border=1 width=690 style='border:1px solid black; border-collapse:collapse;'>
    <tr><td width=100 align=center><font size=2>��ǰ����</td>
	<td width=300 align=center><font size=2>��ǰ�̸�</td>
	<td width=90 align=center><font size=2>����(�ܰ�)</td>
	<td width=50 align=center><font ssize=2>����</td>
	<td width=100 align=center><font size=2>ǰ���հ�</td>
	<td width=100 align=center><font size=2>��������Ʈ</td></tr>
	");

if (!$total) {
     echo("<tr><td colspan=5 align=center  style='border:1px solid black; border-collapse:collapse;'><font   size=2><b>���ι鿡 ��� ��ǰ��   �����ϴ�.</b>
        </font></td></tr></table>");
} else {

    $counter=0;
    $totalprice=0;    // �� ���� �ݾ�
		$totalpoint=0;

    while ($counter < $total) :
		$pcode = mysql_result($result, $counter, "pcode");
		$quantity = mysql_result($result, $counter, "quantity");

		$subresult = mysql_query("select * from product where code='$pcode'", $con);
		$userfile = mysql_result($subresult, 0, "userfile");
		$pname = mysql_result($subresult, 0, "name");
		$price = mysql_result($subresult, 0, "price2");
		$point=ceil($price/100);

		$subtotalprice = $quantity * $price;
		$totalprice = $totalprice + $subtotalprice;

		$subpoint = $quantity * $point;
		$totalpoint = $totalpoint + $subpoint;

		echo("<tr><td align=center style='border:1px solid black; border-collapse:collapse;'><a href=#   onclick=\"window.open('./photo/$userfile', '_new', 'width=450, height=450')\"><img src='./photo/$userfile' width=50 border=0></a></td>
			<td align=left style='border:1px solid black; border-collapse:collapse;'><font size=2><a href=p-show.php?code=$pcode>$pname</a></td>
			<td align=right style='border:1px solid black; border-collapse:collapse;'><font size=2>$price&nbsp;��</td>
			<td align=center style='border:1px solid black; border-collapse:collapse;'><font size=2>$quantity&nbsp;��</td>
			<td align=right style='border:1px solid black; border-collapse:collapse;'><font size=2>$subtotalprice&nbsp;��</td>
			<td align=right style='border:1px solid black; border-collapse:collapse;'><font size=2>$subpoint&nbsp;����Ʈ</td></tr>");

		$counter++;

    endwhile;

		$npoint=$upoint-$usepoint;
		$totalprice=$totalprice-$usepoint;
		$inputpoint=$npoint+$totalpoint;
     echo("<tr><td colspan=6 align=right><font size=2>�ܿ� ���� ����Ʈ: $npoint ����Ʈ &nbsp; / &nbsp; ��� ����Ʈ: <b>$usepoint</b> ����Ʈ &nbsp; / &nbsp; �� ���� ����Ʈ: $totalpoint ����Ʈ &nbsp; / &nbsp; �� ���� �ݾ�: <b>$totalprice</b> ��</td></tr></table>");
}



echo ("<br>
		<table border=0 width=690>
        <tr><td align=center><font size=2>�Ա� ����: <b>�������� 999999-99-999999 (������: �赿��)</b><br><br>
		* �����Ͻ� ��ǰ�� �Ա� Ȯ���� ��۵Ǹ�, �ֹ� ���� ��Ȳ�� My Page���� Ȯ���Ͻ� �� �ֽ��ϴ�.<br>
		* ��ǰ ��� ������ �ֹ� ��Ҹ� ���Ͻø� My Page���� ���� �ֹ� ��� ��û�� �Ͻø� �˴ϴ�.<br>
		* ��ǰ�� ��� ������ �Ŀ� ���� ��Ҹ� ���Ͻø� ������(��ȭ:070-1234-1234)�� �����ּ���.
       </td></tr>
       </table>");

$result = mysql_query("select * from member where uid='$UserID'", $con);

$uname = mysql_result($result, 0, "uname");
$mphone = mysql_result($result, 0, "mphone");
$zipcode = mysql_result($result, 0, "zipcode");
$address1 = mysql_result($result, 0, "addr1");
$address2 = mysql_result($result, 0, "addr2");

mysql_close($con);	//�����ͺ��̽� ��������

echo("
    <br><br>
	<table width=690 border=0>
	<tr><td align=center><h2>�������<h2></td></tr>
	</table>

	<table width=690 border=0>
	<form method=post action=endshopping.php?totalpoint=$inputpoint&totalmount=$totalprice name=buy>
	<tr><td align=right width=80><font size=2>�޴���</td>
	<td><input type=text name=receiver size=10 value=$uname></td>
	</tr>
	<tr>
	<td align=right><font size=2>��ȭ��ȣ</td>
	<td><input type=text name=phone   size=20 value=$mphone></td>
	</tr>
	<tr><td height=30 align=right><font size=2>����ּ�</td>
	<td align=left><input type=text size=6 name=zip readonly=readonly value=$zipcode>
	<font size=2><a href='javascript:go_zip()' class='mbx'>�����ȣ�˻�</a><br>
	<input type=text size=55 name=addr1 readonly=readonly style='font-size:10pt; font-family:Tahoma;' value='$address1'>
	<input type=text size=30 name=addr2   style='font-size:10pt; font-family:Tahoma;' value='$address2'></td>
	<tr><td align=right><font size=2>�ֹ��䱸����</td>
	<td><textarea name=message rows=3 cols=65></textarea></td></tr>
	<tr height=10></tr>
	<tr><td align=center colspan=2>
	<input type=image src=https://www.flaticon.com/svg/static/icons/svg/3604/3604093.svg width=40 height=40 value=submit align=center valign=center></td></tr>
	<tr><td align=center colspan=2><font size=2>���ſϷ�&nbsp;&nbsp;</font></td></tr>
	<tr height=10></tr>
	</table>
	</form>
	</center>
");

?>


</td></tr>
</table>
<? include ("bottom.html");   ?>
