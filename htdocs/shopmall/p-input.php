<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>

<?echo("
	<link rel='stylesheet' href='style.css'/>
");?>

<script type='text/javascript' src=./ckeditor/ckeditor.js></script>

<center><h1>�����޴�</h1><hr></center>
<center><h2>�űԻ�ǰ ���</h2></center>
<table border=0 width=650>
<form method=post action=p-process.php enctype='multipart/form-data'>
<tr>
<td width=100 align=right>��ǰ�з�</td>
<td width=550>
	<select name=class>
	<option value=1>Apple</option>
	<option value=2>SAMSUNG</option>
	<option value=3>LG</option>
	</select>
</td>
</tr>
<tr>
<td align=right>��ǰ�ڵ�</td>
<td><input type=text name=code size=20></td>
</tr>
<tr>
<td align=right>��ǰ�̸�</td>
<td><input type=text name=name size=70></td>
</tr>
<tr>
<td align=right>��ǰ����</td>
<td><textarea name=content rows=15 cols=75></textarea><script type='text/javascript'>CKEDITOR.replace('content');</script></td>
</tr>
<tr>
<td align=right>���󰡰�</td>
<td><input type=text name=price1 size=15>��</td>
</tr>
<tr>
<td align=right>���ΰ���</td>
<td><input type=text name=price2 size=15>��</td>
</tr>
<tr>
<td align=right>��ǰ����</td>
<td><input type=file size=30 name=userfile></td>
</tr>
<tr>
<td align=center colspan=5>
<input type=submit value=����ϱ�></td>
</tr>
</form>
</table>


</td></tr>
</table>
<? include ("bottom.html");   ?>
