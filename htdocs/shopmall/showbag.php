<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>

<?
echo("
	<link rel='stylesheet' href='style.css'/>
");

if (!isset($UserID)) {
	echo ("<script>
		window.alert('�α��� ����ڸ� �̿��Ͻ� �� �־��')
		history.go(-1)
		</script>");
	exit;
}
?>

<table width=690 border=0>
	<tr><td align=center><h1>���ΰ���</h1><hr></td></tr>
<tr><td align=center><h2>����īƮ</h2></td></tr>
<tr><td align=right><font size=2><b><? echo $UserName; ?></b>���� ���� ���� īƮ ����</td>
</table>

<?
$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// ��ü ���ι� ���̺��� Ư�� ������� ���� �������� �о��
$result = mysql_query("select * from shoppingbag where session='$Session'", $con);
$total = mysql_num_rows($result);

echo ("
	<table border=0 width=690 style='border:1px solid black; border-collapse:collapse;'>
    <tr><td width=100 align=center><font size=2>��ǰ����</td>
	<td width=300 align=center><font size=2>��ǰ�̸�</td>
	<td width=90 align=center><font size=2>����(�ܰ�)</td>
	<td width=50 align=center><font size=2>����</td>
	<td width=100 align=center><font size=2>ǰ���հ�</td>
	<td width=100 align=center><font size=2>��������Ʈ</td>
	<td width=50 align=center><font size=2>����</td></tr>
");

if (!$total) {
     echo("<tr><td colspan=7 align=center style='border:1px solid black;'><font size=2>���ι鿡 ��� ��ǰ�� �����ϴ�.</td></tr></table>");
} else {

    $counter=0;
    $totalprice=0;
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

		echo ("<tr><td align=center  style='border:1px solid black; border-collapse:collapse;'>
			<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=450,   height=450')\"><img src='./photo/$userfile' width=50   border=0></a></td>
			<td align=left  style='border:1px solid black; border-collapse:collapse;'><font size=2><a   href=p-show.php?code=$pcode>$pname </a></td>
			<td align=right  style='border:1px solid black; border-collapse:collapse;'><font size=2>$price&nbsp;��</td>
			<td align=center  style='border:1px solid black; border-collapse:collapse;'>
			<form method=post action=qmodify.php?pcode=$pcode><input type=text name=newnum size=3 value=$quantity>&nbsp;<input type=image src=https://www.flaticon.com/svg/static/icons/svg/339/339853.svg width=20 height=20 value=submit align=center valign=center>
			</td></form>
			<td align=right  style='border:1px solid black; border-collapse:collapse;'><font size=2>$subtotalprice&nbsp;��</td>
			<td align=right  style='border:1px solid black; border-collapse:collapse;'><font size=2>$subpoint&nbsp;����Ʈ</td>
			<td align=center  style='border:1px solid black; border-collapse:collapse;'>
			<form method=post action=itemdelete.php?pcode=$pcode><input type=image src=https://www.flaticon.com/svg/static/icons/svg/812/812853.svg width=20 height=20 value=submit align=center valign=center></td></form>
			</tr>");

		$counter++;
    endwhile;

		$result = mysql_query("select * from member where uid='$UserID'", $con);
		$total = mysql_num_rows($result);

		$upoint=mysql_result($result, 0, "point");
		echo("<form method=post action=buy.php>");
    echo("<tr><td colspan=7 align=right><font size=2>���� ����Ʈ: $upoint ����Ʈ &nbsp; / &nbsp; ����� ����Ʈ: <input type=text name=usepoint size=5 value=0> &nbsp; / &nbsp;
				�� ���� ����Ʈ: $totalpoint ����Ʈ &nbsp; / &nbsp; �� ���� �ݾ�: <b>$totalprice</b> ��</td></tr></table>");

}



echo ("<table width=690 border=0>
	<tr><td align=center><input type=image src=https://www.flaticon.com/svg/static/icons/svg/1077/1077970.svg width=35 height=35 value=submit align=center valign=center></form></td> &nbsp; <td align=center valign=center><form method=post action=p-list.php margin=0 style='margin-bottom:0px;'><input type=image src=https://www.flaticon.com/svg/static/icons/svg/709/709606.svg width=30 height=30 value=submit align=center valign=center></form></td></tr>
		<tr><td align=center><font size=2>�����ϱ�</font></td><td align=center><font size=2>���ΰ��</font></td></tr>
		</table>");

echo("
	<br>
	<table width=690 border=0>
	<tr><td align=center><h2>���ϱ�</h2></td></tr>
	<tr><td align=right><font size=2><b>$UserName</b>���� ���� ���ϱ� ����</td>
	</table>
");
	$result = mysql_query("select * from likebag where id='$UserID'", $con);
	$total = mysql_num_rows($result);

	echo ("
		<table border=0 width=690 style='border:1px solid black; border-collapse:collapse;'>
	    <tr><td width=100 align=center><font size=2>��ǰ����</td>
		<td width=300 align=center><font size=2>��ǰ�̸�</td>
		<td width=90 align=center><font size=2>����(�ܰ�)</td>
		<td width=50 align=center><font size=2>����</td>
		<td width=100 align=center><font size=2>ǰ���հ�</td>
		<td width=100 align=center><font size=2>��������Ʈ</td>
		<td width=50 align=center><font size=2>����</td></tr>
	");

	if (!$total) {
	     echo("<tr><td colspan=7 align=center  style='border:1px solid black; border-collapse:collapse;'><font size=2>���� ��ǰ�� �����ϴ�.</td></tr></table>");
	} else {

	    $counter=0;
	    $totalprice=0;
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

			echo ("<tr><td align=center  style='border:1px solid black; border-collapse:collapse;'>
				<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=450,   height=450')\"><img src='./photo/$userfile' width=50   border=0></a></td>
				<td align=left style='border:1px solid black; border-collapse:collapse;'><font size=2><a   href=p-show.php?code=$pcode>$pname </a></td>
				<td align=right style='border:1px solid black; border-collapse:collapse;'><font size=2>$price&nbsp;��</td>
				<td align=center style='border:1px solid black; border-collapse:collapse;'>
				<form method=post action=likeqmodify.php?pcode=$pcode><input type=text name=newnum size=3 value=$quantity>&nbsp;<input type=image src=https://www.flaticon.com/svg/static/icons/svg/339/339853.svg width=20 height=20 value=submit align=center valign=center>
				</td></form>
				<td align=right style='border:1px solid black; border-collapse:collapse;'><font size=2>$subtotalprice&nbsp;��</td>
				<td align=right style='border:1px solid black; border-collapse:collapse;'><font size=2>$subpoint&nbsp;����Ʈ</td>
				<td align=center style='border:1px solid black; border-collapse:collapse;'>
				<form method=post action=likeitemdelete.php?pcode=$pcode><input type=image src=https://www.flaticon.com/svg/static/icons/svg/812/812853.svg width=20 height=20 value=submit align=center valign=center></td></form>
				</tr>");

			$counter++;
	    endwhile;


	    echo("<tr><td colspan=7 align=right><font size=2>�� ���� ����Ʈ: $totalpoint ����Ʈ &nbsp; / &nbsp; �� ���� �ݾ�: <b>$totalprice</b> ��</td></tr></table>");

	}


	echo("<form method=post action=toshoppingbag.php>");
	echo("<br>");
	echo ("<table width=690 border=0>
		<tr><td align=center><input type=image src=https://www.flaticon.com/svg/static/icons/svg/3126/3126526.svg width=30 height=30 value=submit align=center valign=center></form></td></tr>
		<tr><td align=center><font size=2>��ٱ��Ϸ�</font></td></tr>
		</table>");



mysql_close($con);	//�����ͺ��̽� ��������
?>


</td></tr>
</table>
<? include ("bottom.html");   ?>
