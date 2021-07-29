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
<center><h1>관리메뉴</h1><hr></center>
<center><h2>공지사항 배너</h2></center>
");



echo("
<table border=0 width=500>
<tr><td align=center><font size=2>배너 설정할 공지사항 글의 글번호를 입력하세요.</font></td></tr>
<tr><td align=center><font size=2>0을 입력하고 배너지정하면 배너가 해제됩니다.</font></td></tr>
<tr><td align=center><form method=post action=bannprocess.php><input type=text name=id size=3><input type=submit value=배너지정></form></td></tr>
</table>
");


?>

</td></tr>
</table>
<? include ("bottom.html");   ?>
