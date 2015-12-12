<?php
onlyadmin();
ignore_user_abort(true);
settitle("Administração");
function index() {
  global $version,$url,$admin_email;
  $output = '<b>Versão SoclWAP:</b> '.$version.'<hr>
<a href="msnim:add?contact=soclwap@live.com">Adicione o SoclWAP no MSN</a> - 
<a href="mailto:soclwap@live.com">Envie um e-mail para nós</a> (soclwap@live.com)<br>
<b>Novidades do <a href="http://sourceforge.net/p/soclwap/blog/" target="_blank">blog do SoclWAP</a>.<br>
<iframe src="http://soclwap.com.nu/rss/?url='.urlencode($url).'&admin_email='.urlencode($admin_email).'&version='.urlencode($version).'" frameborder="0">
<a href="http://sourceforge.net/p/soclwap/blog/">Blog SoclWAP</a></iframe>';
  section($output, "SoclWAP");
  $output = url("admin/site", t("Configurações do site")).'<br>'.
            url("admin/tpl", t("Aparência")).'<br>'.
            url("admin/translate", t("Traduzir")).'<br>'.
            url("admin/members", t("Membros e privilégios")).'<br>'.
            url("admin/menu", t("Menu")).'<br>'.
            url("admin/chat", t("Chat")).'<br>'.
            url("admin/forum", t("Fórum")).'<br>'.
            url("admin/mods", t("Módulos")).'<br>';
  section($output, t("Administração"));
}

function site() {
  global $home,$site;
  $output .= '<form method="post" enctype="multipart/form-data" action="'.$home.'admin/sitepost">
<p><label for="site_logo">'.t("Logomarca").'</label><br/>
  <img src="'.$site['site_logo'].'" width="180"><br/>
  <input type="file" name="site_logo" id="site_logo"></p>
<p><label for="site_name">'.t("Nome do site").'</label><br/>
  <input type="text" name="site_name" id="site_name" value="'.$site['site_name'].'"></p>
<fieldset>
<legend>'.t("Campo especial").'</legend>
'.t('Este é um campo que diferencia seu website dos outros, que também utilizam SoclWAP. É um ítem (pergunta) que aparecerá nos perfis dos usuários.').'<br>
<input type="text" name="campo" value="'.$site['campo'].'">
</fieldset>
<p><label for="idade_min">'.t("Idade mínima para registrar-se").'</label><br/>
<input type="text" name="idade_min" id="idade_min" value="'.$site['idade_min'].'"></p>
<p><input type="submit" value="'.t("Salvar").'"></p>';
  section($output, t("Configurações do site"));
}

function sitepost() {
  global $url;
  $_POST = array_map('protect', $_POST);
  $site_name = $_POST['site_name'];
  $campo = is_null($_POST['campo']) ? '-' : $_POST['campo'];
  $idade_min = $_POST['idade_min'];
  if(!is_numeric($idade_min)) {
    infobox(t("O campo Idade mínima pode conter apenas números."), true, true);
  }
  mysql_query("UPDATE cfg_site SET `site_name`='$site_name', `campo`='$campo', `idade_min`='$idade_min'");
  $site_logo = imageupload($_FILES['site_logo']);
  if($site_logo) {
    $site_logo = $url.'/upload/'.$site_logo['full'];
    mysql_query("UPDATE cfg_site SET `site_logo`='$site_logo'");
  }

  infobox(t("Configurações atualizadas com sucesso."));
}

function tpl() {
  global $path,$url;

  $qry = mysql_fetch_array(mysql_query("SELECT * FROM cfg_tpl WHERE `selected`='s'"));
  $atual = $qry['name'];
  $output .= t("Seu tema atual é").': <a href="#'.$atual.'">'.$atual.'</a>';
  $files = glob($path.'/tpl/*');
  $files = array_map('basename', $files);
  foreach($files as $tpl) {
      $output .= '<div class="row"><p>
                    <a title="'.$tpl.'"><img src="'.$url.'/tpl/'.$tpl.'/preview.png" width="140" style="border: 1px solid;"></a>
                    <br>'.url("admin/ativatpl/$tpl", $tpl).'
                  </p></div>';
  }
  
  section($output, t("Administrar temas"));
}

