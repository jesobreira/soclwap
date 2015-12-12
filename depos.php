<?php
header("Content-type: text/html;charset=UTF-8");
?>
<html>
<head>
<style type="text/css">
body {
  overflow: hidden;
}
</style>
</head>
<body>
<marquee behavior="scroll" direction="up" onMouseOver="this.stop();" onMouseOut="this.start();">
<?php 
include("comunidade/inc/config.php");
mysql_connect($db['host'], $db['user'], $db['pass']);
mysql_selectdb($db['name']);

$qry = mysql_query("SELECT * FROM shoutbox ORDER BY RAND() LIMIT 50");
if(mysql_numrows($qry)==0) {
  echo 'Não há depoimentos, ainda.';
} else {
  $row = mysql_fetch_array($qry);
  $user = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE id='$row[owner]'"));
  $user_nome = explode(" ", $user['nome']);
  $user_nome = $user_nome[0];
  echo '<p><b>'.$row['text'].'</b>
          <br/><a href="comunidade/user/profile/'.$user['login'].'">'.$user_nome.'</a></p>';
}
?>
</marquee>
</body>
</html>