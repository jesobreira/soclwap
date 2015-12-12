<?php
function index() {
  global $timeformat,$home;
  if(is_logged()) {
    $output = '<p><form method="post" action="'.$home.'shoutbox/escrevepost">
<textarea rows="8" cols="25" name="message"></textarea><br/>
<input type="submit" value="'.t("Enviar").'">
</form></p><hr size="1">';
  }
  $qry = mysql_query("SELECT s.id AS d, s.text AS t, s.time AS i, a.login AS l FROM shoutbox s LEFT JOIN accounts a ON s.owner=a.id ORDER BY s.id DESC LIMIT 10");
  if(mysql_numrows($qry)!=0) {
    $response = true;
    while($row = mysql_fetch_array($qry)) {
      $output .= '<p><h3>'.$row['t'].'</h3><br/><h6>'.t("postado por").' '.url("user/profile/$row[l]", $row['l']).' '.t("em").' '.date($timeformat, $row['i']);
      if(is_admin()) {
        $output .= '<br>'.url("shoutbox/del/$row[d]", t("[excluir]"));
      }
      $output .= '</p><hr size="1">';
    }
  } else {
    $output .= infobox(t("Não há mensagens na shoutbox."), false);
  }
  if($response) {
    section(substr($output, 0, -13), t("Shoutbox"));
  } else {
    section($output, t("Shoutbox"));
  }
}

function escrevepost() {
  requirelogin();
  $owner = $_SESSION['id'];
  $text = protect($_POST['message']);
  $time = time();
  mysql_query("INSERT INTO shoutbox (`owner`, `text`, `time`) VALUES ('$owner', '$text', '$time')");
  redir("shoutbox");
}

function del($id) {
  onlyadmin();
  $id = protect($id);
  mysql_query("DELETE FROM shoutbox WHERE `id`='$id'");
  redir("shoutbox");
}