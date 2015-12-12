<?php
function index() { // my friends
  global $url;
  requirelogin();
  $id = $_SESSION['id'];
  $output = null;
  $qry = mysql_query("SELECT * FROM friends_reqs WHERE `to`='$id' LIMIT 10"); // friends requests
  if(mysql_numrows($qry)!=0) {
    while($row = mysql_fetch_array($qry)) {
      $usr = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE id='$row[from]'"));
      $output .= "\n".'<div class="row">
                    <table>
                      <tr>
                        <td>
                          <img src="'.$url.'/upload/'.thumb($usr['foto']).'">
                        </td>
                        <td>
                          <b>'.url("user/profile/$usr[login]", $usr['login']).'</b><br/>
                          <i>'.$row['message'].'</i><br/>
                          '.url("friends/accept/$usr[login]", t("[aceitar]")).' '.url("friends/remove/$usr[login]", t("[remover]")).'
                        </td>
                      </tr>
                    </table>
                  </div><br/>';
    }
    section($output, t("Pedidos de amizade"));
  }
  $output = null;
  $qry = mysql_query("SELECT * FROM friends WHERE `id1`='$id'"); // show my friends
  if(mysql_numrows($qry)==0) {
    $output .= t("Você ainda não tem amigos.");
  } else {
    while($row = mysql_fetch_array($qry)) {
      $usr = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE id='$row[id2]'"));
      $output .= "\n".'<div class="row">
                        <table>
                          <tr>
                            <td>
                              <img src="'.$url.'/upload/'.thumb($usr['foto']).'">
                            </td>
                            <td>
                              <b>'.url("user/profile/$usr[login]", $usr['login']).'</b><br/>
                              '.url("friends/remove/$usr[login]", t("[remover]")).'
                            </td>
                          </tr>
                        </table>
                      </div><br/>';
    }
  }
  section($output, t("Amigos"));
}

function lista($user) {
  global $url;
  include("libs/accounts.php");
  $output = menu($user);
  $id = resolveuser($user);
  if(!friends($id, $_SESSION['id'])) {
    $output .= '<br>'.url("friends/pedir/$user", t("[pedir amizade]")).'<br>';
  }
  $qry = mysql_query("SELECT * FROM friends WHERE `id1`='$id'"); // show friends
  if(mysql_numrows($qry)==0) {
    $output .= t(infobox($user.' '.t("ainda não possui amigos."), false));
  } else {
    while($row = mysql_fetch_array($qry)) {
      $usr = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE id='$row[id2]'"));
      $output .= "\n".'<p class="row">
                        <table>
                          <tr>
                            <td>
                              <img src="'.$url.'/upload/'.thumb($usr['foto']).'">
                            </td>
                            <td>
                              <b>'.url("user/profile/$usr[login]", $usr['login']).'</b><br/>
                              '.url("friends/remove/$usr[login]", t("[remover]")).'
                            </td>
                          </tr>
                        </table>
                      </p>';
    }
  }
  section($output, t("Amigos de").' '.$user));
}

function remove($user) {
  requirelogin();
  $me = $_SESSION['id'];
  $user = resolveuser($user);
  mysql_query("DELETE FROM friends WHERE `id1`='$me' AND `id2`='$user'");
  mysql_query("DELETE FROM friends WHERE `id1`='$user' AND `id2`='$me'");
  mysql_query("DELETE FROM friends_reqs WHERE `from`='$user' AND `to`='$me'");
  infobox(t("Excluído com sucesso."));
}

function accept($user) {
  requirelogin();
  $me = $_SESSION['id'];
  $user = resolveuser($user);
  $qry = mysql_query("SELECT * FROM friends_reqs WHERE `from`='$user' AND `to`='$me'");
  if(mysql_numrows($qry)==1) {
    mysql_query("INSERT INTO friends (`id1`, `id2`) VALUES ('$user', '$me');");
    mysql_query("INSERT INTO friends (`id1`, `id2`) VALUES ('$me', '$user');");
    mysql_query("DELETE FROM friends_reqs WHERE `from`='$user' AND `to`='$me'");
  }
  note("agora tem um novo amigo.", $_SESSION['id']);
  note("agora tem um novo amigo.", $user);
  infobox(t("Parabéns! Você tem mais um amigo."));
}

function pedir($user) {
  global $home;
  requirelogin();
  include("libs/accounts.php");
  $usuario = protect($user);
  $user = resolveuser($user);
  $me = $_SESSION['id'];
  if($me===$user) {
    infobox(t("Você não pode adicionar a si mesmo!"));
    stop_here();
  }
  if(!validuser($user)) {
    infobox(t("Usuário inválido!"));
    stop_here();
  }
  // verifica se já são amigos
  $qry = mysql_query("SELECT * FROM friends WHERE (`id1`='$user' AND `id2`='$me') OR (`id1`='$me' AND `id2`='$user')");
  if(mysql_num_rows($qry)==1) {
    infobox($usuario.' '.t("e você já são amigos."));
    stop_here();
  }
  // verifica se já existe convite
  $qry = mysql_query("SELECT * FROM friends_reqs WHERE (`from`='$user' AND `to`='$me') OR (`from`='$me' AND `to`='$user')");
  if(mysql_num_rows($qry)==1) {
    infobox(t("Já existe um pedido de amizade entre você e").' '.$usuario.'.');
    stop_here();
  }

  // tudo certo, exibir formulário
  $output = menu($usuario).'<form method="post" action="'.$home.'friends/pedirpost">
<p>Você está adicionando '.$usuario.' como seu amigo.<br>
Digite algo para que seu convite seja aceito:<br>
<input type="hidden" name="user" value="'.$user.'">
<input type="hidden" name="usuario" value="'.$usuario.'">
<input type="text" name="message" maxlength="255"><input type="submit" value="Enviar">
</form>';
  section($output, t("Adicionar amigo"));
}

function pedirpost() {
  requirelogin();
  $me = $_SESSION['id'];
  $user = protect($_POST['user']);
  $usuario = protect($_POST['usuario']);
  $message = protect($_POST['message']);

  if($me===$user) {
    infobox(t("Você não pode adicionar a si mesmo!"));
    stop_here();
  }
  if(!validuser($user)) {
    infobox(t("Usuário inválido!"));
    stop_here();
  }
  // verifica se já são amigos
  $qry = mysql_query("SELECT * FROM friends WHERE (`id1`='$user' AND `id2`='$me') OR (`id1`='$me' AND `id2`='$user')");
  if(mysql_num_rows($qry)==1) {
    infobox($usuario.' '.t("e você já são amigos."));
    stop_here();
  }
  // verifica se já existe convite
  $qry = mysql_query("SELECT * FROM friends_reqs WHERE (`from`='$user' AND `to`='$me') OR (`from`='$me' AND `to`='$user')");
  if(mysql_num_rows($qry)==1) {
    infobox(t("Já existe um pedido de amizade entre você e").' '.$usuario.'.');
    stop_here();
  }

  // tudo certo, enviar convite
  mysql_query("INSERT INTO friends_reqs (`from`, `to`, `message`) VALUES ('$me', '$user', '$message');");
  infobox(t("Pedido de amizade enviado com sucesso."));
}