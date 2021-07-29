<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>

<?
echo("
	<link rel='stylesheet' href='style.css'/>
");

if (!$fnd) {
	echo("<script>
		window.alert('검색어를 입력하세요');
		history.go(-1);
		</script>");
	exit;
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result=mysql_query("select * from product where name like '%$fnd%' order by hit desc",$con);
$total = mysql_num_rows($result);



if (!$total){
	echo   ("<table border=0 width=690><tr>");
	echo("<tr><td align=center colspan=2><h1>상품검색결과</h1><hr></td><tr>");
	echo ("<td align=right><a href=p-list.php class='mbx'>전체목록</a></td></tr><tr><td align=center><font color=red><b>검색된 상품이 없습니다</b></font></td></tr></table>");
} else {
		echo   ("<table border=0 width=690><tr>");
		echo("<tr><td align=center colspan=2><h1>상품검색결과</h1><hr></td><tr>");
		echo("<td align=left>검색어:<b>$fnd</b>, 찾은 개수:$total 개</td><td align=right><a href=p-list.php class='mbx'>전체목록</a></td></tr></tr></table>");
		echo   ("<table border=0 width=690><tr>");
  	$counter = 0;
  	while ($counter < $total &&   $counter < 15) :

  		if ($counter > 0 && ($counter % 5) == 0) echo ("</tr><tr><td colspan=5><hr size=1   color=black width=100%></td></tr><tr>");

  		$code=mysql_result($result,$counter,"code");
  		$name=mysql_result($result,$counter,"name");
  		$userfile=mysql_result($result,$counter,"userfile");
  		$price2=mysql_result($result,$counter,"price2");

  		switch(strlen($price2)) {
				case 7:
	         $price2 = substr($price2, 0, 1) . "," . substr($price2, 1, 3) . "," . substr($price2, 3,   3);
	         break;
  			case 6:
  			   $price2 = substr($price2, 0, 3) . "," . substr($price2, 3,   3);
  			   break;
  			case 5:
  			   $price2 = substr($price2, 0, 2) . "," . substr($price2, 2,   3);
  			   break;
  			case 4:
  			   $price2 = substr($price2, 0, 1) . "," . substr($price2, 1,   3);
  			   break;
  		}

  		echo ("<td width=135  align=center><a href=p-show.php?code=$code> <img src='./photo/$userfile' width=100 border=0><br><font color=black style='text- decoration:none;   font-size:10pt;'>$name</a></font><br>");
  		echo ("<font color=black   size=3><b>$price2</b><font><font color=black size=2>원</font></td>");

  		$counter++;
  	endwhile;
  }
  echo ("</tr></table>");
  mysql_close($con);

  ?>

  </td></tr>
  </table>
  <? include ("bottom.html");   ?>
