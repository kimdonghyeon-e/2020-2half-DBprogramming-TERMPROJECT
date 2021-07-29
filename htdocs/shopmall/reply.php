<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>

<?

if (!$UserID){
	echo   ("<script>
		window.alert('로그인이 필요한 서비스입니다.');
		history.go(-1);
		</script>");
}
$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// 해당 게시물의 모든 내용을 읽어들임
$result=mysql_query("select * from $board where id=$id",$con);

$topic=mysql_result($result,0,"topic");
$content=mysql_result($result,0,"content");

$topic="re_" .  $topic;  // 원본 글 제목 앞에   "[Re]" 글자를 추가

// 원본 글 본문의 앞뒤에 구분자 표시
$pre_content=   "\n\n\n--------------< 원본글 >-------------\n" . $content . "\n";

$result=mysql_query("select * from member where uid='$UserID'", $con);
$uemail=mysql_result($result, 0, "email");

echo("
	<link rel='stylesheet' href='style.css'/>
");
echo("<script type='text/javascript' src=./ckeditor/ckeditor.js></script>");
// 답변 글 입력 폼
echo("
	<center><h1>답글쓰기</h1><hr></center>
	<form method=post   action=rprocess.php?board=$board&id=$id enctype='multipart/form-data'>
	<table width=700 border=0 align=center>
	<tr>
	<td width=100 align=right>이름 </td>
	<td width=600><input   type=text name=writer size=20 readonly=readonly value=$UserName></td>
	</tr>
	<tr>
	<td align=right>Email </td>
	<td><input type=text name=email size=40 readonly=readonly value=$uemail></td>
	</tr>
	<tr>
	<td align=right>제목 </td>
	<td><input type=text name=topic size=60 value='$topic'></td>
	</tr>
	<tr>
	<td align=right>내용 </td>
	<td><textarea name=content rows=12 cols=60>$pre_content</textarea><script type='text/javascript'>CKEDITOR.replace('content');</script> </td>
	</tr>
	<tr>
	<td align=right>첨부파일</font></td>
	<td><input type=file name='userfile' size=45 maxlength=80></td>
	</tr>
	<tr>
	<td align=center colspan=2>
	<input type=submit value=답변완료>
	<input type=reset value=지우기></td>
	</tr>
	</table>
	</form>
");

mysql_close($con);

?>

</td></tr>
</table>
<? include ("bottom.html");   ?>
