<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>

<?
echo("
	<link rel='stylesheet' href='style.css'/>
");

if (!isset($UserID)) {
	echo ("<script>
		window.alert('로그인 사용자만 이용하실 수 있어요')
		history.go(-1)
		</script>");
	exit;
}
?>

<table width=690 border=0>
	<tr><td align=center><h1>쇼핑관리</h1><hr></td></tr>
<tr><td align=center><h2>쇼핑카트</h2></td></tr>
<tr><td align=right><font size=2><b><? echo $UserName; ?></b>님의 현재 쇼핑 카트 내용</td>
</table>

<?
$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// 전체 쇼핑백 테이블에서 특정 사용자의 구매 정보만을 읽어낸다
$result = mysql_query("select * from shoppingbag where session='$Session'", $con);
$total = mysql_num_rows($result);

echo ("
	<table border=0 width=690 style='border:1px solid black; border-collapse:collapse;'>
    <tr><td width=100 align=center><font size=2>상품사진</td>
	<td width=300 align=center><font size=2>상품이름</td>
	<td width=90 align=center><font size=2>가격(단가)</td>
	<td width=50 align=center><font size=2>수량</td>
	<td width=100 align=center><font size=2>품목별합계</td>
	<td width=100 align=center><font size=2>적립포인트</td>
	<td width=50 align=center><font size=2>삭제</td></tr>
");

if (!$total) {
     echo("<tr><td colspan=7 align=center style='border:1px solid black;'><font size=2>쇼핑백에 담긴 상품이 없습니다.</td></tr></table>");
} else {

    $counter=0;
    $totalprice=0;
		$totalpoint=0;

    while ($counter < $total) :
       $pcode = mysql_result($result, $counter, "pcode");
       $quantity = mysql_result($result, $counter, "quantity");

       $subresult = mysql_query("select * from product where code='$pcode'", $con);
       $userfile = mysql_result($subresult, 0, "userfile");
       $pname = mysql_result($subresult, 0, "name");

       $price = mysql_result($subresult, 0, "price2");
			 $point=ceil($price/100);

       $subtotalprice = $quantity * $price;
       $totalprice = $totalprice + $subtotalprice;

			 $subpoint = $quantity * $point;
			 $totalpoint = $totalpoint + $subpoint;

		echo ("<tr><td align=center  style='border:1px solid black; border-collapse:collapse;'>
			<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=450,   height=450')\"><img src='./photo/$userfile' width=50   border=0></a></td>
			<td align=left  style='border:1px solid black; border-collapse:collapse;'><font size=2><a   href=p-show.php?code=$pcode>$pname </a></td>
			<td align=right  style='border:1px solid black; border-collapse:collapse;'><font size=2>$price&nbsp;원</td>
			<td align=center  style='border:1px solid black; border-collapse:collapse;'>
			<form method=post action=qmodify.php?pcode=$pcode><input type=text name=newnum size=3 value=$quantity>&nbsp;<input type=image src=https://www.flaticon.com/svg/static/icons/svg/339/339853.svg width=20 height=20 value=submit align=center valign=center>
			</td></form>
			<td align=right  style='border:1px solid black; border-collapse:collapse;'><font size=2>$subtotalprice&nbsp;원</td>
			<td align=right  style='border:1px solid black; border-collapse:collapse;'><font size=2>$subpoint&nbsp;포인트</td>
			<td align=center  style='border:1px solid black; border-collapse:collapse;'>
			<form method=post action=itemdelete.php?pcode=$pcode><input type=image src=https://www.flaticon.com/svg/static/icons/svg/812/812853.svg width=20 height=20 value=submit align=center valign=center></td></form>
			</tr>");

		$counter++;
    endwhile;

		$result = mysql_query("select * from member where uid='$UserID'", $con);
		$total = mysql_num_rows($result);

		$upoint=mysql_result($result, 0, "point");
		echo("<form method=post action=buy.php>");
    echo("<tr><td colspan=7 align=right><font size=2>보유 포인트: $upoint 포인트 &nbsp; / &nbsp; 사용할 포인트: <input type=text name=usepoint size=5 value=0> &nbsp; / &nbsp;
				총 적립 포인트: $totalpoint 포인트 &nbsp; / &nbsp; 총 구매 금액: <b>$totalprice</b> 원</td></tr></table>");

}



echo ("<table width=690 border=0>
	<tr><td align=center><input type=image src=https://www.flaticon.com/svg/static/icons/svg/1077/1077970.svg width=35 height=35 value=submit align=center valign=center></form></td> &nbsp; <td align=center valign=center><form method=post action=p-list.php margin=0 style='margin-bottom:0px;'><input type=image src=https://www.flaticon.com/svg/static/icons/svg/709/709606.svg width=30 height=30 value=submit align=center valign=center></form></td></tr>
		<tr><td align=center><font size=2>구매하기</font></td><td align=center><font size=2>쇼핑계속</font></td></tr>
		</table>");

echo("
	<br>
	<table width=690 border=0>
	<tr><td align=center><h2>찜하기</h2></td></tr>
	<tr><td align=right><font size=2><b>$UserName</b>님의 현재 찜하기 내용</td>
	</table>
");
	$result = mysql_query("select * from likebag where id='$UserID'", $con);
	$total = mysql_num_rows($result);

	echo ("
		<table border=0 width=690 style='border:1px solid black; border-collapse:collapse;'>
	    <tr><td width=100 align=center><font size=2>상품사진</td>
		<td width=300 align=center><font size=2>상품이름</td>
		<td width=90 align=center><font size=2>가격(단가)</td>
		<td width=50 align=center><font size=2>수량</td>
		<td width=100 align=center><font size=2>품목별합계</td>
		<td width=100 align=center><font size=2>적립포인트</td>
		<td width=50 align=center><font size=2>삭제</td></tr>
	");

	if (!$total) {
	     echo("<tr><td colspan=7 align=center  style='border:1px solid black; border-collapse:collapse;'><font size=2>찜한 상품이 없습니다.</td></tr></table>");
	} else {

	    $counter=0;
	    $totalprice=0;
			$totalpoint=0;

	    while ($counter < $total) :
	       $pcode = mysql_result($result, $counter, "pcode");
	       $quantity = mysql_result($result, $counter, "quantity");

	       $subresult = mysql_query("select * from product where code='$pcode'", $con);
	       $userfile = mysql_result($subresult, 0, "userfile");
	       $pname = mysql_result($subresult, 0, "name");

	       $price = mysql_result($subresult, 0, "price2");
				 $point=ceil($price/100);

	       $subtotalprice = $quantity * $price;
	       $totalprice = $totalprice + $subtotalprice;

				 $subpoint = $quantity * $point;
				 $totalpoint = $totalpoint + $subpoint;

			echo ("<tr><td align=center  style='border:1px solid black; border-collapse:collapse;'>
				<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=450,   height=450')\"><img src='./photo/$userfile' width=50   border=0></a></td>
				<td align=left style='border:1px solid black; border-collapse:collapse;'><font size=2><a   href=p-show.php?code=$pcode>$pname </a></td>
				<td align=right style='border:1px solid black; border-collapse:collapse;'><font size=2>$price&nbsp;원</td>
				<td align=center style='border:1px solid black; border-collapse:collapse;'>
				<form method=post action=likeqmodify.php?pcode=$pcode><input type=text name=newnum size=3 value=$quantity>&nbsp;<input type=image src=https://www.flaticon.com/svg/static/icons/svg/339/339853.svg width=20 height=20 value=submit align=center valign=center>
				</td></form>
				<td align=right style='border:1px solid black; border-collapse:collapse;'><font size=2>$subtotalprice&nbsp;원</td>
				<td align=right style='border:1px solid black; border-collapse:collapse;'><font size=2>$subpoint&nbsp;포인트</td>
				<td align=center style='border:1px solid black; border-collapse:collapse;'>
				<form method=post action=likeitemdelete.php?pcode=$pcode><input type=image src=https://www.flaticon.com/svg/static/icons/svg/812/812853.svg width=20 height=20 value=submit align=center valign=center></td></form>
				</tr>");

			$counter++;
	    endwhile;


	    echo("<tr><td colspan=7 align=right><font size=2>총 적립 포인트: $totalpoint 포인트 &nbsp; / &nbsp; 총 구매 금액: <b>$totalprice</b> 원</td></tr></table>");

	}


	echo("<form method=post action=toshoppingbag.php>");
	echo("<br>");
	echo ("<table width=690 border=0>
		<tr><td align=center><input type=image src=https://www.flaticon.com/svg/static/icons/svg/3126/3126526.svg width=30 height=30 value=submit align=center valign=center></form></td></tr>
		<tr><td align=center><font size=2>장바구니로</font></td></tr>
		</table>");



mysql_close($con);	//데이터베이스 연결해제
?>


</td></tr>
</table>
<? include ("bottom.html");   ?>
