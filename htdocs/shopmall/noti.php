<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>

<?
$board='noti';
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from $board order by id desc", $con);
$total = mysql_num_rows($result);
echo("
	<link rel='stylesheet' href='style.css'/>
");
echo("
	<table border=0 width=700 align=center>
	<tr><td colspan=2 align=center><h1>��������</h1><hr></td></tr>
	</table>
	<table border=0 width=700 class='start' align=center>
	<tr class='main'><td align=center width=50><b>��ȣ</b></td>
	<td align=center width=100><b>�۾���</b></td>
	<td align=center width=400><b>����</b></td>
	<td align=center width=150><b>��¥</b></td>
	<td align=center width=50><b>��ȸ</b></td>
	</tr>
");

if (!$total){
	echo("
		<tr><td colspan=5 align=center>���� ��ϵ� ���� �����ϴ�.</td></tr></table>
	");
} else {

	if   ($cpage=='') $cpage=1;    // $cpage -  ���� ������ ��ȣ
	$pagesize = 8;                // $pagesize - �� �������� ����� ��� ����

	$totalpage = (int)($total/$pagesize);
	if (($total%$pagesize)!=0) $totalpage = $totalpage + 1;

	$counter=0;

	while($counter<$pagesize):
		$newcounter=($cpage-1)*$pagesize+$counter;
		if ($newcounter == $total) break;

		$id=mysql_result($result,$newcounter,"id");
		$writer=mysql_result($result,$newcounter,"writer");
		$topic=mysql_result($result,$newcounter,"topic");
		$hit=mysql_result($result,$newcounter,"hit");
		$wdate=mysql_result($result,$newcounter,"wdate");
		$space=mysql_result($result,$newcounter,"space");
		$comment=mysql_result($result,$newcounter,"comment");
		$cnums = mysql_query("select * from $comment order by num desc", $con);
		if (!$cnums)
			$cnum=0;

		else
			$cnum = mysql_num_rows($cnums);

    //if (mysql_result($result,$newcounter,"filename")!=NULL) $filetrue="[����]";
    //else $filetrue="";

		$t="";

		if   ($space>0) {
			for ($i=0 ; $i<=$space ; $i++)
				$t = $t . "&nbsp;";     // �亯 ���� ��� ���� �� �κп� ������ ä��
		}

		echo("
			<tr class='else'><td align=center>$id</td>
			<td align=center>$writer</td>
			<td align=left>$t<a href=content.php?board=$board&id=$id&icpage=$cpage>$topic</a>");
    if (mysql_result($result,$newcounter,"filesize")!=0){
      echo ("
        <img src='./icon/fileicon.jpg' width=15 height=15 border=0>
      ");

    }
    echo("
      ($cnum)</td>
			<td align=center>$wdate</td><td align=center>$hit</td>
			</tr>
		");

		$counter = $counter + 1;

	endwhile;

	echo("</table>");

	echo ("<table border=0 width=700 align=center>
		  <tr><td align=center>");

	// ȭ�� �ϴܿ� ������ ��ȣ ���
	if ($cblock=='') $cblock=1;   // $cblock - ���� ������ ��ϰ�
	$blocksize = 5;             // $blocksize - ȭ��� ����� ������ ��ȣ ����

	$pblock = $cblock - 1;      // ���� ����� ���� ��� - 1
	$nblock = $cblock + 1;     // ���� ����� ���� ��� + 1

	// ���� ����� ù ������ ��ȣ
	$startpage = ($cblock - 1) * $blocksize + 1;

	$pstartpage = $startpage - 1;  // ���� ����� ������ ������ ��ȣ
	$nstartpage = $startpage + $blocksize;  // ���� ����� ù ������ ��ȣ

	if ($pblock > 0)        // ���� ����� �����ϸ� [�������] ��ư�� Ȱ��ȭ
		echo ("<a href=show.php?board=$board&cblock=$pblock&cpage=$pstartpage class='mbx'>����</a> ");

	// ���� ��Ͽ� ���� ������ ��ȣ�� ���
	$i =   $startpage;
	while($i < $nstartpage):
	   if ($i > $totalpage) break;  // ������ �������� ��������� ������
	   echo ("<a href=show.php?board=$board&cblock=$cblock&cpage=$i class='mbx'>$i</a>");
	   $i = $i + 1;
	endwhile;

	// ���� ����� ���� �������� ��ü ������ ������ ������ [�������] ��ư Ȱ��ȭ
	if ($nstartpage <= $totalpage)
		echo ("<a href=show.php?board=$board&cblock=$nblock&cpage=$nstartpage class='mbx'>����</a> ");

	echo ("</td></tr></table>");
}

mysql_close($con);

?>


</td></tr>
</table>
<? include ("bottom.html");   ?>
