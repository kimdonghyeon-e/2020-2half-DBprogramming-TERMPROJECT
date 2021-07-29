<?
$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall", $con);
$result=mysql_query("select * from notipopup", $con);
$id = mysql_result($result,0,"id");

if ($id!=0) {
    echo("
    <script>
   	  window.open('showpopup.php?id=$id','Remote', 'left=450, top=0, width=350,height=410');
    </script>
    ");
}

echo ("
  <meta http-equiv='Refresh' content='0; url=p-list.php?class=0'>
");

?>
