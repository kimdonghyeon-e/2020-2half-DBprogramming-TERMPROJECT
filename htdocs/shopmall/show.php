<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>

<?
$board='testboard';
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from $board order by id desc", $con);
$total = mysql_num_rows($result);
echo("
	<link rel='stylesheet' href='style.css'/>
");
echo("
	<table border=0 width=700 align=center>
	<tr><td colspan=2 align=center><h1>고객게시판</h1><hr></td></tr>
	<tr><td align=center>
	<form method=post action=search.php?board=$board>
	<select name=field>
	<option value=writer>글쓴이</option>
	<option value=topic>제목</option>
	<option value=content>내용</option>
	</select>
	검색어<input type=text name=key size=13>
	<input type=image src=https://d1unjqcospf8gs.cloudfront.net/assets/home/base/header/search-icon-7008edd4f9aaa32188f55e65258f1c1905d7a9d1a3ca2a07ae809b5535380f14.svg
      border=0 width=20 height=20 value=submit align=center>
	</td>
	</form>
	<td align=right><a href=input.php?board=$board><img src=https://www.flaticon.com/svg/static/icons/svg/860/860814.svg width=30 height=30 valign=center align=center></a></td></tr>
	</table>
	<table border=0 width=700 class='start' align=center>
	<tr class='main'><td align=center width=50><b>번호</b></td>
	<td align=center width=100><b>글쓴이</b></td>
	<td align=center width=400><b>제목</b></td>
	<td align=center width=150><b>날짜</b></td>
	<td align=center width=50><b>조회</b></td>
	</tr>
");

if (!$total){
	echo("
		<tr><td colspan=5 align=center>아직 등록된 글이 없습니다.</td></tr></table>
	");
} else {

	if   ($cpage=='') $cpage=1;    // $cpage -  현재 페이지 번호
	$pagesize = 8;                // $pagesize - 한 페이지에 출력할 목록 개수

	$totalpage = (int)($total/$pagesize);
	if (($total%$pagesize)!=0) $totalpage = $totalpage + 1;

	$counter=0;

	while($counter<$pagesize):
		$newcounter=($cpage-1)*$pagesize+$counter;
		if ($newcounter == $total) break;

		$id=mysql_result($result,$newcounter,"id");
		$writer=mysql_result($result,$newcounter,"writer");
		$topic=mysql_result($result,$newcounter,"topic");
		$hit=mysql_result($result,$newcounter,"hit");
		$wdate=mysql_result($result,$newcounter,"wdate");
		$space=mysql_result($result,$newcounter,"space");
		$comment=mysql_result($result,$newcounter,"comment");
		$cnums = mysql_query("select * from $comment order by num desc", $con);
		if (!$cnums)
			$cnum=0;

		else
			$cnum = mysql_num_rows($cnums);

    //if (mysql_result($result,$newcounter,"filename")!=NULL) $filetrue="[파일]";
    //else $filetrue="";

		$t="";

		if   ($space>0) {
			for ($i=0 ; $i<=$space ; $i++)
				$t = $t . "&nbsp;";     // 답변 글의 경우 제목 앞 부분에 공백을 채움
		}

		echo("
			<tr class='else'><td align=center>$id</td>
			<td align=center>$writer</td>
			<td align=left>$t<a href=content.php?board=$board&id=$id&icpage=$cpage>$topic</a>");
    if (mysql_result($result,$newcounter,"filesize")!=0){
      echo ("
        <img src='./icon/fileicon.jpg' width=15 height=15 border=0>
      ");

    }
    echo("
      ($cnum)</td>
			<td align=center>$wdate</td><td align=center>$hit</td>
			</tr>
		");

		$counter = $counter + 1;

	endwhile;

	echo("</table>");

	echo ("<table border=0 width=700 align=center>
		  <tr><td align=center>");

	// 화면 하단에 페이지 번호 출력
	if ($cblock=='') $cblock=1;   // $cblock - 현재 페이지 블록값
	$blocksize = 5;             // $blocksize - 화면상에 출력할 페이지 번호 개수

	$pblock = $cblock - 1;      // 이전 블록은 현재 블록 - 1
	$nblock = $cblock + 1;     // 다음 블록은 현재 블록 + 1

	// 현재 블록의 첫 페이지 번호
	$startpage = ($cblock - 1) * $blocksize + 1;

	$pstartpage = $startpage - 1;  // 이전 블록의 마지막 페이지 번호
	$nstartpage = $startpage + $blocksize;  // 다음 블록의 첫 페이지 번호

	if ($pblock > 0)        // 이전 블록이 존재하면 [이전블록] 버튼을 활성화
		echo ("<a href=show.php?board=$board&cblock=$pblock&cpage=$pstartpage class='mbx'>이전</a> ");

	// 현재 블록에 속한 페이지 번호를 출력
	$i =   $startpage;
	while($i < $nstartpage):
	   if ($i > $totalpage) break;  // 마지막 페이지를 출력했으면 종료함
	   echo ("<a href=show.php?board=$board&cblock=$cblock&cpage=$i class='mbx'>$i</a>");
	   $i = $i + 1;
	endwhile;

	// 다음 블록의 시작 페이지가 전체 페이지 수보다 작으면 [다음블록] 버튼 활성화
	if ($nstartpage <= $totalpage)
		echo ("<a href=show.php?board=$board&cblock=$nblock&cpage=$nstartpage class='mbx'>다음</a> ");

	echo ("</td></tr></table>");
}

mysql_close($con);

?>


</td></tr>
</table>
<? include ("bottom.html");   ?>
