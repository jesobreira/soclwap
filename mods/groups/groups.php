<?php
include("mods/groups/funcs.php");
function index() {
  requirelogin();
  $qry = mysql_fetch_array(mysql_query("SELECT `login` FROM accounts WHERE `id`='$_SESSION[id]'"));
  $qry = $qry['login'];
  redir("groups/lista/$qry");
}

function view($group) {
  global $url,$home;
  requirelogin();
  $group = protect($group);
  $group = resolvegroup($group);
  $owner = mysql_query("SELECT `login` FROM accounts WHERE `id`='$group[owner]'");
  $owner = mysql_fetch_array($owner);
  $owner = $owner['login'];
  $output = '<h3>'.$group['title'].'</h3>
<p>'.bbcode($group['desc']).'<hr size="1">
<b>'.t("Criado por").'</b> '.url("user/profile/$owner", $owner).'</p>';
  section($output, t("Grupo"));
  $members = null;
  if(estounogrupo($group['id'])) {
    $members .= url("groups/participacao/$group[url]", t("[sair do grupo]")).'<br>';
  } else {
    $members .= url("groups/participacao/$group[url]", t("[participar]")).'<br>';
  }
  $qry = mysql_query("SELECT a.login AS l, a.foto AS f FROM groups_join g LEFT JOIN accounts a ON g.account=a.id WHERE g.group='$group[id]' LIMIT 100");
  if(mysql_numrows($qry)!=0) {
    while($row = mysql_fetch_array($qry)) {
      $members .= '<div class="row"><p>
                  '.url("user/profile/$row[l]", '<img src="'.$url.'/upload/'.thumb($row[f]).'">').'<br>
                  '.url("user/profile/$row[l]", $row[l]).'
                  </p></div>';
    }
  } else {
    $members .= t("Não há membros.");
  }
  section($members, t("Membros"));
  if(estounogrupo($group['id'])) {
    // show shoutbox 
    $output = '<form method="post" action="'.$home.'groups/writesbpost">
                <input type="hidden" name="group" value="'.$group['id'].'">
                <label for="content">Escrever</label><br/>
                <textarea name="content" id="content" rows="5" cols="25"></textarea>
                <br/><input type="submit" value="'.t("Enviar").'"></form><br/>';
    $qry = mysql_query("SELECT * FROM groups_shoutbox WHERE `id_group`='$group[id]' ORDER BY id DESC LIMIT 30");
    if(mysql_numrows($qry)==0) {
      $output .= infobox(t("Não há itens na shoutbox deste grupo."), false);
    } else {
      while($row = mysql_fetch_array($qry)) {
        $user = mysql_fetch_array(mysql_query("SELECT login FROM accounts WHERE `id`='$row[owner]'"));
        $output .= '<p>
                    '.url("user/profile/$user[login]", $user['login']).': '.bbcode($row['text']);
        if($group['owner']==$_SESSION['id'] OR $row['owner']==$_SESSION['id'] OR is_admin()) {
          $output .= '<br/>'.url("groups/remsb/$row[id]", t("[remover]"));
        }
        $output .= '</p><hr size="1">';
      }
    }
  section($output, t("Shoutbox do grupo"));
  }
}

function writesbpost() {
  requirelogin();
  $_POST = array_map('protect', $_POST);
  if(estounogrupo($_POST['group'])) {
    mysql_query("INSERT INTO groups_shoutbox (`id_group`, `owner`, `text`) VALUES ('$_POST[group]', '$_SESSION[id]', '$_POST[content]');");
  }
  freesection('<script> history.go(-1); </script>');
}

function remsb($id) { // remove ítem da shoutbox
  requirelogin();
  $id = protect($id);
  $qry = mysql_query("SELECT * FROM groups_shoutbox WHERE `id`='$id'");
  if(mysql_numrows($qry)==1) {
    $qry = mysql_fetch_array($qry);
    $group = mysql_fetch_array(mysql_query("SELECT * FROM groups WHERE `id`='$qry[id_group]'"));
    if($group['owner']==$_SESSION['id'] OR $qry['owner']==$_SESSION['id']) {
      mysql_query("DELETE FROM groups_shoutbox WHERE `id`='$id'");
    }
  }
  redir("groups/view/$group[url]");
}

function participacao($group) { // entrar e sair (if)
  requirelogin();
  $me = $_SESSION['id'];
  $group = resolvegroup($group);
  //$qry = mysql_query("SELECT * FROM groups_join WHERE `account`='$id' AND `group`='$group'");
  //if(mysql_numrows($qry)!=0) {
  if(!estounogrupo($group['id'])) {
    mysql_query("INSERT INTO groups_join (`account`, `group`) VALUES ('$me', '$group[id]');");
    note(t("participa agora de um novo grupo."), $_SESSION['id']);
  } else {
    mysql_query("DELETE FROM groups_join WHERE `account`='$me' AND `group`='$group[id]'");
  }
  infobox(t("Ação realizada com sucesso."));
}

function lista($user) {
  requirelogin();
  $user = protect($user);
  $usr = resolveuser($user);
  $output = null;
  $qry = mysql_query("SELECT g.url AS u, g.title AS t FROM groups g LEFT JOIN groups_join j ON g.id=j.account WHERE g.id='$_SESSION[id]'");
  if(mysql_numrows($qry)!=0) {
    while($row = mysql_fetch_array($qry)) { 
      $output .= "\n".url("groups/view/$row[u]", $row['t']).'<br>';
    }
  } else {
    if($_SESSION['id']===$usr) {
      $output .= infobox(t("Você ainda não está em nenhum grupo."));
    } else {
      $output .= infobox($user.' '.t("ainda não participa de nenhum grupo."));
    }
  }
  section($output, t("Grupos"));
}

function create() {
  global $home;
  requirelogin();
  section('<form method="post" action="'.$home.'groups/createpost">
<p><label for="title">Título:</label><br/>
<input type="text" name="title" id="title" required="required" placeholder="'.$home.'groups/view/nomedogrupo"></p>
<p><label for="desc">Descrição:</label><br/>
<textarea rows="8" cols="25" name="desc"></textarea></p>
<input type="submit" value="'.t("Criar grupo").'">
</form>');
}

function createpost() {
  requirelogin();
  $_POST = array_map('protect', $_POST);
  $owner = $_SESSION['id'];
  $title = $_POST['title'];
  $url = cleanstring($title);
  $desc = $_POST['desc'];
  $qry = mysql_query("SELECT `id` FROM groups WHERE `url`='$url'");
  if(mysql_numrows($qry)==1) {
    infobox(t("Um grupo com este nome já existe."), true, true);
  }
  mysql_query("INSERT INTO groups (`owner`, `title`, `url`, `desc`) VALUES ('$owner', '$title', '$url', '$desc');");
  $group_id = resolvegroup($url);
  mysql_query("INSERT INTO groups_join (`account`, `group`) VALUES ('$owner', '$group_id');");
  note(t("criou um grupo."), $_SESSION['id']);
  redir("groups/view/$url");
}