function ativatpl($tpl) {
  $tpl = protect($tpl);
  if(file_exists("tpl/$tpl/page.tpl.php")) {
    mysql_query("DELETE FROM cfg_tpl");
    mysql_query("INSERT INTO cfg_tpl (`name`, `selected`) VALUES ('$tpl', 's');");
    infobox(t("Tema selecionado."));
  } else {
    infobox(t("Erro: tema inválido."));
  }
}

/*function translate() {
  global $home;
  $qry = mysql_query("SELECT * FROM cfg_translation");
  if(mysql_numrows($qry)==0) {
    $tlt[] = t('Nenhum registro.');
  } else {
    while($row = mysql_fetch_array($qry)) {
      $tlt[] = $row['original'].'|'.$row['mostrar'];
    }
  }
  $tlt = implode("\n", $tlt);
  section('<form method="post" action="'.$home.'admin/translatepost">
  <p><i>'.t("Texto original (não alterar)").'</i><b>|</b><i>'.t("Texto modificado").'</i></p>
  <textarea name="tlt" rows="10" cols="25">'.$tlt.'</textarea><br/>
  <input type="submit" value="'.t("Gravar").'"></form>', t("Administrar textos"));
}

function translatepost() {
  $tlt = protect($_POST['tlt']);
  mysql_query("DELETE * FROM cfg_translation");
  $tlts = explode("\n", $tlt);
  $i = 0;
  $j = count($tlts);
  while($i<=$j) {
    $there = explode("|", $tlts[$i]);
    $original = $there[0];
    $mostrar = $there[1];
    mysql_query("INSERT INTO cfg_translation (`original`, `mostrar`) VALUES ('$original', '$mostrar');");
    $i++;
  }
  infobox(t("Gravado com sucesso."));
}*/

