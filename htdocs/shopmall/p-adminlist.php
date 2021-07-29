<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>

<?
echo("
	<link rel='stylesheet' href='style.css'/>
");

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("select * from product order by name", $con);

$total = mysql_num_rows($result);

echo("
<center><h1>관리메뉴</h1><hr></center>
<center><h2>판매상품 관리</h2></center>
");

echo ("<table border=0 width=690 style='border:1px solid black; border-collapse:collapse;'>
	<tr><td align=center><font size=2>상품코드</td>
	<td colspan=2 align=center><font size=2>상품명</td>
	<td align=center><font size=2>권장가격</td>
	<td align=center><font size=2>판매가격</td>
	<td align=center width=100><font size=2>수정/삭제</td></tr>");

if (!$total) {

  echo("<tr><td colspan=6 align=center>아직 등록된 상품이 없습니다</td></tr>");

} else {

	$counter = 0;

	while ($counter < $total) :

		$code=mysql_result($result,$counter,"code");
		$name=mysql_result($result,$counter,"name");
		$userfile=mysql_result($result,$counter,"userfile");
		$price1=mysql_result($result,$counter,"price1");
		$price2=mysql_result($result,$counter,"price2");

		echo ("
		   <tr><td width=100 align=center style='border:1px solid black; border-collapse:collapse;'><font size=2>$code</td>
			 <td align=center width=30 style='border:1px solid black; border-collapse:collapse;'><img src='./photo/$userfile' width=40 height=40 border=0></td>
			   <td width=350 align=left style='border:1px solid black; border-collapse:collapse;'><a href=p-show.php?code=$code><font size=2>$name</a></td>
			   <td align=right width=70 style='border:1px solid black; border-collapse:collapse;'><font size=2><strike>$price1&nbsp;원</strike></td>
			   <td align=right width=70 style='border:1px solid black; border-collapse:collapse;'><font size=2>$price2&nbsp;원</td>
			   <td width=70 align=center style='border:1px solid black; border-collapse:collapse;'><font size=2><a href=p-modify.php?code=$code class=mbx>수정</a> <a href=p-delete.php?code=$code class=mbx>삭제</a></td></tr>");

		$counter++;
	endwhile;
}

echo ("</table>");

mysql_close($con);

?>


</td></tr>
</table>
<? include ("bottom.html");   ?>
