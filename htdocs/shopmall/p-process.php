<?

if (!$code){
	echo("
		<script>
		window.alert('��ǰ�ڵ���� �����ϴ�. �ٽ� �Է��ϼ���.')
		history.go(-1)
		</script>
	");
	exit;
}

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

if (!$userfile){
	echo("
		<script>
        window.alert('��ǰ ������ ������ �ּ���')
        history.go(-1)
        </script>
    ");
    exit;
} else {
    $savedir = "./photo";
    $temp = $userfile_name;
    if (file_exists("$savedir/$temp")) {
         echo ("
             <script>
             window.alert('������ ȭ�� �̸��� �̹� ������ �����մϴ�')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile, "$savedir/$temp");
         unlink($userfile);
    }
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("insert into product(class, code, name, content, price1, price2, userfile, hit, comment) values ($class, '$code', '$name', '$content', '$price1', '$price2', '$userfile_name', 0, '$code')", $con);



if (!$result) {
   echo("
      <script>
      window.alert('�̹� ������� ��ǰ �ڵ��Դϴ�')
      history.go(-1)
      </script>
   ");
   exit;
} else {
   echo("
      <script>
      window.alert('��ǰ ����� �Ϸ�Ǿ����ϴ�')
      </script>
   ");
}

mysql_query("create table $code(num int(5) auto_increment NOT NULL, name varchar(20), wdate varchar(20), message varchar(100), passwd varchar(20), primary key(num))");

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=p-adminlist.php'>");

?>
