<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>

<?
echo("
	<link rel='stylesheet' href='style.css'/>
");

echo("
<center><h1>�����޴�</h1><hr></center>
<center><h2>�������� ���</h2></center>
");



echo("
<table border=0 width=500>
<tr><td align=center><font size=2>��� ������ �������� ���� �۹�ȣ�� �Է��ϼ���.</font></td></tr>
<tr><td align=center><font size=2>0�� �Է��ϰ� ��������ϸ� ��ʰ� �����˴ϴ�.</font></td></tr>
<tr><td align=center><form method=post action=bannprocess.php><input type=text name=id size=3><input type=submit value=�������></form></td></tr>
</table>
");


?>

</td></tr>
</table>
<? include ("bottom.html");   ?>
