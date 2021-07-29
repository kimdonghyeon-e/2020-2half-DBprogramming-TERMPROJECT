<?

$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("select * from likebag where id='$UserID'", $con);
$total = mysql_num_rows($result);

$counter=0;

while ($counter < $total):
  $pcode = mysql_result($result, $counter, "pcode");
  $quantity = mysql_result($result, $counter, "quantity");
  $shopresult = mysql_query("select * from shoppingbag where session='$Session' and pcode='$pcode'", $con);
  $shoptotal = mysql_num_rows($shopresult);
  if ($shoptotal) $oldnum = mysql_result($shopresult, 0, "quantity");
  if ($oldnum) {
     $quantity = $oldnum + $quantity;
     if ($quantity < 1 || $quantity > 100) {
    	  echo ("<script>
      		window.alert('변경하고자 하는 수량이 범위를 초과합니다')
      		history.go(-1)
    		</script>");
      exit;
    }
     mysql_query("update shoppingbag set quantity=$quantity where   session='$Session' and pcode='$pcode'", $con);
  } else {
     mysql_query("insert into shoppingbag(id, session, pcode, quantity) values ('$UserID','$Session', '$pcode', $quantity)", $con);
  }
  $counter = $counter + 1;
endwhile;

mysql_close($con);	//데이터베이스 연결해제

echo ("<meta http-equiv='Refresh' content='0; url=showbag.php'>");

?>
