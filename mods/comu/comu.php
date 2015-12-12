<?php

function index() {
  section('Esta é uma área pública da comunidade SoclWAP que permite que os usuários
compartilhem seus módulos e temas.<br/>
  '.url("comu/themes", "Temas").'<br/>
  '.url("comu/modules", "Módulos"), "Comunidade"); 
}

function themes() {
  global $url;
  $output = '<p>'.url("comu/newtheme", "Novo tema").'</p>';
  $qry = mysql_query("SELECT * FROM comunidade WHERE tipo='t' ORDER BY id DESC");
  while($row = mysql_fetch_array($qry)) {
    $output .= '<p class="row">';
    $output .= url("comu/viewtheme/$row[id]", $row['nome']).'<br>';
    $output .= '<img src="'.$url.'/upload/'.thumb($row['imagem']).'" width="100">';
    $output .= '</p>';
  }
  section($output, "Temas");
}

function viewtheme($id) {
  global $home,$url;
  $id = is_numeric($id) ? $id : die();
  $qry = mysql_query("SELECT * FROM comunidade WHERE `tipo`='t' AND `id`='$id'");
  if(mysql_num_rows($qry)!=1) {
    die();
  }
  $qry = mysql_fetch_array($qry);
  $output .= $qry['descricao'].'<p><img src="'.$url.'/upload/'.$qry['imagem'].'"></p>
    <p><b>Enviado por:</b> '.url("user/profile/$qry[user]", $qry['user']).'<br/>
       <b><center><a href="'.$qry['link'].'">Download</a></center></b></p>';
  section($output, $qry['nome']);
}

function newtheme() {
  global $home;
  requirelogin();
  section('<form method="post" enctype="multipart/form-data" action="'.$home.'comu/newthemepost">
  <p><label for="nome">Nome do módulo</label><br/>
  <input type="text" name="nome" id="nome"></p>
  <p><label for="descricao">Descrição</label><br/>
  <textarea rows="8" cols="25" name="descricao" id="descricao"></textarea></p>
  <p><label for="imagem">Imagem de previsualização</label><br/>
  <input type="file" name="imagem" id="imagem"></p>
  <p><label for="link">Link de download</label><br/>
  <input type="text" name="link" id="link"></p>
  <p><input type="submit" value="Enviar"></p>', 'Novo módulo');
}

function newthemepost() {
  requirelogin();
  $_POST = array_map('protect', $_POST);
  $nome = $_POST['nome'];
  $descricao = nl2br($_POST['descricao']);
  $imagem = imageupload($_FILES['imagem']);
  $imagem = $imagem['full'];
  $link = $_POST['link'];
  if(!preg_match("/^(htt|ft)(p|ps):\/\/(.*)\.(zip|tar\.gz)$/", $link) AND !preg_match("/(rapidshare|masteruploading|easy-share|sourceforge|uploading|megaupload|share|upload)/", $link)) {
    infobox("Erro: O link de download apresentou erros.<br/>
             Ele deve ter as extensões \".zip\" ou \".tar.gz\" e estar nos seguintes protocolos:
             <br/>HTTP ou FTP, com ou sem SSL.<br/>
             <a href=\"#\" onClick=\"javascript:history.back();\">Voltar</a>", true, true);
  }
  $user = mysql_fetch_array(mysql_query("SELECT login FROM accounts WHERE `id`='$_SESSION[id]'"));
  $user = $user['login'];
  mysql_query("INSERT INTO comunidade VALUES ('', 't', '$nome', '$descricao', '$imagem', '$link', '$user')");
  redir("comu/themes");
}
/////////////////////////////////
function modules() {
  global $url;
  $output = '<p>'.url("comu/newmodule", "Novo módulo").'</p>';
  $qry = mysql_query("SELECT * FROM comunidade WHERE tipo='m' ORDER BY id DESC");
  while($row = mysql_fetch_array($qry)) {
    $output .= '<p class="row">';
    $output .= url("comu/viewtheme/$row[id]", $row['nome']);
    $output .= '<img src="'.$url.'/upload/'.thumb($row['imagem']).'" width="100">';
    $output .= '</p>';
  }
  section($output, 'Módulos');
}

function viewmodule($id) {
  global $home,$url;
  $id = is_numeric($id) ? $id : die();
  $qry = mysql_query("SELECT * FROM comunidade WHERE `tipo`='m' AND `id`='$id'");
  if(mysql_num_rows($qry)!=1) {
    die();
  }
  $qry = mysql_fetch_array($qry);
  $output .= $qry['descricao'].'<p><img src="'.$url.'/upload/'.$qry['imagem'].'"></p>
    <p><b>Enviado por:</b> '.url("user/profile/$user", $user).'<br/>
       <b><center><a href="'.$qry['link'].'">Download</a></center></b></p>';
  section($output, $qry['nome']);
}

function newmodule() {
  global $home;
  requirelogin();
  section('<form method="post" enctype="multipart/form-data" action="'.$home.'comu/newmodulepost">
  <p><label for="nome">Nome do tema</label><br/>
  <input type="text" name="nome" id="nome"></p>
  <p><label for="descricao">Descrição</label><br/>
  <textarea rows="8" cols="25" name="descricao" id="descricao"></textarea></p>
  <p><label for="imagem">Imagem de previsualização</label><br/>
  <input type="file" name="imagem" id="imagem"></p>
  <p><label for="link">Link de download (formato ZIP ou TAR.GZ)</label><br/>
  <input type="text" name="link" id="link"></p>
  <p><input type="submit" value="Enviar"></p>', 'Novo tema');
}

function newmodulepost() { 
  requirelogin();
  $_POST = array_map('protect', $_POST);
  $nome = $_POST['nome'];
  $descricao = nl2br($_POST['descricao']);
  $imagem = imageupload($_FILES['imagem']);
  $imagem = $imagem['full'];
  $link = $_POST['link'];
  if(!preg_match("/^(htt|ft)(p|ps):\/\/(.*)\.(zip|tar\.gz)$/", $link) AND !preg_match("/(rapidshare|masteruploading|easy-share|sourceforge|uploading|megaupload|share|upload)/", $link)) {
    infobox("Erro: O link de download apresentou erros.<br/>
             Ele deve ter as extensões \".zip\" ou \".tar.gz\" e estar nos seguintes protocolos:
             <br/>HTTP ou FTP, com ou sem SSL.<br/>
             <a href=\"#\" onClick=\"javascript:history.back();\">Voltar</a>", true, true);
  }
  $user = mysql_fetch_array(mysql_query("SELECT login FROM accounts WHERE `id`='$_SESSION[id]'"));
  $user = $user['login'];
  mysql_query("INSERT INTO comunidade VALUES ('', 'm', '$nome', '$descricao', '$imagem', '$link', '$user')");
  redir("comu/modules");
}

?>