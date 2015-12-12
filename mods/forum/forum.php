<?php
function index() { // show categorias
  $output = null;
  $qry = mysql_query("SELECT * FROM forum_categorias");
  if(mysql_numrows($qry)==0) {
    infobox(t("O fórum ainda não foi configurado pelo administrador."), true, true);
  }
  while($row = mysql_fetch_array($qry)) {
    $output .= "\n<div class=\"row\"><p>".url("forum/topics/$row[id]", $row['title']).'<br>
                <i>'.bbcode($row['desc']).'</i></p></div>';
  }
  section($output, t("Fórum"));
}

function topics($cat) { // show $cat's topics
  $cat = protect($cat);
  $output = url("forum/newtopic/$cat", t("[criar tópico]"))."<br>\n";
  $qry = mysql_query("SELECT * FROM forum_topics WHERE `cat`='$cat' ORDER BY id DESC LIMIT 100");
  if(mysql_num_rows($qry)!=0) {
    while($row = mysql_fetch_array($qry)) {
      $usr = mysql_fetch_array(mysql_query("SELECT login FROM accounts WHERE `id`='$row[owner]'"));
      $output .= "\n".'<p class="row">'.url("forum/view/$row[id]", '<h3>'.$row['title'].'</h3>').'<br/>
                        '.t("postado por").' '.url("user/profile/$usr[login]", $usr['login']).'</p><br/>';
    }
  } else {
    $output .= infobox(t("Nenhum tópico."), false, false);
  }
  section($output, t("Fórum"));
}

function view($id) { // show a topic
  global $home;
  $output = null;
  $id = protect($id);
  $topic = mysql_fetch_array(mysql_query("SELECT * FROM forum_topics WHERE `id`='$id'"));
  $user =  mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE `id`='$topic[owner]'"));
  $output .= '<h3>'.$topic['title'].'</h3>
              <div class="row">
                <p>'.nl2br(bbcode($topic['text'])).'</p>
                '.t("postado por").' '.url("user/profile/$user[login]", $user['login']).'
              </div>';
  if(is_logged()) {
    $output .= '<p><form method="post" action="'.$home.'forum/resppost">
                  <input type="hidden" name="topic" value="'.$id.'">
                  <p><label for="text">Sua resposta:</label><br/>
                    <textarea rows="6" cols="25" name="text" id="text"></textarea></p>
                  <p><input type="submit" value="'.t("Postar resposta").'"></p>
                </form></p>';
  }
  if(is_admin()) {
    $output .= '<p>'.url("forum/removetopic/$id", t("[remover]")).'</p>';
  }

  $qry = mysql_query("SELECT * FROM forum_respostas WHERE `topic`='$id' ORDER BY id LIMIT 500");
  while($row = mysql_fetch_array($qry)) {
    $usr = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE `id`='$row[owner]'"));
    $output .= '<div class="row">
                <p>'.nl2br(bbcode($row['text'])).'</p>
                <p>'.url("user/profile/$usr[login]", t("postado por").' '.$usr['login']).'</p>';
    if(is_admin($_SESSION['id'])) {
      $output .= '<p>'.url("forum/respdel/$row[id]", t("[remover]")).'</p>';
    }
    $output .= '</div><br/>';
  }

  section($output, t("Fórum"));
}

function newtopic($cat) { // create topic in $cat
  global $home;
  requirelogin();
  $cat = protect($cat);
  section('<form method="post" action="'.$home.'forum/newtopicpost">
<p><label for="title">'.t("Título").'</label><br/>
<input type="text" id="title" name="title"></p>
<p><label for="text">'.t("Texto").'</label><br/>
<textarea rows="8" cols="25" name="text"></textarea></p>
<input type="hidden" name="cat" value="'.$cat.'">
<p><input type="submit" value="'.t("Postar tópico").'"></p>
</form>', t("Postar tópico"));
  
}

function newtopicpost() {
  requirelogin();
  $_POST = array_map('protect', $_POST);
  $cat = $_POST['cat'];
  $owner = $_SESSION['id'];
  $title = $_POST['title'];
  $text = $_POST['text'];

  mysql_query("INSERT INTO forum_topics (`cat`, `owner`, `title`, `text`)
               VALUES ('$cat', '$owner', '$title', '$text');");
  redir("forum/topics/$cat");
}

function resppost() { // post a response
  requirelogin();
  $topic = protect($_POST['topic']);
  $owner = $_SESSION['id'];
  $text = protect($_POST['text']);

  mysql_query("INSERT INTO forum_respostas (`topic`, `owner`, `text`) VALUES ('$topic', '$owner', '$text');");
  redir("forum/view/$topic");
}

  ///////////
 // ADMIN //
///////////

function admin() {
  global $home;
  onlyadmin();
  $output = '<form method="post" action="'.$home.'forum/createcatpost">
              <p><label for="title">'.t("Título").'</label><br/>
                <input type="text" name="title"></p>
              <p><label for="desc">'.t("Descrição").'</label><br/>
                <textarea rows="4" cols="25" name="desc"></textarea></p>
              <p><input type="submit" value="Criar categoria"></p>
             </form>';
  $output .= '<hr size="1">';
  $qry = mysql_query("SELECT * FROM forum_categorias");
  if(mysql_numrows($qry)==0) {
    $output .= infobox(t("Você ainda não criou categorias."), false, false);
  } else {
    while($row = mysql_fetch_array($qry)) {
      $output .= "\n<div class=\"row\"><p>".url("forum/topics/$row[id]", $row['title']).'<br>
                  <i>'.bbcode($row['desc']).'</i><hr size="1">
                  '.url("forum/removecat/$row[id]", t("[remover]")).'
                  </p></div>';
    }
  }
  section($output, t("Administração do fórum"));
}

function createcatpost() {
  onlyadmin();
  $_POST = array_map('protect', $_POST);
  $title = $_POST['title'];
  $desc = $_POST['desc'];
  
  mysql_query("INSERT INTO forum_categorias (`title`, `desc`) VALUES ('$title', '$desc');");
  redir("forum/admin");
}

function removecat($id) {
  onlyadmin();
  $id = protect($id);
  $qry = mysql_query("SELECT id FROM forum_topics WHERE cat='$id'");
  if(mysql_num_rows($qry)!=0) {
    while($row = mysql_fetch_array($qry)) {
      mysql_query("DELETE FROM forum_respostas WHERE `topic`='$row[id]'");
    }
  }
  mysql_query("DELETE FROM forum_topics WHERE cat='$id'");
  mysql_query("DELETE FROM forum_categorias WHERE id='$id'");
  redir("forum/admin");
}

function removetopic($id) {
  onlyadmin();
  $id = protect($id);
  mysql_query("DELETE FROM forum_topics WHERE `id`='$id'");
  mysql_query("DELETE FROM forum_respostas WHERE `topic`='$id'");
  redir("forum");
}

function respdel($id) {
  onlyadmin();
  $id = protect($id);
  $qry = mysql_fetch_array(mysql_query("SELECT * FROM forum_respostas WHERE `id`='$id'"));
  $goto = $qry['topic'];
  mysql_query("DELETE FROM forum_respostas WHERE `id`='$id'");
  redir("forum/view/$goto");
}