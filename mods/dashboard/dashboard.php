<?php
function index() {
  global $home;
  requirelogin();
  freesection('<script language="javascript">
        function maxLength(textAreaField, limit) {
                var ta = document.getElementById(textAreaField);
                if (ta.value.length >= limit) {
                        ta.value = ta.value.substring(0, limit-1);
                }
        }
 </script>');
  // mostrar formulário
  $output = '<form method="post" action="'.$home.'dashboard/post">
                <textarea rows="5" cols="25" name="content" id="content" placeholder="'.t("O que está em sua mente?").'" onKeyDown="maxLength(\'content\', 140);" onKeyUp="maxLength(\'content\'. 140);" maxlength="140" /></textarea>
                <br/>
                <input type="submit" value="'.t("Postar").'">
              </form>';
  section($output, t("Postar atualização"));
  // receber atualizações
  $output = null;
  $me = $_SESSION['id'];
  $receive = array(); // id's a receber
  $receive[] = $me;
  $friends = mysql_query("SELECT `id1` FROM friends WHERE `id2`='$me'");
  if(mysql_numrows($friends)!=0) {
    while($f = mysql_fetch_array($friends)) {
      $receive[] = $f['id1'];
    }
  }
  $receive = implode(",", $receive);
  $qry = mysql_query("SELECT a.login AS login,n.content AS content,n.account AS id,n.id AS fid FROM notes n LEFT JOIN accounts a ON n.account=a.id WHERE n.account IN ($receive) ORDER BY n.id DESC LIMIT 50");
  if(mysql_numrows($qry)<1) {
    $output .= infobox(t("Você não possui atualizações."), false);
  } else {
    while($row = mysql_fetch_array($qry)) {
      //$output .= "\n".'<p><div class="row">'.url("user/profile/".$row['login'], $row['login']).' '.bbcode($row['content']);
      $output .= "\n".'<p><div class="row"><a href="'.$home.'/user/profile/'.$row['login'].'" title="note_'.$row['fid'].'" id="note_'.$row['fid'].'">'.$row['login'].'</a> '.bbcode($row['content']);
      if($row['id']===$_SESSION['id'] OR is_admin()) {
        $output .= '<br>'.url("dashboard/remove/$row[fid]", t("[remover]"));
      }
      $output .= '<a href="javascript:void(0);" onClick="javascript:document.getElementById(\'com'.$row['fid'].'\').style.display=\'block\'">'.t("[comentar]").'</a>';
      $output .= '<div id="com'.$row['fid'].'" style="display:none;">
      					<form action="'.$home.'/dashboard/commentpost" method="post" onReset="javascript:document.getElementById(\'com'.$row['fid'].'\').style.display=\'none\'">
      					<textarea rows="2" cols="25" name="text"></textarea>
      					<input type="hidden" name="stream" value="'.$row['fid'].'"><br>
      					<input type="submit" value="'.t("Comentar").'"><input type="reset" value="'.t("Cancelar").'">
      					</form>
      				</div>';
      $commentsqry = mysql_query("SELECT a.login,c.text FROM comments c LEFT JOIN accounts a ON a.id=c.owner WHERE c.id_recebe='$row[fid]' ORDER BY c.id DESC LIMIT 100");
      if(mysql_numrows($commentsqry)!=0) {
      	while($rw = mysql_fetch_array($commentsqry)) {
      		$output .= '<p><a href="'.$home.'/user/profile/'.$rw['login'].'">'.$rw['login'].':</a> '.$rw['text'].'</p>';
      	}
      }
      $output .= '</div></p>';
    }
  }
  section($output, t("Atualizações"));
}

function post() {
  requirelogin();
  $account = $_SESSION['id'];
  $content = protect($_POST['content']);

  mysql_query("INSERT INTO notes VALUES ('', '$account', '$content')");
  redir("dashboard");
}

function remove($fid) {
  requirelogin();
  $id = protect($fid);
  if(is_admin()) {
    mysql_query("DELETE FROM notes WHERE `id`='$id'");
  } else {
    $account = $_SESSION['id'];
    mysql_query("DELETE FROM notes WHERE `account`='$account' AND `id`='$id'");
  }
  redir("dashboard");
}

function commentpost() {
	requirelogin();
	$_POST = array_map('protect', $_POST);
	$id_recebe = is_numeric($_POST['stream']) ? $_POST['stream'] : die();
	$owner = $_SESSION['id'];
	$text = $_POST['text'];
	mysql_query("INSERT INTO comments VALUES ('', '$id_recebe', '$owner', '$text');");
	redir("dashboard#note_$id_recebe");
}