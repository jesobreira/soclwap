<?php
function index() {
  requirelogin();
  global $home;
  section('<form method="post" action="'.$home.'search/post">
<input type="text" name="query" maxlength="16">
<p><input type="checkbox" name="usuarios" checked> '.t("Membros").'<br/>
<input type="checkbox" name="grupos"> '.t("Grupos").'</p>
<input type="submit" value="'.t("Buscar").'">
</form>', t("Busca"));
}

function post() {
  global $url;
  requirelogin();
  $me = $_SESSION['id'];
  $query = substr(protect($_POST['query']), 0, 16);
  if(strlen($query)<3) { # isso não é um coração...
    infobox(t("Termos de busca muito pequenos.", true, true));
  }
  if($_POST['usuarios']) {
    $qry = mysql_query("SELECT `foto`,`login` FROM accounts WHERE `login` LIKE '%$query%' OR `nome` LIKE '%$query%'");
    if(mysql_numrows($qry)==0) {
      $usuarios = t("Nenhum resultado!");
    } else {
      $usuarios = null;
      while($row = mysql_fetch_array($qry)) {
        $usuarios .= "\n".'<p><div class="row">
                        <img src="'.$url.'/upload/'.thumb($row['foto']).'"><br>
                        '.url("user/profile/$row[login]", $row['login']).'
                      </div></p>';
      }
    }
  section($usuarios, t("Buscando usuários."));
  }
  if($_POST['grupos']) {
    $qry = mysql_query("SELECT `title`,`url` FROM groups WHERE `title` LIKE '%$query%' OR `desc` LIKE '%$query%'");
    if(mysql_numrows($qry)==0) {
      $grupos = t("Nenhum resultado!");
    } else {
      $grupos = null;
      while($row = mysql_fetch_array($qry)) {
        $grupos .= "\n".'<p><div class="row">
                        '.url("groups/view/$row[url]", $row['title']).'
                      </div></p>';
      }
    }
  section($grupos, t("Buscando grupos."));
  }
}
?>