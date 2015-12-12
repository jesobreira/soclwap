<?php
function index() {
  global $dateformat;
  requirelogin();
  $id = $_SESSION['id'];
  $output = null;
  $qry = mysql_query("SELECT `id`,`from`,`content`,`hidden`,`data` FROM messages WHERE `to`='$id' ORDER BY id DESC LIMIT 50");
  if(mysql_numrows($qry)==0) {
    $output = 'Nenhuma mensagem!';
  } else {
    while($row = mysql_fetch_array($qry)) {
      $from = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE id='$row[from]'"));
      $output .= "\n".'<p class="row">'.t("De").': '.url("user/profile/$from[login]", $from['login']).'<br/>';
      if($row['hidden']=='s') {
        $output .= '<i>'.t("[esta é uma mensagem privada]").'</i><br>';
      }
      $output .= '<blockquote>
        '.bbcode($row['content']).'
        </blockquote>
        <hr size="1"><i>'.date($dateformat, $row['data']).'</i>
        '.url("message/msgdelete/$row[id]", t("[excluir]")).' '.
          url("message/send/$from[login]", t("[responder]")).'
      </p>';
    }
  }
  section($output, t("Minhas mensagens"));
}

function send($user) {
  global $home;
  include("libs/accounts.php");
  requirelogin();
  $usr = resolveuser($user);
  $user = protect($user);
  $output = '<form action="'.$home.'message/sendpost" method="post">
<input type="hidden" name="to" value="'.$usr.'">
<p><textarea rows="8" cols="25" name="content"></textarea></p>
<p><input type="checkbox" name="hidden">'.t("Esta é uma mensagem privada").'</p>
<p><input type="submit" value="'.t("Enviar mensagem").'"></p>
</form>';
  section($output, t("Enviar mensagem para").' '.$user);
}

function sendpost() {
  $_POST = array_map('protect', $_POST);
  requirelogin();
  $from = $_SESSION['id'];
  $to = $_POST['to'];
  if($_POST['hidden']) {
    $hidden = 's';
  } else {
    $hidden = 'n';
  }
  $content = $_POST['content'];
  $data = time();
  mysql_query("INSERT INTO messages (`from`, `to`, `content`, `hidden`, `data`)
               VALUES ('$from', '$to', '$content', '$hidden', '$data');");
  infobox(t("Mensagem enviada com sucesso!"));
}

function msgdelete($id) {
  requirelogin();
  $account = $_SESSION['id'];
  $id = mysql_real_escape_string($id);

  mysql_query("DELETE FROM messages WHERE `id`='$id' AND `to`='$account'");

  infobox(t("Mensagem excluída com sucesso."));
}

function lista($user) {
  global $dateformat;
  $user  = protect($user);
  requirelogin();
  $title = "Mensagens de $user";
  include("libs/accounts.php");
  // listar todas as mensagens de $user onde hidden = 'n' (para outro user ver)
  $output = menu($user).url("message/send/$user", "[enviar mensagem]")."<br>\n";
  $usr = resolveuser($user);
  $qry = mysql_query("SELECT `from`,`content`,`data` FROM messages WHERE `to`='$usr' AND `hidden`='n' ORDER BY id DESC LIMIT 30");
  if(mysql_numrows($qry)==0) {
    $output .= 'Nenhuma mensagem!';
  } else {
    while($row = mysql_fetch_array($qry)) {
      $user = mysql_query("SELECT login,foto FROM accounts WHERE id='$row[from]'");
      $user = mysql_fetch_array($user);
      $output .= '<p class="row">'.t("De").': '.url("user/profile/$user[login]", $user['login']).'<br/>';
      $output .= '<blockquote>
                 '.bbcode($row['content']).'
                  </blockquote>
                  <hr size="1"><i>'.date($dateformat, $row['data']).'</i>
                  </p>';
    }
  }
  section($output, $title);
}