<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result=mysql_query("select * from $board where id=$id",$con);
$uname=mysql_result($result,0,"writer");
$uemail=mysql_result($result,0,"email");
$result=mysql_query("select * from $member where uid=$UserID",$con);
$usermail=mysql_result($result,0,"email");

if (!$UserID){
	echo   ("<script>
		window.alert('�α����� �ʿ��� �����Դϴ�.');
		history.go(-1);
		</script>");
	exit;
}

else if ($uname != $UserName && $uemail != $usermail) {            // ��ȣ�� ��ġ���� �ʴ� ���
	echo   ("<script>
		window.alert('�α����� �������� �ۼ��� ���� �ƴմϴ�.');
		history.go(-1);
		</script>");
	exit;
} else {                  // ��ȣ�� ��ġ�ϴ� ���
    switch ($mode) {
        case 0:          // ���� ���α׷� ȣ��
            echo("<meta   http-equiv='Refresh' content='0; url=modify.php?board=$board&id=$id'>");
            break;
        case 1:          // ���� ���α׷� ȣ��
            echo("<meta   http-equiv='Refresh' content='0; url=delete.php?board=$board&id=$id'>");
            break;
    }
}

mysql_close($con);

?>
