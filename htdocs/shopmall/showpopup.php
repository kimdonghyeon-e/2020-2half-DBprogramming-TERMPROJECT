<?
$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result=mysql_query("select * from noti where id=$id",$con);

// �� �ʵ忡 �ش��ϴ� �����͸� �̾� ���� ����
$content=mysql_result($result,0,"content");

// ���̺�κ��� ���� ������ ȭ�鿡 ���÷���
echo("
  $content
");


mysql_close($con);



?>
