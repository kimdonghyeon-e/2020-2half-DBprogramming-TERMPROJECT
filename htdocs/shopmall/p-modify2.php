<?

if (!$name){
	echo("
		<script>
		window.alert('��ǰ���� �����ϴ�. �ٽ� �Է��ϼ���.')
		history.go(-1)
		</script>
	");
	exit;
}

if(!$price1){
	echo("
		<script>
		window.alert('������ �����ϴ�. �ٽ� �Է��ϼ���.')
		history.go(-1)
		</script>
	");
	exit;
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	
// ���� ��ǰ �̹����� �״�� ����ϴ� ���
if (!$userfile){
	$result = mysql_query("update product set class=$class, name='$name', content='$content', price1=$price1, price2=$price2 where code='$code'", $con);

} else {

     // ���� ��ǰ �̹��� ������ ����
	$tmp = mysql_query("select userfile from product where code='$code'", $con);
	$fname = mysql_result($tmp, 0, "userfile");
    $savedir = "./photo";
	unlink("$savedir/$fname");
	
    // ������ ÷���� �̹��� ������ ����	
    $temp = $userfile_name;
    if (file_exists("$savedir/$temp")) {
         echo (" 
             <script>
             window.alert('������ ȭ�� �̸��� ������ �����մϴ�')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile, "$savedir/$temp");
         unlink($userfile);
    }
	$result = mysql_query("update product set class=$class, name='$name', content='$content', price1=$price1, price2=$price2, userfile='$userfile_name' where code='$code'", $con);
}

if (!$result) {
	echo("
      <script>
      window.alert('��ǰ ������ �����߽��ϴ�')
      </script>
    ");
    exit;
} else {
	echo("
      <script>
      window.alert('��ǰ ������ �Ϸ�Ǿ����ϴ�')
      </script>
   ");
} 

mysql_close($con);		//�����ͺ��̽� ��������

echo ("<meta http-equiv='Refresh' content='0; url=p-adminlist.php'>");

?>
