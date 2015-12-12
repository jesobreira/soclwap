<?php

function index() { // list my albums
  global $home,$url;
  requirelogin();
  $id = $_SESSION['id'];
  $qry = mysql_query("SELECT * FROM photo_album WHERE owner='$id'");
  if(mysql_numrows($qry)!=0) {
    while($row = mysql_fetch_array($qry)) {
      $output .= url("photos/myalbum/$row[id]", $row['title']).'
      <sup><a href="'.$home.'photos/removealbum/'.$row['id'].'" onClick="return confirm(\''.t("Deseja realmente excluir este álbum e todas as fotos do mesmo?").'\');">'.t("[remover]").'</a></sup>
      <br>';
    }
  section($output, t('Meus álbuns')); // two sections
  }

  section('<form method="post" action="'.$home.'photos/createalbumpost">
<label for="albumname">'.t("Nome do álbum:").'</label><br/>
<input type="text" name="albumname" id="albumname"><br/>
<input type="submit" value="'.t("Criar álbum").'">
</form>', t("Criar novo álbum"));

}

function createalbumpost() {
  requirelogin();
  $_POST = array_map('protect', $_POST);
  $title = $_POST['albumname'];
  $owner = $_SESSION['id'];

  mysql_query("INSERT INTO photo_album VALUES ('', '$owner', '$title');");
  redir("photos");
}

function removealbum($id) {
  requirelogin();
  $id = protect($id);
  $owner = $_SESSION['id'];
  $qry = mysql_query("SELECT * FROM photo_album WHERE id='$id' AND owner='$owner'");
  if(mysql_numrows($qry)==1) {
    $row = mysql_fetch_array($qry);
    $fotos = mysql_query("SELECT * FROM photos WHERE album='$id'");
    if(mysql_numrows($qry)>0) {
      while($photo = mysql_fetch_array($fotos)) {
	unlink("upload/$photo[foto]");
      }
    }
  mysql_query("DELETE FROM photos WHERE album='$id'");
  mysql_query("DELETE FROM photo_album WHERE id='$id'");
  }
  redir("photos");
}

function myalbum($aid) {
  global $home,$url;
  requirelogin();
  $id = $_SESSION['id'];
  $aid = protect($aid);
  $output = '<script type="text/javascript">
len = 0;
function insere(){
len++;
document.getElementById("len").value = len;
var inp = document.createElement("input");
inp.setAttribute("id", "foto");
inp.setAttribute("type", "file");
inp.setAttribute("name", "foto"+len);

var pai = document.getElementById("send");
pai.appendChild(inp);
}

function envia() {
  document.getElementById("send").submit();
}
</script>';
  $output .= '<p><form method="post" enctype="multipart/form-data" action="'.$home.'photos/sendpost" onSubmit="return false;" id="send">
<input type="hidden" value="'.$aid.'" name="album">
<input type="hidden" value="0" name="len" id="len">
<input type="submit" value="Enviar fotos" onClick="javascript:envia();"><br>
<input type="button" value="Adicionar mais um campo" onClick="javascript:insere();"><br>
<input type="file" name="foto0" id="foto">
</form></p>';
  $qry = mysql_query("SELECT * FROM photos WHERE `owner`='$id' AND `album`='$aid'");
  if(mysql_numrows($qry)==0) {
    $output .= infobox(t("Você ainda não enviou nenhuma foto para este álbum."), false);
  } else {
    while($row = mysql_fetch_array($qry)) {
      $output .= '<div class="row">
  <img src="'.$url.'/upload/'.$row['foto'].'" width="320"><br/>
  '.url("photos/remove/$row[id]", t("[excluir]")).'
  </div><br/>';
    }
  }
  section($output, "Minhas fotos");
}

function lista($user) {
  global $home,$url;
  requirelogin();
  $id = resolveuser($user);
  $qry = mysql_query("SELECT * FROM photo_album WHERE owner='$id'");
  if(mysql_numrows($qry)!=0) {
    while($row = mysql_fetch_array($qry)) {
      $output .= url("photos/viewalbum/$row[id]", $row['title']).'
      <br>';
    }
  section($output, t('Álbuns de')." $user");
  } else {
  	infobox($user.' '.t("ainda não possui álbuns de fotos."));
	}
}

function viewalbum($aid) {
  global $home,$url;
  requirelogin();
  $aid = protect($aid);
  $qry = mysql_query("SELECT * FROM photos WHERE `album`='$aid'");
  if(mysql_numrows($qry)==0) {
    $output .= infobox(t("Este álbum está vazio."), false);
  } else {
    while($row = mysql_fetch_array($qry)) {
      $output .= '<div class="row">
  <img src="'.$url.'/upload/'.$row['foto'].'" width="320"><br/>
  </div><br/>';
    }
  }
  section($output, t("Vendo álbum"));
}

function sendpost() {
  requirelogin();
  $owner = $_SESSION['id'];
  $_POST = array_map('protect', $_POST);
  $i = 0;
  $j = $_POST['len'];
  $album = $_POST['album'];
  while($i<=$j) {
    $foto = imageupload($_FILES["foto$i"]);
    if($foto) {
      mysql_query("INSERT INTO photos (`foto`, `owner`, `album`)
                               VALUES ('$foto[full]', '$owner', '$album');");
    }
    $i++;
  }
  note(t("adicionou fotos."), $_SESSION['id']);
  infobox(t("Fotos enviadas com sucesso!"));
}

function remove($id) {
  requirelogin();
  $id = protect($id);
  $owner = $_SESSION['id'];
  $qry = mysql_query("SELECT `foto` FROM photos WHERE `id`='$id' AND `owner`='$owner'");
  if(mysql_numrows($qry)==1) {
    $qry = mysql_fetch_array($qry);
    unlink("upload/".$qry['foto']);
    mysql_query("DELETE FROM photos WHERE `id`='$id'");
  }
  infobox(t("Foto excluída com sucesso."));
}
?>