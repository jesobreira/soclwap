<?php
@header("Content-type: text/xml");
function view($id) {
  global $site_id,$site,$url,$home;
  $id = protect($id); // não requer login (ou softwares não funcionarão)
  // id = md5 ( user_id . site_id )
  $qry = mysql_query("SELECT * FROM accounts");
  while($row = mysql_fetch_array($qry)) {
    if(md5($row['id'].$site_id)===$id) {
      $user = $row['id'];
      $usr_login = $row['login'];
      //break;
    }
  }
  if($user) {
    echo '<?xml version="1.0"?>
<rss version="2.0">
  <channel>
    <title>'.$site['site_name'].'</title>
    <link>'.$url.'</link>
    <description>'.t("Notificações de").' '.$usr_login.'</description>
    ';
    $friends = mysql_query("SELECT `id1` FROM friends WHERE `id2`='$user'");
    if(mysql_numrows($friends)!=0) {
      while($f = mysql_fetch_array($friends)) {
        $receive[] = $f['id1'];
      }
    }
    if(sizeof($receive)!=0) {
      $receive = implode(",", $receive);
      $qry = mysql_query("SELECT a.login AS login, n.content AS content, n.account AS id, n.id AS fid FROM notes n LEFT JOIN accounts a ON n.account=a.id WHERE n.account IN ($receive) ORDER BY n.id DESC LIMIT 30");
      if(mysql_numrows($qry)!=0) {
        while($row = mysql_fetch_array($qry)) {
          echo '<item>
                <title>'.$row['login'].'</title>
                <link>'.$home.'user/profile/'.$row['login'].'</link>
                <description>'.$row['content'].'</description>
                </item>';
        }
      }
    }
  echo '</channel>
</rss>';
  }
  die(); // para não exibir front-end
}