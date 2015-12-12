<?php
function index() {
  requirelogin();
  include("libs/video.php");
  $output = url("videos/novo", t("[novo vídeo]")).'<br>';
  $qry = mysql_query("SELECT * FROM videos WHERE id='$_SESSION[id]'");
  if(mysql_num_rows($qry)==0) {
    $output .= infobox(t("Você ainda não possui vídeos."), false);
  } else {
    while($row = mysql_fetch_array($qry)) {
      $video = youtube($row['video']);
      $output .= '<div class="row">
              <h3>'.protect($video['title']).'</h3>
              <p><i>'.protect($video['desc']).'</i><br/>
              '.$video['code'].'<br>
              '.url("videos/remove/$row[id]", t("[excluir vídeo]")).'</p>
            </div><br>';
    }
  }
  section($output, t("Meus vídeos"));
}

function novo() {
  global $home;
  requirelogin();
  section('<form method="post" action="'.$home.'videos/novopost">
'.t("Coloque a URL do vídeo no campo abaixo:").'<br>
<input type="text" name="video" placeholder="http://www.youtube.com/watch?v=videoid" size="30" required=""><br>
<input type="submit" value="Enviar vídeo">
</form>', 'Enviar novo vídeo');
}

function novopost() {
  requirelogin();
  $video = protect($_POST['video']);
  $owner = $_SESSION['id'];
  mysql_query("INSERT INTO videos (`owner`, `video`) VALUES ('$owner', '$video');");
  note(t("adicionou um novo vídeo"), $_SESSION['id']);
  infobox(t("Vídeo adicionado com sucesso!"));
}

function lista($user) {
  requirelogin();
  include("libs/video.php");
  include("libs/accounts.php");
  $user = protect($user);
  $output = menu($user).'<br>';
  $id = resolveuser($user);
  $qry = mysql_query("SELECT * FROM videos WHERE id='$id'");
  if(mysql_num_rows($qry)==0) {
    $output .= infobox($user.' '.t("ainda não possui vídeos."), true);
  } else {
    while($row = mysql_fetch_array($qry)) {
      $video = youtube($row['video']);
      $output .= '<div class="row">
              <h3>'.protect($video['title']).'</h3>
              <p><i>'.protect($video['desc']).'</i><br/>
              '.$video['code'].'</p>
            </div><br>';
    }
  }
  section($output, t("Vídeos de").' '.$user);
}

function remove($id) {
  requirelogin();
  $id = protect($id);
  $owner = $_SESSION['id'];
  mysql_query("DELETE FROM videos WHERE `id`='$id' AND `owner`='$owner'");
  infobox("Vídeo excluído com sucesso!");
}
?>