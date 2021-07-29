<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>

<script type='text/javascript' src=./ckeditor/ckeditor.js></script>
<?
echo("
	<link rel='stylesheet' href='style.css'/>
");

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("select * from product where code='$code'", $con);

$class=mysql_result($result,0,"class");
$name=mysql_result($result,0,"name");
$price1=mysql_result($result,0,"price1");
$price2=mysql_result($result,0,"price2");
$content=mysql_result($result,0,"content");
$userfile=mysql_result($result,0,"userfile");

echo("
<center><h1>관리메뉴</h1><hr></center>
<center><h2>판매상품 수정</h2></center>
");

echo ("
    <table align=center border=0 width=650>
	<form method=post action=p-modify2.php?code=$code enctype='multipart/form-data'>
	<tr><td width=100 align=center>상품코드</td>
	<td width=550><b>$code</b></td></tr>
	<tr><td align=center>상품분류</td>
	<td><select name=class>");

switch($class) {
    case 1:
		echo ("<option value=1 selected>Apple</option>
			<option value=2>SAMSUNG</option>
            <option value=3>LG</option>");
		break;
	case 2:
		echo ("<option value=1>Apple</option>
			<option value=2 selected>SAMSUNG</option>
            <option value=3>LG</option>");
		break;
	case 3:
       echo ("<option value=1>Apple</option>
			<option value=2>SAMSUNG</option>
            <option value=3 selected>LG</option>");
		break;
}

echo ("</select></td></tr>
	<tr><td align=center>상품이름</td><td><input type=text name=name size=70 value='$name'></td></tr>
	<tr><td align=center>상품설명</td><td><textarea name=content rows=15 cols=75>$content</textarea><script type='text/javascript'>CKEDITOR.replace('content');</script></td></tr>
	<tr><td align=center>정상가격</td><td><input type=text name=price1 size=15 value=$price1>원</td></tr>
	<tr><td align=center>할인가격</td><td><input type=text name=price2 size=15 value=$price2>원</td></tr>
	<tr><td align=center>상품사진</td><td><input type=file size=30 name=userfile><-- $userfile</td></tr>
	<tr><td align=center colspan=2><input type=submit value=수정완료></tr>
	</form>
	</table>");

mysql_close($con);

?>

</td></tr>
</table>
<? include ("bottom.html");   ?>
