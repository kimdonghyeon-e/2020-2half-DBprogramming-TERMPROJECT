<?
$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result=mysql_query("select * from noti where id=$id",$con);

// 각 필드에 해당하는 데이터를 뽑아 내는 과정
$content=mysql_result($result,0,"content");

// 테이블로부터 읽은 내용을 화면에 디스플레이
echo("
  $content
");


mysql_close($con);



?>
