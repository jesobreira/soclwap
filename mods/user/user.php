<?php
include("mods/user/funcs.php");
function index() {
  redir("home");
}

function profile($user) {
  global $site,$url,$dateformat,$timeformat;
  $user = mysql_real_escape_string($user);
  $usr = mysql_query("SELECT * FROM accounts WHERE login='$user'");
  if(mysql_num_rows($usr)==0) {
    redir("error");
  }
  $usr = mysql_fetch_array($usr);
  $output = menu($user);
  if($usr['id']==$_SESSION['id']) {
    $output .= '<p>['.url("account/modify", "Editar perfil").']</p>';
  }

  $m_usr = array(); // sexo, nascimento, ultimo_login, registro
  if($usr['sexo']==="m") {
    $m_usr['sexo'] = "Masculino";
  }
  elseif($usr['sexo']==="f") {
    $m_usr['sexo'] = "Feminino";
  } else {
    $m_usr['sexo'] = "(Oculto)";
  }
  $m_usr['nascimento'] = date($dateformat, $usr['nascimento']);
  $idade['data'] = date("d/m/Y", $usr['nascimento']);
  list($dia, $mes, $ano) = explode('/', $idade['data']);
  $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
  $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
  $idade['valor'] = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
  if($idade['valor']==1) {
    $idade['show'] = $idade['valor'].' ano';
  } else {
    $idade['show'] = $idade['valor'].' anos';
  }
  $m_usr['ultimo_login'] = date($timeformat, $usr['ultimo_login']);
  $m_usr['registro'] = diasentre(date("d/m/Y", $usr['registro']));
  if($m_usr['registro']==1) {
    $m_usr['registro'] = "Ontem";
  } else {
    if($m_usr['registro']>365) {
      $m_usr['registro'] = round($m_usr['registro']/365);
      if($m_usr['registro']==1) {
        $m_usr['registro'] = extenso($m_usr['registro'])." ano atrás.";
      } else {
        $m_usr['registro'] = extenso($m_usr['registro'])." anos atrás.";
      }
    } else {
      $m_usr['registro'] = extenso($m_usr['registro'])." dias atrás.";
    }
  }
  
  $output .= '<img src="'.$url.'/upload/'.$usr['foto'].'" width="180"><br/>
<h3>Perfil</h3>
<p><b>Login: </b>'.$usr['login'].'<br>
<b>Nome: </b>'.$usr['nome'].'<br>
<b>Sexo: </b>'.$m_usr['sexo'].'<br>
<b>Aniversário: </b>'.$m_usr['nascimento'].' ('.$idade['show'].')</p>
<h3>Estatísticas</h3>
<p><b>Último login: </b>'.$m_usr['ultimo_login'].'<br>
<b>Registro: </b>'.$m_usr['registro'].'</p>
<h3>Sobre</h3>
<p>'.$usr['sobre'];
  if($site['campo']!='-') {
    $output .= '<br>'."\n".'<b>'.$site['campo'].': </b>'.$usr['campo'].'</p>';
  } else {
    $output .= '</p>';
  }
  section($output, "Perfil de ".primeironome($usr[nome]));
}

function notes($user) {
  global $url;
  $output = null;
  $id_user = resolveuser($user);
  $qry = mysql_query("SELECT content FROM notes WHERE account='$id_user'");
  $output = menu($user);
  if(mysql_num_rows($qry)==0) {
    $output .= 'Nenhuma notificação!';
  } else {
    while($row = mysql_fetch_array($qry)) {
      $output .= "\n".'<p class="note">
'.url("user/profile/$user", $user).' '.$row['content'].'
</p>';
    }
  }
  section($output, "Notificações de $user");
}
?>