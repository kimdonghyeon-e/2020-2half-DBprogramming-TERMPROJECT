<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>

<?

if (!$key) {
	echo("<script>
		window.alert('검색어를 입력하세요');
		history.go(-1);
		</script>");
	exit;
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result=mysql_query("select * from $board where $field like '%$key%' order by id desc",$con);
$total = mysql_num_rows($result);
echo("
	<link rel='stylesheet' href='style.css'/>
");
echo("
   <table border=0 width=700 align=center>
   <tr><td align=center colspan=2><h1>게시판검색결과</h1><hr></td><tr>
   <tr><td>검색어:<b>$key</b> , 찾은 개수:$total 개</td>
   <td align=right><a href=show.php?board=$board class='mbx'>전체목록</a></td></tr>
   </table>
");

echo("
   <table border=0 width=700 class='start' align=center>
   <tr class='main'><td align=center   width=50><b>번호</b></td>
   <td align=center width=100><b>글쓴이</b></td>
   <td align=center width=400><b>제목</b></td>
   <td align=center width=150><b>날짜</b></td>
   <td align=center width=50><b>조회</b></td>
   </tr>
");

if (!$total){
	echo("<tr><td colspan=5 align=center><font color=red><b>검색된 글이 없습니다.</b></font></td></tr></table>");
} else {

	$counter=0;

	while($counter<$total):

		$id=mysql_result($result,$counter,"id");
		$writer=mysql_result($result,$counter,"writer");
		$topic=mysql_result($result,$counter,"topic");
		$hit=mysql_result($result,$counter,"hit");
		$wdate=mysql_result($result,$counter,"wdate");
		$space=mysql_result($result,$counter,"space");

		$t="";

		if   ($space>0) {
			for ($i=0 ;   $i<=$space ; $i++)
			$t=$t .  "&nbsp;";	// $space > 0 인 경우 제목 앞에 공백 추가
		}

		echo("
			<tr class='else'><td align=center>$id</td>
			<td align=center>$writer</td>
			<td align=left>$t<a href=content.php?board=$board&id=$id>$topic");
			if (mysql_result($result,$counter,"filesize")!=0){
	      echo ("
	        <img src='./icon/fileicon.jpg' width=15 height=15 border=0>
	      ");
	    }
	    echo("
			</a></td>
			<td align=center>$wdate</td><td align=center>$hit</td>
			</tr>
		");

		$counter = $counter + 1;

	endwhile;

	echo("</table>");
}

mysql_close($con);

?>

</td></tr>
</table>
<? include ("bottom.html");   ?>
