<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>


<?
echo("
	<link rel='stylesheet' href='style.css'/>
");

if ($UserID != 'admin') {
	echo ("<script>
		window.alert('관리자만 접근 가능한 기능입니다')
		history.go(-1)
		</script>");
    exit;
}

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall",   $con);

$result = mysql_query("select * from member order by uname", $con);
$total = mysql_num_rows($result);

echo ("
	<table border=0 width=690>
	<tr><td align=center><h1>관리메뉴</h1><hr></td></tr>
    <tr><td align=center><h2>회원목록 조회</h2></td></tr>
	<tr><td align=right><a href=admin.php><img src=https://www.flaticon.com/svg/static/icons/svg/2223/2223615.svg width=30 height=30></a></td>
	<tr><td align=right><font size=2>이전</font></td>
	</tr></table> ");

$i = 0;

echo ("
	<table border=0 width=690 style='border:1px solid black; border-collapse:collapse;'>
	<tr height=35>
	<td align=center width=60><font size=2><b>ID</b></td>
	<td align=center width=50><font   size=2><b>이름</b></td>
	<td align=center width=340><font size=2><b>주소</b></td>
	<td align=center width=100><font size=2><b>전화번호</b></td>
	<td align=center width=100><font size=2><b>이메일</b></td>
	<td align=center width=40><font size=2><b>활성</b></td></tr>
");

while($i < $total):
	$uid = mysql_result($result, $i, "UID");
	$uname = mysql_result($result, $i, "UNAME");
	$zip = mysql_result($result, $i, "ZIPCODE");
	$addr1 = mysql_result($result, $i, "ADDR1");
	$addr2 = mysql_result($result, $i, "ADDR2");
	$mphone = mysql_result($result, $i, "MPHONE");
	$email = mysql_result($result, $i, "EMAIL");
	$approved = mysql_result($result, $i, "APPROVED");

	$address = "(" . $zip .   ")" . "&nbsp;" . $addr1 . "&nbsp;" .   $addr2;

    echo ("<tr height=30><td align=center style='border:1px solid black; border-collapse:collapse;'><font size=2>$uid</td>
		<td align=center style='border:1px solid black; border-collapse:collapse;'><font size=2>$uname</td>
		<td style='border:1px solid black; border-collapse:collapse;'><font size=2>$address</td>
		<td align=center style='border:1px solid black; border-collapse:collapse;'><font size=2>$mphone</td>
		<td align=center style='border:1px solid black; border-collapse:collapse;'><font size=2>$email</td>");

	if ($approved == 0) {
		echo ("<td align=center style='border:1px solid black; border-collapse:collapse;'><a href=memberchange.php?uid=$uid><img src=https://www.flaticon.com/svg/static/icons/svg/3524/3524737.svg width=20 height=20></a></td></tr>");
	} else {
		echo ("<td align=center style='border:1px solid black; border-collapse:collapse;'><a href=memberchange.php?uid=$uid><img src=https://www.flaticon.com/svg/static/icons/svg/3524/3524758.svg width=20 height=20></a></td></tr>");
	}

	$i++;
endwhile;

echo ("</table>");
mysql_close($con);

?>


</td></tr>
</table>
<? include ("bottom.html");   ?>