function translate() {
  global $home;
  $qry = mysql_query("SELECT * FROM cfg_translation ORDER BY original");
  while($row = mysql_fetch_array($qry)) {
    $form .= '<p><label for="t'.$row['id'].'">'.$row['original'].'</label><br/>
              <input type="text" name="t'.$row['id'].'" id="t'.$row['id'].'" value="'.$row['mostrar'].'"></p><hr size="1">';
  }
  section('<form method="post" action="'.$home.'admin/translatepost">
<p><input type="submit" value="'.t("Gravar").'"></p>
'.substr($form, 0, -13).'
<p><input type="submit" value="'.t("Gravar").'"></p>
</form>', t("Administrar textos"));
}

function translatepost() {
  $_POST = array_map('protect', $_POST);
  $lst = mysql_fetch_array(mysql_query("SELECT id FROM cfg_translation ORDER BY id DESC LIMIT 1"));
  $j = $lst['id'];
  $i = 0;
  while($i<=$j) {
    if(isset($_POST['t'.$i])) {
      $mostrar = $_POST['t'.$i];
      mysql_query("UPDATE cfg_translation SET `mostrar`='$mostrar' WHERE `id`='$i'");
    }
    $i++;
  }
  infobox(t("Operação realizada com sucesso."));
}

function members() {
  $qry = mysql_query("SELECT * FROM accounts ORDER BY id DESC");
  freesection(titlebar(t("Administração de usuários")));
  infobox(mysql_numrows($qry).' '.t("membros registrados."));
  $output = null;
  while($row = mysql_fetch_array($qry)) {
    $output .= '<p class="row">'.url("user/profile/$row[login]", $row['login']).' - ';
    if($row['admin']=='s') {
      $output .= url("admin/unsetadmin/$row[login]", t("[remover privilégios]")).' - ';
    } else {
      $output .= url("admin/setadmin/$row[login]", t("[conceder privilégios]")).' - ';
    }
    if($row['senha']==='BANNED') {
      $output .= url("admin/unkick/$row[login]", t("[desbanir]"));
    } else {
      $output .= url("admin/kick/$row[login]", t("[banir]"));
    }
    $output .= '</p>';
  }
  freesection($output);
}

function kick($member) { // banir
  $member = resolveuser($member);
  $qry = mysql_query("SELECT * FROM accounts WHERE `id`='$member'");
  $qry = mysql_fetch_array($qry);
  mysql_query("INSERT INTO banneds VALUES ('', '$member', '$qry[login]', '$qry[senha]');");
  mysql_query("UPDATE accounts SET `senha`='BANNED' WHERE `id`='$member'");
  infobox(t("Membro banido."));
}

function unkick($member) { // desbanir
  $user = resolveuser($member);
  $qry = mysql_fetch_array(mysql_query("SELECT * FROM banneds WHERE `account`='$user'"));
  mysql_query("UPDATE accounts SET `senha`='$qry[senha]' WHERE `id`='$user'");
  mysql_query("DELETE FROM banneds WHERE `account`='$user'");
  infobox(t("O membro já pode voltar a acessar sua conta."));
}

function setadmin($member) { // deixa alguem como admin
  $member = resolveuser($member);
  mysql_query("UPDATE accounts SET `admin`='s' WHERE `id`='$member'");
  infobox(t("Esta pessoa agora possui direitos administrativos."));
}

function unsetadmin($member) { // tira alguem de admin
  $member = resolveuser($member);
  mysql_query("UPDATE accounts SET `admin`='n' WHERE `id`='$member'");
  infobox(t("Esta pessoa não possui mais direitos administrativos."));
}

/* function menu() {
  global $home;
  $qry = mysql_query("SELECT * FROM cfg_menu ORDER BY item");
  $output = null;
  $menu = array();
  if(mysql_numrows($qry)!=0) {
    while($row = mysql_fetch_array($qry)) {
      $menu[] = $row['item'].'|'.$row['url'];
    }
  } else {
    $menu[] = t("Nenhuma entrada.");
  }
  $menu = implode("\n", $menu);
  $output = '<i>'.t("Nome da entrada").'<b>|</b>'.t("URL de destino").'<br>
  <form method="post" action="'.$home.'admin/menupost"><textarea name="menu" rows="8" cols="25">'.$menu.'</textarea><br/>
  <input type="submit" value="'.t("Gravar").'"></form>';
  section($output, t("Administrar menu"));
} */
function menu() {
  global $home;
  $output = url("admin/menuadd", t("[adicionar ítem]"));
  $qry = mysql_query("SELECT * FROM cfg_menu ORDER BY `order`");
  if(mysql_numrows($qry)!=0) {
    $output .= '<form method="post" action="'.$home.'admin/menupost">';
    while($row = mysql_fetch_array($qry)) {
      $output .= '<div class="row"><p>
                                    <p><label for="i'.$row['id'].'">Ítem</label><br/>
                                    <input type="text" id="i'.$row['id'].'" name="i'.$row['id'].'" value="'.$row['item'].'"></p>
                                    <p><label for="u'.$row['id'].'">Destino</label><br/>
                                    <input type="text" id="u'.$row['id'].'" name="u'.$row['id'].'" value="'.$row['url'].'"></p>
                                    <p><label for="o'.$row['id'].'">Ordem</label><br/>
                                    <input type="text" id="o'.$row['id'].'" name="o'.$row['id'].'" value="'.$row['order'].'"></p>
                                    <p>'.url("admin/removeitem/$row[id]", t("[remover este ítem]")).'</p>
                 </p></div><br/>';
    }
    $output .= '<input type="submit" value="'.t("Salvar").'">
              </form>';
  }
  section($output, t("Administrar menu"));
}

function menupost() {
  global $home;
  $maior = mysql_fetch_array(mysql_query("SELECT * FROM cfg_menu ORDER BY id DESC LIMIT 1"));
  $menor = mysql_fetch_array(mysql_query("SELECT * FROM cfg_menu ORDER BY id LIMIT 1"));
  $j = $maior['id'];
  $i = $menor['id'];
  
  while($i<=$j) {
    if(isset($_POST['i'.$i])) {
      $url = protect($_POST['u'.$i]);
      $item = protect($_POST['i'.$i]);
      $order = protect($_POST['o'.$i]);
      mysql_query("UPDATE cfg_menu SET `item`='$item', `url`='$url', `order`='$order' WHERE `id`='$i'");
    }
    $i++;
  }
  infobox(t("Menu atualizado."));
  
}

function menuadd() {
  global $home;
  section('<form method="post" action="'.$home.'admin/menuaddpost">
            <p><label for="item">Ítem</label><br/>
              <input type="text" name="item" id="item"></p>
            <p><label for="url">Destino</label><br/>
              <input type="text" name="url" id="url"></p>
            <p><label for="order">Ordem</label><br/>
              <input type="text" name="order" id="order"></p>
            <p><input type="submit" value="'.t("Adicionar").'"></p>
          </form>', t("Adicionar ítem do menu"));
}

function menuaddpost() {
  $_POST = array_map('protect', $_POST);
  $item = $_POST['item'];
  $url = $_POST['url'];
  $order = $_POST['order'];
  mysql_query("INSERT INTO cfg_menu (`item`, `url`, `order`) VALUES ('$item', '$url', '$order');");
  redir("admin/menu");
}

function removeitem($id) {
  $id = protect($id);
  mysql_query("DELETE FROM cfg_menu WHERE `id`='$id'");
  redir("admin/menu");
}

/*
function menupost() {
  mysql_query("DELETE FROM cfg_menu");
  $menu = protect($_POST['menu']);
  $items = explode("\n", $menu);
  $i = 0;
  $j = count($items);
  while($i<=$j) {
    $there = explode("|", $items[$i]);
    $item = $there[0];
    $url = $there[1];
    mysql_query("INSERT INTO cfg_menu VALUES ('', '$item', '$url');");
    $i++;
  }
  infobox(t("Salvo com sucesso."));
}
*/
function chat() {
  redir("chat/admin");
}

function forum() {
  redir("forum/admin");
}

function mods() {
  global $path,$url;

  $files = glob($path.'/mods/*');
  $files = array_map('basename', $files);
  foreach($files as $mod) {
      if(file_exists("mods/$mod/$mod.sys.php")) {
          include("mods/$mod/$mod.sys.php");
        } else {
          $app['name'] = $mod;
          $app['desc'] = null;
      }
      $output .= '<div class="row"><p>
                    <b>'.$app['name'].'</b><br>'.$app['desc'].'
                    <br>'.url("admin/mod/$mod/en", t("[instalar]")).' | '.url("admin/mod/$mod/dis", t("[desinstalar]")).'
                  </p></div>';
  }
  
  section($output, t("Administrar módulos"));
}

function mod($mod, $act) {  // $act = en/dis (enable/disable)
  if($act=='en') {
    // enable
    if(file_exists("mods/$mod/$mod.sys.php")) {
      include("mods/$mod/$mod.sys.php");
      if(function_exists($mod.'_install')) {
        eval($mod.'_install();');
      }
    }
  }
  elseif($act=='dis') {
    // disable
    if(file_exists("mods/$mod/$mod.sys.php")) {
      include("mods/$mod/$mod.sys.php");
      if(function_exists($mod.'_uninstall')) {
        eval($mod.'_uninstall();');
      }
    }
  }
  infobox(t("Operação realizada com sucesso."));
}
