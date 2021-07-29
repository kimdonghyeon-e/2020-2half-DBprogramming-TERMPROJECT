<? include ("top.html"); ?>

<table border=1 width=900 align=center>
<tr height=600>
<td width=180 valign=top><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>


<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result=mysql_query("select *   from $comment where num=$num",$con);

// 수정하고자 하는 원본 게시물에서 수정 가능한 항목을 추출함
$name=mysql_result($result,0,"name");
$message=mysql_result($result,0,"message");
$passwd=mysql_result($result,0,"passwd");
echo("
	<link rel='stylesheet' href='style.css'/>
");
echo("
<table   border=0 width=700 align=center>
<tr><td align=center colspan=4><h1>댓글수정</h1><hr></td></tr>
<tr><td><form method=post action=cmprocess.php?comment=$comment&board=$board&id=$id&num=$num&code=$code&pmode=$pmode></td></tr>
<tr><td width=190>이름: <input type=text name=name size=15 value=$name readonly=readonly></t>
암호: <input type=password name=passwd size=15 value=$passwd readonly=readonly>
</td>
<td>
<textarea name=message rows=3 cols=58>$message</textarea>
</td>
<td>
<input type=submit value=수정>
</td>
</tr>
</table>
");

mysql_close($con);

?>

</td></tr>
</table>
<? include ("bottom.html");   ?>
