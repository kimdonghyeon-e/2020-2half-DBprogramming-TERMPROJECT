<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from notibanner", $con);
$oldid = mysql_result($result, 0, "id");

$result=mysql_query("update notibanner set id=$id where id=$oldid", $con);

if (!$result) {
   echo("
      <script>
      window.alert('설정에 실패했습니다.')
      history.go(-1)
      </script>
   ");
   exit;
}
else {
  echo("
    <script>
    window.alert('설정을 완료했습니다.')
    history.go(-2)
    </script>
  ");
}


?>
