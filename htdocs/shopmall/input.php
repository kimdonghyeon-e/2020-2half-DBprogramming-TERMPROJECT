<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>


<?
if (!$UserID){
	echo   ("<script>
		window.alert('�α����� �ʿ��� �����Դϴ�.');
		history.go(-1);
		</script>");
}

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall", $con);
$result=mysql_query("select * from member where uid='$UserID'", $con);
$uemail=mysql_result($result, 0, "email");

echo("<script type='text/javascript' src=./ckeditor/ckeditor.js></script>");
echo("
	<link rel='stylesheet' href='style.css'/>
");
echo("
	<center><h1>���Խ��� �۾���</h1><hr></center>
	<form method=post action=process.php?board=$board enctype='multipart/form-data'>
	<table width=700 border=0 align=center>
	<tr>
	<td width=100 align=right>�̸� </td>
	<td width=600><input type=text name=writer size=20 readonly=readonly value=$UserName></td>
	</tr>
	<tr>
	<td align=right>Email </td>
	<td><input type=text name=email size=40 readonly=readonly value=$uemail></td>
	</tr>
	<tr>
	<td align=right>���� </td>
	<td><input type=text name=topic size=60></td>
	</tr>
	<tr>
	<td align=right>���� </td>
	<td><textarea name=content rows=12 cols=60></textarea><script type='text/javascript'>CKEDITOR.replace('content');</script></td>
	</tr>
	<tr>
  <td align=right>÷������</font></td>
  <td><input type=file name='userfile' size=45 maxlength=80></td>
  </tr>
	<tr>
	<td align=center colspan=2>
	<input type=submit value=����ϱ�>
	<input type=reset value=�����></td>
	</tr>
	</table>
	</form>
");

?>

</td></tr>
</table>
<? include ("bottom.html");   ?>
