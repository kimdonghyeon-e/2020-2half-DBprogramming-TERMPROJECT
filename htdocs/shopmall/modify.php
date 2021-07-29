<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>

<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result=mysql_query("select *   from $board where id=$id",$con);

// 수정하고자 하는 원본 게시물에서 수정 가능한 항목을 추출함
$writer=mysql_result($result,0,"writer");
$topic=mysql_result($result,0,"topic");
$content=mysql_result($result,0,"content");
$email=mysql_result($result,0,"email");
$filename=mysql_result($result,0,"filename");
echo("
	<link rel='stylesheet' href='style.css'/>
");
echo("<script type='text/javascript' src=./ckeditor/ckeditor.js></script>");

echo("<center><h1>글수정</h1><hr></center>
	<form method=post action=mprocess.php?board=$board&id=$id enctype='multipart/form-data'>
	<table width=700 border=0 align=center>
	<tr>
	<td width=100 align=right>이름 </td>
	<td width=600><input type=text name=writer size=20 value='$writer' readonly=readonly></td>
	</tr>
	<tr>
	<td align=right>Email </td>
	<td><input type=text name=email size=40 value='$email' readonly=readonly></td>
	</tr>
	<tr>
	<td align=right>제목 </td>
	<td><input type=text name=topic size=60 value='$topic'></td>
	</tr>
	<tr>
	<td align=right>내용 </td>
	<td><textarea name=content rows=12 cols=60>$content</textarea><script type='text/javascript'>CKEDITOR.replace('content');</script></td>
	</tr>
	<tr>
  <td align=right>첨부파일</font></td>
  <td><input type=file name='userfile' size=45 maxlength=80></td>
  </tr>
	<tr>
	<td align=center colspan=2>
	<input type=submit value=수정완료>
	<input type=reset value=지우기></td>
	</tr>
	</table>
	</form>");

mysql_close($con);

?>

</td></tr>
</table>
<? include ("bottom.html");   ?>
