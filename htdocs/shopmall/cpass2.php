<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result=mysql_query("select passwd from $comment where num=$num",$con);
$passwd=mysql_result($result,0,"passwd");

if ($pass != $passwd) {            // ��ȣ�� ��ġ���� �ʴ� ���
	echo   ("<script>
		window.alert('�Է� ��ȣ�� ��ġ���� �ʳ׿�');
		history.go(-1);
		</script>");
	exit;
} else {                  // ��ȣ�� ��ġ�ϴ� ���
    switch ($mode) {
        case 0:          // ���� ���α׷� ȣ��
            echo("<meta   http-equiv='Refresh' content='0; url=cmodify.php?board=$board&comment=$comment&num=$num&id=$id'>");
            break;
        case 1:          // ���� ���α׷� ȣ��
            echo("<meta   http-equiv='Refresh' content='0; url=cdelete.php?board=$board&comment=$comment&num=$num&id=$id'>");
            break;
    }
}

mysql_close($con);

?>
