<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>

<?
echo("
	<link rel='stylesheet' href='style.css'/>
");

$con=mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall", $con);

$result = mysql_query("select * from product where code='$code'", $con);

$name=mysql_result($result,0,"name");

echo ("
    <table border=0 width=650 align=center>
	<tr><td width=100 align=center>��ǰ�ڵ�</td>
     <td width=550><b>$code</b></td></tr>
	<tr><td align=center>��ǰ�̸�</td><td><b>$name</b></td></tr>
	<tr><td colspan=2 height=50 align=center valign=center>�� ��ǰ�� �����Ͻðڽ��ϱ�?</td></tr>
	<tr><td colspan=2 align=center><form method=post action=p-delete2.php?code=$code><input type=submit value='���� Ȯ��'></form></td></tr>
	<tr><td colspan=2 align=center>[<a href=p-adminlist.php>���ư���</a>]</td></tr>
	</table>");

mysql_close($con);

?>


</td></tr>
</table>
<? include ("bottom.html");   ?>
