<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from notibanner", $con);
$oldid = mysql_result($result, 0, "id");

$result=mysql_query("update notibanner set id=$id where id=$oldid", $con);

if (!$result) {
   echo("
      <script>
      window.alert('������ �����߽��ϴ�.')
      history.go(-1)
      </script>
   ");
   exit;
}
else {
  echo("
    <script>
    window.alert('������ �Ϸ��߽��ϴ�.')
    history.go(-2)
    </script>
  ");
}


?>
