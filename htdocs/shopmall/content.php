<? include ("top.html"); ?>

<table border=0 width=900 align=center align=center>
<tr height=600>
<td width=180 valign=top style="border-right:1px solid black;"><? include ("left.html"); ?></td>
<td width=720 align=center valign=top>



<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result=mysql_query("select * from $board where id=$id",$con);

// �� �ʵ忡 �ش��ϴ� �����͸� �̾� ���� ����
$id=mysql_result($result,0,"id");
$writer=mysql_result($result,0,"writer");
$topic=mysql_result($result,0,"topic");
$hit=mysql_result($result,0,"hit");
$filename = mysql_result($result, $counter, "filename");
$filesize = mysql_result($result, $counter, "filesize");
if ($filesize > 1000) {
	$kb_filesize =   (int)($filesize / 1000);
	$disp_size = $kb_filesize . ' KBytes';
} else {
	$disp_size = $filesize . ' Bytes';
}

$hit = $hit +1;   //��ȸ���� �ϳ� ����
mysql_query("update $board set hit=$hit where id=$id",$con);

$wdate=mysql_result($result,0,"wdate");
$email=mysql_result($result,0,"email");
$content=mysql_result($result,0,"content");
$comment=mysql_result($result,0,"comment");

echo("
	<link rel='stylesheet' href='style.css'/>
");
// ���̺�κ��� ���� ������ ȭ�鿡 ���÷���
echo("
	<table border=0 width=700 align=center>
	<tr><td align=center><h1>�ۺ���</h1><hr></td></tr>
	</table>

	<table border=0 width=700 class='start' align=center>
	<tr class='main'>
	<td width=100>��ȣ: $id</td>
	<td width=200>�۾���: <a href=mailto:$email>$writer</a></td>
	<td width=300>�۾���¥: $wdate</td>
	<td width=100>��ȸ: $hit</td>
	</tr>
	<tr class='elsenhv'>
	<td colspan=4>����: $topic</td>
	</tr>");
	if ($filesize!=0){
		echo("
		<tr class='else'>
		<td colspan=4>÷������: <a href=./svfile/$filename>$filename</a> [$disp_size]</td>
		<tr>");
	}
	echo("
	<td colspan=4><pre>$content</pre></td>
	</tr>
	</table>

	<table   border=0 width=700 align=center>
	<tr><td align=center>
	<a href=pass.php?board=$board&id=$id&mode=0 class='mbx'>����</a>
	<a href=pass.php?board=$board&id=$id&mode=1 class='mbx'>����</a>
	<a href=reply.php?board=$board&id=$id class='mbx'>�亯</a>
	<a href=show.php?board=$board class='mbx'>����Ʈ</a>
	</td></tr>
	</table>
	");
	echo("
	</br>
	<table   border=0 width=700 align=center>
	<tr><td align=left colspan=4><b>���</b></td></tr>
	<tr><td><form method=post action=cprocess.php?comment=$comment&board=$board&id=$id></td></tr>
	<tr><td width=190>�̸�: <input type=text name=wname size=15 readonly=readonly value=$UserName></t>
	��ȣ: <input type=password name=wpasswd size=15 readonly=readonly value=$UserID>
	</td>
	<td>
	<textarea name=wmemo rows=3 cols=58>��� ������ �Է��ϼ���</textarea>
	</td>
	<td>
	<input type=image src='https://www.flaticon.com/svg/static/icons/svg/833/833275.svg' width=30 height=30 value=submit align=center valign=center>
	</td>
	</tr>
	</table>
	");

	$result=mysql_query("select * from $comment order by num desc", $con);
	$total=mysql_num_rows($result);
	echo("<table border=0 width=700 class='start' align=center>");
	if ($total){
		echo ("
		<tr class='main'></td><td width=100>�̸�</td>
		<td width=100>����¥</td><td width=400>��۳���</td><td width=100> ���� / ����</tr>
		");
}
		$pagesize =   8;	// �� �������� ���� �� �޸� ���� ����

	if ($cpage ==  '') $cpage = 1;

	$endpage = (int)($total / $pagesize);

	if ( ($total % $pagesize) != 0 ) $endpage = $endpage + 1;

	$i = 0;

	while ( $i   < $pagesize ) :
		$counter = $pagesize * ($cpage - 1) + $i;
		if ($counter == $total) break;
		$num = mysql_result($result, $counter, "num");
		$name = mysql_result($result, $counter, "name");
		$wdate = mysql_result($result, $counter, "wdate");
		$message = mysql_result($result,   $counter, "message");

		echo ("
			<tr class='elsenhv'><td>$name</td>
			<td>$wdate</td><td>$message</td>
			<td><a href=cpass.php?board=$board&comment=$comment&num=$num&id=$id&mode=0 class='mbx'>����</a>
			<a href=cpass.php?board=$board&comment=$comment&num=$num&id=$id&mode=1 class='mbx'>����</a>
			</tr>
		");

		$i++;

	endwhile;

echo ("</table>");

echo ("<table border=0 width=700 align=center><tr><td align=center>");

$ppage =   $cpage - 1;
$npage =   $cpage + 1;

if ($cpage > 1) echo ("<a href=content.php?board=$board&id=$id&cpage=$ppage class='mbx'>�������</a>");

if ($cpage < $endpage) echo ("<a href=content.php?board=$board&id=$id&cpage=$npage class='mbx'>�������</a>");

echo("</table>");
echo("<br>");


$result = mysql_query("select * from $board order by id desc", $con);
$total = mysql_num_rows($result);

echo("
	<table border=0 width=700 class='start' align=center>
	<tr class='main'><td align=center width=50><b>��ȣ</b></td>
	<td align=center width=100><b>�۾���</b></td>
	<td align=center width=400><b>����</b></td>
	<td align=center width=150><b>��¥</b></td>
	<td align=center width=50><b>��ȸ</b></td>
	</tr>
");

if   ($icpage=='') $icpage=1;    // $cpage -  ���� ������ ��ȣ
	$ipagesize = 8;                // $pagesize - �� �������� ����� ��� ����

	$totalpage = (int)($total/$pagesize);
	if (($total%$pagesize)!=0) $totalpage = $totalpage + 1;

	$counter=0;

	while($counter<$pagesize):
		$newcounter=($icpage-1)*$pagesize+$counter;
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
			<tr class=else><td align=center>$id</td>
			<td align=center>$writer</td>
			<td align=left>$t<a href=content.php?board=$board&id=$id&icpage=$icpage>$topic</a>");
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


mysql_close($con);



?>


</td></tr>
</table>
<? include ("bottom.html");   ?>
