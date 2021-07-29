<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>


<?echo("
	<link rel='stylesheet' href='style.css'/>
");?>

<center><h1>계정정보 찾기</h1><hr></center>
<center><h2>ID 찾기</h2></center>
<table align=center border=0 width=400>
<form method=post action=findid.php onsubmit="if(!this.uname.value ||   !this.email.value) return false;">
<tr><td align=right><font size=2>이름(실명)</td>
<td align=left><input type=text   size=20 name=uname></td></tr>
<tr><td align=right><font size=2>이메일주소</td>
<td align=left><input type=text   size=40 name=email></td></tr>
<tr height=10><td></td></tr>
<tr><td align=center colspan=2><input type=image src=https://www.flaticon.com/svg/static/icons/svg/709/709510.svg width=30 height=30 value=submit></td></tr>
<tr><td align=center colspan=2><font size=2>찾기</font></td></tr>
</form>
</table>
<br><br>
<center><h2>비밀번호 찾기</h2></center>
<table align=center border=0 width=400>
<form method=post action=findpw.php onsubmit="if(!this.uid.value ||   !this.uname.value || !this.email.value) return false;">
<tr><td align=right><font size=2>사용자ID</td>
<td align=left><input type=text size=20 name=uid></td></tr>
<tr><td align=right><font size=2>이름(실명)</td>
<td align=left><input type=text size=20 name=uname></td></tr>
<tr><td   align=right><font style='font-size:10pt; font-family:Tahoma;'>이메일주소</td>
<td align=left><input type=text size=40 name=email></td></tr>
<tr height=10><td></td></tr>
<tr><td align=center colspan=2><input type=image src=https://www.flaticon.com/svg/static/icons/svg/709/709510.svg width=30 height=30 value=submit></td></tr>
<tr><td align=center colspan=2><font size=2>찾기</font></td></tr>
</form>
</table>

</td></tr>
</table>
<? include ("bottom.html");   ?>
