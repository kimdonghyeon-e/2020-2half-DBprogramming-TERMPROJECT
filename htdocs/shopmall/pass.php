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
		window.alert('로그인이 필요한 서비스입니다.');
		history.go(-1);
		</script>");
	exit;
}

else if ($uname != $UserName && $uemail != $usermail) {            // 암호가 일치하지 않는 경우
	echo   ("<script>
		window.alert('로그인한 계정으로 작성된 글이 아닙니다.');
		history.go(-1);
		</script>");
	exit;
} else {                  // 암호가 일치하는 경우
    switch ($mode) {
        case 0:          // 수정 프로그램 호출
            echo("<meta   http-equiv='Refresh' content='0; url=modify.php?board=$board&id=$id'>");
            break;
        case 1:          // 삭제 프로그램 호출
            echo("<meta   http-equiv='Refresh' content='0; url=delete.php?board=$board&id=$id'>");
            break;
    }
}

mysql_close($con);

?>
