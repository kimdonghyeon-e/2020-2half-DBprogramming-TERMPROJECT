<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

mysql_query("delete from $comment where num=$num",$con);
echo("
	<script>
	window.alert('����� ���� �Ǿ����ϴ�.');
	</script>
");

if ($pmode==1){
	echo("<meta http-equiv='Refresh' content='0; url=p-show.php?code=$code'>");
}
else {
	echo("<meta http-equiv='Refresh' content='0; url=content.php?board=$board&id=$id'>");
}

mysql_close($con);

?>
