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

if   (!isset($class)) $class=0;

switch($class) {
   case 0:      // 초기화면에 출력할 인기 상품 목록
       $result = mysql_query("select * from product order by hit desc", $con);
       echo("<img src=https://www.flaticon.com/svg/static/icons/svg/3556/3556490.svg width=60 height=60 valign=center ><h1 style='margin-top:0;'>TOP 15</h1><hr></font>");
		break;
		case 1:
			$result = mysql_query("select * from product where class=$class order by hit desc", $con);
			echo("<img src=https://www.flaticon.com/svg/static/icons/svg/1532/1532495.svg width=60 height=60 valign=center style='margin-bottom:21px;'><hr>");
			break;
		case 2:
			$result = mysql_query("select * from product where class=$class order by hit desc", $con);
			echo("<img src=https://www.flaticon.com/svg/static/icons/svg/882/882747.svg width=60 height=60 valign=center style='margin-bottom:21px;'><hr>");
			break;
		case 3:
			$result = mysql_query("select * from product where class=$class order by hit desc", $con);
			echo("<img src=https://www.flaticon.com/svg/static/icons/svg/882/882722.svg width=60 height=60 valign=center style='margin-bottom:21px;'><hr>");
			break;
   default:     // 카테고리별 메뉴 화면에 출력할 상품 목록
       $result = mysql_query("select * from product where class=$class order by hit desc", $con);
		break;
}

$total = mysql_num_rows($result);

echo   ("<table border=0 width=690><tr>");

if (!$total){
	echo ("<td align=center><font color=red>아직 등록된 상품이 없습니다</td>");
} else {

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
		echo ("<font color=black   size=3><b>$price2</b><font><font color=black   size=2>원</font></td>");

		$counter++;
	endwhile;
}
echo ("</tr></table>");
mysql_close($con);

?>

</td></tr>
</table>
<? include ("bottom.html");   ?>
