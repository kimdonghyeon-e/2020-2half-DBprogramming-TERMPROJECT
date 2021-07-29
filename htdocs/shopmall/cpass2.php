<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result=mysql_query("select passwd from $comment where num=$num",$con);
$passwd=mysql_result($result,0,"passwd");

if ($pass != $passwd) {            // 암호가 일치하지 않는 경우
	echo   ("<script>
		window.alert('입력 암호가 일치하지 않네요');
		history.go(-1);
		</script>");
	exit;
} else {                  // 암호가 일치하는 경우
    switch ($mode) {
        case 0:          // 수정 프로그램 호출
            echo("<meta   http-equiv='Refresh' content='0; url=cmodify.php?board=$board&comment=$comment&num=$num&id=$id'>");
            break;
        case 1:          // 삭제 프로그램 호출
            echo("<meta   http-equiv='Refresh' content='0; url=cdelete.php?board=$board&comment=$comment&num=$num&id=$id'>");
            break;
    }
}

mysql_close($con);

?>
