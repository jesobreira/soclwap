<?php
function index() {
  requirelogin();
  $output = null;
  $qry = mysql_query("SELECT * FROM chat_rooms");
  if(mysql_numrows($qry)==0) {
    infobox(t("O chat ainda não foi configurado pelo administrador."), true, true);
  }
  while($row = mysql_fetch_array($qry)) {
    $output .= url("chat/sala/$row[id]", $row['nome']).'<br>';
  }
  section($output, t("Chat"));
}

function sala($room) {
  global $home;
  requirelogin();
  $room = protect($room);
  $qry = mysql_query("SELECT * FROM chat WHERE `room`='$room' ORDER BY id DESC LIMIT 10");
  if(mysql_numrows($qry)==0) {
    $chat = t("Nenhuma mensagem.");
  } else {
  $chat = null;
    while($row = mysql_fetch_array($qry)) {
      $usr = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE `id`='$row[owner]'"));
      $usr = $usr['login'];
      $chat .= '<p>'.url("user/profile/$usr", $usr).': '.bbcode($row['text']).'</p>';
    }
  }
  section('<meta http-equiv="REFRESH" content="10;url='.$home.'/chat/sala/'.$room.'">
            <form method="post" action="'.$home.'chat/falar">
            <input type="hidden" name="sala" value="'.$room.'">
            <input type="text" name="text">
            <input type="submit" value="'.t("Falar").'">
            </form><hr size="1">
            <div class="row">
            '.$chat.'
            </div>', t("Chat"));
}

function falar() {
  requirelogin();
  $room = protect($_POST['sala']);
  $text = protect($_POST['text']);
  $owner = $_SESSION['id'];
  mysql_query("INSERT INTO chat (`owner`, `room`, `text`) VALUES ('$owner', '$room', '$text');");
  redir("chat/sala/$room");
}

  ///////////
 // ADMIN //
///////////

function admin() {
  global $home;
  onlyadmin();
  section('<form method="post" action="'.$home.'chat/createroompost">
            <p><label for="nome">'.t('Nome da sala').':</label><br/>
              <input type="text" name="nome"></p>
            <p><input type="submit" value="'.t("Criar sala").'">
           </form>', t("Criar uma nova sala"));
  $output = null;
  $qry = mysql_query("SELECT * FROM chat_rooms");
  if(mysql_numrows($qry)==0) {
    $output .= infobox(t("Você não configurou o chat."), false, false);
  } else {
    while($row = mysql_fetch_array($qry)) {
      $output .= url("chat/sala/$row[id]", $row['nome']).' - '.url("chat/deleteroom/$row[id]", t("[remover]")).'
      <br>';
    }
  }
  section($output, t("Chat"));
}

function createroompost() {
  onlyadmin();
  $nome = protect($_POST['nome']);
  mysql_query("INSERT INTO chat_rooms VALUES ('', '$nome');");
  redir("chat/admin");
}

function deleteroom($id) {
  onlyadmin();
  $id = protect($id);
  mysql_query("DELETE FROM chat_rooms WHERE `id`='$id'");
  mysql_query("DELETE FROM chat WHERE `room`='$id'");
  redir("chat/admin");
}