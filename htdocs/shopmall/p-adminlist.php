<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>

<?
echo("
	<link rel='stylesheet' href='style.css'/>
");

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("select * from product order by name", $con);

$total = mysql_num_rows($result);

echo("
<center><h1>�����޴�</h1><hr></center>
<center><h2>�ǸŻ�ǰ ����</h2></center>
");

echo ("<table border=0 width=690 style='border:1px solid black; border-collapse:collapse;'>
	<tr><td align=center><font size=2>��ǰ�ڵ�</td>
	<td colspan=2 align=center><font size=2>��ǰ��</td>
	<td align=center><font size=2>���尡��</td>
	<td align=center><font size=2>�ǸŰ���</td>
	<td align=center width=100><font size=2>����/����</td></tr>");

if (!$total) {

  echo("<tr><td colspan=6 align=center>���� ��ϵ� ��ǰ�� �����ϴ�</td></tr>");

} else {

	$counter = 0;

	while ($counter < $total) :

		$code=mysql_result($result,$counter,"code");
		$name=mysql_result($result,$counter,"name");
		$userfile=mysql_result($result,$counter,"userfile");
		$price1=mysql_result($result,$counter,"price1");
		$price2=mysql_result($result,$counter,"price2");

		echo ("
		   <tr><td width=100 align=center style='border:1px solid black; border-collapse:collapse;'><font size=2>$code</td>
			 <td align=center width=30 style='border:1px solid black; border-collapse:collapse;'><img src='./photo/$userfile' width=40 height=40 border=0></td>
			   <td width=350 align=left style='border:1px solid black; border-collapse:collapse;'><a href=p-show.php?code=$code><font size=2>$name</a></td>
			   <td align=right width=70 style='border:1px solid black; border-collapse:collapse;'><font size=2><strike>$price1&nbsp;��</strike></td>
			   <td align=right width=70 style='border:1px solid black; border-collapse:collapse;'><font size=2>$price2&nbsp;��</td>
			   <td width=70 align=center style='border:1px solid black; border-collapse:collapse;'><font size=2><a href=p-modify.php?code=$code class=mbx>����</a> <a href=p-delete.php?code=$code class=mbx>����</a></td></tr>");

		$counter++;
	endwhile;
}

echo ("</table>");

mysql_close($con);

?>


</td></tr>
</table>
<? include ("bottom.html");   ?>
