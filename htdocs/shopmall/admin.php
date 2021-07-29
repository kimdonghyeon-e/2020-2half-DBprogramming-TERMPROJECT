<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>


<?echo("
	<link rel='stylesheet' href='style.css'/>
");?>

<table border=0 width=600>
<tr><td align=center><h1>관리메뉴</h1><hr></td></tr>
</table>
<table border=0 width=600>
<tr><td width=140 align=center><img src=https://www.flaticon.com/svg/static/icons/svg/615/615075.svg width=40 height=40></td>
      <td width=40>&nbsp;</td>
      <td width=140 align=center><img src=https://www.flaticon.com/svg/static/icons/svg/2205/2205132.svg width=40 height=40></td>
	<td width=40>&nbsp;</td>
	<td width=140 align=center><img src=https://www.flaticon.com/svg/static/icons/svg/2298/2298276.svg width=40 height=40></td>
    <td width=40>&nbsp;</td>
    <td width=140 align=center><img src=https://www.flaticon.com/svg/static/icons/svg/564/564685.svg width=40 height=40></td>
</tr>
<tr height=3></tr>
<tr><td width=140 align=center><font size=3><b>회 원 관 리</b></td>
      <td width=40>&nbsp;</td>
      <td width=140 align=center><font size=3><b>상 품 관 리</b></td>
	<td width=40>&nbsp;</td>
	<td width=140 align=center><font size=3><b>주 문 관 리</b></td>
    <td width=40>&nbsp;</td>
    <td width=140 align=center><font size=3><b>공 지 사 항</b></td>
</tr>
<tr height=3></tr>
<tr><td align=center><a href=membershow.php class=mbx><font size=2>회원목록 조회</a></td>
      <td>&nbsp;</td>
	<td align=center><a href=p-input.php class=mbx><font size=2>신규상품 등록</a></td>
	<td>&nbsp;</td>
      <td align=center><a href=orderlist.php class=mbx><font size=2>주문내역 조회</a></td>
      <td>&nbsp;</td>
      <td align=center><a href=input.php?board=noti class=mbx><font size=2>공지사항 등록</a></td>
</tr>
<tr height=3></tr>
<tr><td align=center>&nbsp;</td>
      <td>&nbsp;</td>
	<td align=center><a href=p-adminlist.php class=mbx style=""><font size=2>판매상품 관리</a></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	<td align=center><a href=setpopup.php class=mbx><font size=2>공지사항 팝업</a></td>
</tr>
<tr height=3></tr>
<tr><td align=center>&nbsp;</td>
      <td>&nbsp;</td>
	     <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	<td align=center><a href=setbanner.php class=mbx><font size=2>공지사항 배너</a></td>
</tr>

</table>

</td></tr>
</table>
<? include ("bottom.html");   ?>
