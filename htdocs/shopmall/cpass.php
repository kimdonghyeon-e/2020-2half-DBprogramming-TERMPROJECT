<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result=mysql_query("select passwd from $comment where num=$num",$con);
$passwd=mysql_result($result,0,"passwd");

if (!$UserID){
	echo   ("<script>
		window.alert('�α����� �ʿ��� �����Դϴ�.');
		history.go(-1);
		</script>");
	exit;
}

else if ($UserID != $passwd) {            // ��ȣ�� ��ġ���� �ʴ� ���
	echo   ("<script>
		window.alert('����� �ۼ��� ������ �ƴմϴ�.');
		history.go(-1);
		</script>");
	exit;
} else {                  // ��ȣ�� ��ġ�ϴ� ���
    switch ($mode) {
        case 0:          // ���� ���α׷� ȣ��
            echo("<meta   http-equiv='Refresh' content='0; url=cmodify.php?board=$board&comment=$comment&num=$num&id=$id&code=$code&pmode=$pmode'>");
            break;
        case 1:          // ���� ���α׷� ȣ��
            echo("<meta   http-equiv='Refresh' content='0; url=cdelete.php?board=$board&comment=$comment&num=$num&id=$id&code=$code&pmode=$pmode'>");
            break;
    }
}

mysql_close($con);

?>
