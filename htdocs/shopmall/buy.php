<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>


<script language='Javascript'>
	function go_zip(){
		window.open('zipcode2.php', 'zipcode',   'width=470, height=180, scrollbars=yes');
	}
</script>



<table width=690 border=0>
<tr><td align=center><h1>상품구매</h1><hr></td></tr>
<tr><td align=center><h2>구매확인</h2></td></tr>
<tr><td align=right><font size=2><b><? echo $UserName; ?></b>님의 구입 예정   품목</td>
</table>

<?

echo("
	<link rel='stylesheet' href='style.css'/>
");

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from member where uid='$UserID'", $con);
$total = mysql_num_rows($result);
$upoint=mysql_result($result, 0, "point");

if ($usepoint < 0) {
	echo("
		<script>
		window.alert('포인트는 음수 사용이 불가능합니다.')
		history.go(-1)
		</script>
	");
}

if ($usepoint > $upoint){
	echo("
		<script>
		window.alert('보유 포인트보다 초과 사용은 불가능합니다.')
		history.go(-1)
		</script>
	");
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// 전체 쇼핑백 테이블에서 특정 사용자의 구매 정보만을 읽어낸다
$result = mysql_query("select * from shoppingbag where session='$Session'", $con);
$total = mysql_num_rows($result);

echo ("
	<table border=1 width=690 style='border:1px solid black; border-collapse:collapse;'>
    <tr><td width=100 align=center><font size=2>상품사진</td>
	<td width=300 align=center><font size=2>상품이름</td>
	<td width=90 align=center><font size=2>가격(단가)</td>
	<td width=50 align=center><font ssize=2>수량</td>
	<td width=100 align=center><font size=2>품목별합계</td>
	<td width=100 align=center><font size=2>적립포인트</td></tr>
	");

if (!$total) {
     echo("<tr><td colspan=5 align=center  style='border:1px solid black; border-collapse:collapse;'><font   size=2><b>쇼핑백에 담긴 상품이   없습니다.</b>
        </font></td></tr></table>");
} else {

    $counter=0;
    $totalprice=0;    // 총 구매 금액
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

		echo("<tr><td align=center style='border:1px solid black; border-collapse:collapse;'><a href=#   onclick=\"window.open('./photo/$userfile', '_new', 'width=450, height=450')\"><img src='./photo/$userfile' width=50 border=0></a></td>
			<td align=left style='border:1px solid black; border-collapse:collapse;'><font size=2><a href=p-show.php?code=$pcode>$pname</a></td>
			<td align=right style='border:1px solid black; border-collapse:collapse;'><font size=2>$price&nbsp;원</td>
			<td align=center style='border:1px solid black; border-collapse:collapse;'><font size=2>$quantity&nbsp;개</td>
			<td align=right style='border:1px solid black; border-collapse:collapse;'><font size=2>$subtotalprice&nbsp;원</td>
			<td align=right style='border:1px solid black; border-collapse:collapse;'><font size=2>$subpoint&nbsp;포인트</td></tr>");

		$counter++;

    endwhile;

		$npoint=$upoint-$usepoint;
		$totalprice=$totalprice-$usepoint;
		$inputpoint=$npoint+$totalpoint;
     echo("<tr><td colspan=6 align=right><font size=2>잔여 보유 포인트: $npoint 포인트 &nbsp; / &nbsp; 사용 포인트: <b>$usepoint</b> 포인트 &nbsp; / &nbsp; 총 적립 포인트: $totalpoint 포인트 &nbsp; / &nbsp; 총 구매 금액: <b>$totalprice</b> 원</td></tr></table>");
}



echo ("<br>
		<table border=0 width=690>
        <tr><td align=center><font size=2>입금 계좌: <b>국민은행 999999-99-999999 (예금주: 김동현)</b><br><br>
		* 구입하신 물품은 입금 확인후 배송되며, 주문 진행 상황은 My Page에서 확인하실 수 있습니다.<br>
		* 물품 배송 이전에 주문 취소를 원하시면 My Page에서 직접 주문 취소 요청을 하시면 됩니다.<br>
		* 물품을 배송 받으신 후에 구매 취소를 원하시면 고객센터(전화:070-1234-1234)로 연락주세요.
       </td></tr>
       </table>");

$result = mysql_query("select * from member where uid='$UserID'", $con);

$uname = mysql_result($result, 0, "uname");
$mphone = mysql_result($result, 0, "mphone");
$zipcode = mysql_result($result, 0, "zipcode");
$address1 = mysql_result($result, 0, "addr1");
$address2 = mysql_result($result, 0, "addr2");

mysql_close($con);	//데이터베이스 연결해제

echo("
    <br><br>
	<table width=690 border=0>
	<tr><td align=center><h2>배송정보<h2></td></tr>
	</table>

	<table width=690 border=0>
	<form method=post action=endshopping.php?totalpoint=$inputpoint&totalmount=$totalprice name=buy>
	<tr><td align=right width=80><font size=2>받는이</td>
	<td><input type=text name=receiver size=10 value=$uname></td>
	</tr>
	<tr>
	<td align=right><font size=2>전화번호</td>
	<td><input type=text name=phone   size=20 value=$mphone></td>
	</tr>
	<tr><td height=30 align=right><font size=2>배송주소</td>
	<td align=left><input type=text size=6 name=zip readonly=readonly value=$zipcode>
	<font size=2><a href='javascript:go_zip()' class='mbx'>우편번호검색</a><br>
	<input type=text size=55 name=addr1 readonly=readonly style='font-size:10pt; font-family:Tahoma;' value='$address1'>
	<input type=text size=30 name=addr2   style='font-size:10pt; font-family:Tahoma;' value='$address2'></td>
	<tr><td align=right><font size=2>주문요구사항</td>
	<td><textarea name=message rows=3 cols=65></textarea></td></tr>
	<tr height=10></tr>
	<tr><td align=center colspan=2>
	<input type=image src=https://www.flaticon.com/svg/static/icons/svg/3604/3604093.svg width=40 height=40 value=submit align=center valign=center></td></tr>
	<tr><td align=center colspan=2><font size=2>구매완료&nbsp;&nbsp;</font></td></tr>
	<tr height=10></tr>
	</table>
	</form>
	</center>
");

?>


</td></tr>
</table>
<? include ("bottom.html");   ?>
