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

$result = mysql_query("select * from product where code='$code'", $con);
$total = mysql_num_rows($result);

$name=mysql_result($result,0,"name");
$content=mysql_result($result,0,"content");
$content=nl2br($content);

$price1=mysql_result($result,0,"price1");
$price2=mysql_result($result,0,"price2");
$userfile=mysql_result($result,0,"userfile");
$comment=mysql_result($result,0,"comment");
$point=ceil($price2/100);

// ��ǰ�� ��ȸ���� �о�ͼ� 1 ������Ų ���� ������Ʈ ������ ����
$hit=mysql_result($result,0,"hit");
$hit++;
mysql_query("update product set hit=$hit where code='$code'", $con);

echo ("
	<table width=650 border=0>
    <tr><td width=250 align=center>
	<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=450, height=450')\"><img src='./photo/$userfile' width=150 border=1></a></td>
    <td width=400 valign=top>
    <table border=0 width=100%>
	  <tr><td width=80 align=center>��ǰ�ڵ�: </td>
	  <td width=320>&nbsp;&nbsp;$code</td></tr>
	  <tr><td align=center>��ǰ�̸�: </td>
	  <td>&nbsp;&nbsp;$name</td></tr>
	  <tr><td align=center>��ǰ����: </td>
	  <td>&nbsp;&nbsp;<strike>$price1&nbsp;��</strike></td></tr>
	  <tr><td align=center>���ΰ���: </td>
	  <td>&nbsp;&nbsp;<b>$price2&nbsp;��</b></td></tr>
		<tr><td align=center>��������: </td>
	  <td>&nbsp;&nbsp;$point&nbsp;����Ʈ</td></tr>
    	  <tr><td colspan=2 height=80 valign=bottom align=right>
	     <form method=post action=tobag.php?code=$code>
	     <input type=text size=3 name=quantity value=1>&nbsp;
	     <input type=image src=https://www.flaticon.com/svg/static/icons/svg/833/833314.svg width=30 height=30 align=center valign=center value=submit>
	     </td></tr></form>
			 <tr><td colspan=2 height=10 valign=top align=right>
			 <form method=post action=tolike.php?code=$code>
			 <input type=text size=3 name=quantity value=1>&nbsp;
			 <input type=image src=https://www.flaticon.com/svg/static/icons/svg/860/860808.svg width=30 height=30 align=center valign=center value=submit>
			 </td></tr></form>
	</table>
	</td>
	</tr>
	</table>
	<br>
	<table width=650 border=0>
		<tr><td align=center>[��ǰ �� ����]</td></tr>
		<tr><td><hr size=1></td></tr>
		<tr><td>$content</td></tr>
	</table>
");

echo("
</br>
<table   border=0 width=700 align=center>
<tr><td align=left colspan=4><b>��ǰ��</b></td></tr>
<tr><td><form method=post action=cprocess.php?comment=$comment&board=$board&id=$id&pmode=1&code=$code></td></tr>
<tr><td width=190>�̸�: <input type=text name=wname size=15 readonly=readonly value=$UserName></t>
��ȣ: <input type=password name=wpasswd size=15 readonly=readonly value=$UserID>
</td>
<td>
<textarea name=wmemo rows=3 cols=58>��ǰ�� ������ �Է��ϼ���</textarea>
</td>
<td>
<input type=image src='https://www.flaticon.com/svg/static/icons/svg/833/833275.svg' width=30 height=30 value=submit align=center valign=center>
</td>
</tr>
</table>
");

$result=mysql_query("select * from $comment order by num desc", $con);
$total=mysql_num_rows($result);
echo("<table border=0 width=700 class='start' align=center>");
if ($total){
	echo ("
	<tr class='main'></td><td width=100>�̸�</td>
	<td width=100>����¥</td><td width=400>��ǰ�򳻿�</td><td width=100> ���� / ����</tr>
	");
}
	$pagesize =   8;	// �� �������� ���� �� �޸� ���� ����

if ($cpage ==  '') $cpage = 1;

$endpage = (int)($total / $pagesize);

if ( ($total % $pagesize) != 0 ) $endpage = $endpage + 1;

$i = 0;

while ( $i   < $pagesize ) :
	$counter = $pagesize * ($cpage - 1) + $i;
	if ($counter == $total) break;
	$num = mysql_result($result, $counter, "num");
	$name = mysql_result($result, $counter, "name");
	$wdate = mysql_result($result, $counter, "wdate");
	$message = mysql_result($result,   $counter, "message");

	echo ("
		<tr class='elsenhv'><td>$name</td>
		<td>$wdate</td><td>$message</td>
		<td><a href=cpass.php?code=$code&mode=0&pmode=1&comment=$comment&id=$id&num=$num class='mbx'>����</a>
		<a href=cpass.php?code=$code&mode=1&pmode=1&comment=$comment&id=$id&num=$num class='mbx'>����</a>
		</tr>
	");

	$i++;

endwhile;

echo ("</table>");

echo ("<table border=0 width=700 align=center><tr><td align=center>");

$ppage =   $cpage - 1;
$npage =   $cpage + 1;

if ($cpage > 1) echo ("<a href=p-show.php?code=$code&cpage=$ppage class='mbx'>������ǰ��</a>");

if ($cpage < $endpage) echo ("<a href=p-show.php?code=$code&cpage=$npage class='mbx'>������ǰ��</a>");

echo("</table>");

?>

</td></tr>
</table>
<? include ("bottom.html");   ?>
