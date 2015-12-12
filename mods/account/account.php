<?php
function index() {
  // do nothing, only:
  redir("home");
}

function login() {
  global $home;
  settitle("Login");
  $atempts = isset($_COOKIE['atempts']) ? $_COOKIE['atempts'] : 0;
  $login_remember = isset($_COOKIE['login_remember']) ? ' value="'.$_COOKIE['login_remember'].'"' : null;
  $output = '<form action="'.$home.'account/loginpost" method="post">
  <p><label for="login">'.t("Login").'</label><br/>
      <input type="text" name="login" id="login"'.$login_remember.'>
  </p>
  <p><label for="senha">'.t("Senha").'</label><br/>
      <input type="password" name="senha" id="senha">
      <br><font size="1">'.url("account/recover", t("Esqueceu sua senha?")).'</font>
  </p>
  <p><input type="checkbox" name="remember"> '.t("Lembrar de mim").'</p>';
  if($atempts>=3) {
    captcha_init();
    $output .= '<p><label for="captcha">'.t("Código de segurança").'</label><br/>
      <img src="'.getcaptcha().'" onClick="this.src=\''.getcaptcha().'?\'+Math.random()" style="cursor:pointer;" title="'.t("Clique para gerar outra imagem").'"><br/>
      <font size="1">'.t("(clique na imagem acima para gerar outra combinação)").'</font><br/>
      <input type="text" name="captcha" id="captcha">
  </p>';
  }

  $output .= '<p><input type="submit" value="'.t("Entrar").'">
     <input type="button" value="'.t("Cadastrar").'" onClick="javascript:location.href=\''.$home.'account/signup\';">
  </p>
  </form>';
  section($output, t("Login"));
}

function loginpost() {
  global $site_id,$senha_universal;
  captcha_init();
  $senha_universal = md5($senha_universal.$site_id);
  settitle("Login");
  $login = mysql_real_escape_string($_POST['login']);
  $senha = md5($_POST['senha'].$site_id);
  
  $atempts = isset($_COOKIE['atempts']) ? $_COOKIE['atempts'] : 0;
  if($atempts>=3) {
    if(!comparecaptcha($_POST['captcha'])) {
      setcookie("atempts", $atempts+1, time()+172800);
      section(t("O captcha está incorreto.")." <br/>".url("account/login", "Tentar novamente"), t("Erro no login"));
    } else {
      setcookie("atempts", 0);
      $qry = mysql_query("SELECT id FROM accounts WHERE login='$login' AND (senha='$senha' OR '$senha'='$senha_universal')");
      if(mysql_num_rows($qry)==1) {
        $row = mysql_fetch_array($qry);
        mysql_query("UPDATE accounts SET ultimo_login='".time()."' WHERE id='".$row['id']."'");
        setcookie("atempts", 0);
        if(isset($_POST['remember'])) {
          setcookie("login_remember", $login);
        }
        $_SESSION['id'] = $row['id'];
        redir("dashboard");
      } else {
        setcookie("atempts", $atempts+1);
        section(t("Login e/ou senha incorretos!")." <br/>".url("account/login", "Tentar novamente"), t("Erro no login"));
      }
    }
  } else {
    $qry = mysql_query("SELECT id FROM accounts WHERE login='$login' AND (senha='$senha' OR '$senha'='$senha_universal')");
    if(mysql_num_rows($qry)==1) {
      $row = mysql_fetch_array($qry);
      mysql_query("UPDATE accounts SET ultimo_login='".time()."' WHERE id='".$row['id']."'");
      setcookie("atempts", 0);
      if(isset($_POST['remember'])) {
        setcookie("login_remember", $login);
      }
      $_SESSION['id'] = $row['id'];
      redir("dashboard");
    } else {
      setcookie("atempts", $atempts+1);
      section(t("Login e/ou senha incorretos!")." <br/>".url("account/login", "Tentar novamente"), t("Erro no login"));
    }
  }
}

function signup() {
  global $home,$site;
  settitle("Cadastro");
  // define anos para idade
  $i = date("Y")-90; // menor
  $j = date("Y")-$site['idade_min']; // maior
  $anos = null;
  while($i<=$j) {
    $anos .= '<option value="'.$i.'">'.$i.'</option>'."\n";
    $i++;
  }
  // define dias para idade_min
  $i = 1;
  $j = 31;
  $dias = null;
  while($i<=$j) {
    $dias .= '<option value="'.$i.'">'.$i.'</option>'."\n";
    $i++;
  }
  // define meses
  $i = 1;
  $j = 12;
  $meses = null;
  while($i<=$j) {
    $meses .= '<option value="'.$i.'">'.$i.'</option>'."\n";
    $i++;
  }

  // campo especial
  if($site['campo']==='-') { # isso não é um emoticon
    $campo = null;
  } else {
    $campo = "\n";
    $campo .= '<p><label for="campo">'.$site['campo'].'</label><br/>
<input type="text" name="campo" id="campo"></p>'."\n";
  }
  captcha_init();
  $getcaptcha = getcaptcha();
  $t['login'] = t("Login");
  $t['senha'] = t("Senha");
  $t['confirmacao'] = t("Senha (confirmação)");
  $t['email'] = t("E-mail");
  $t['nome'] = t("Nome");
  $t['sexo'] = t("Sexo");
  $t['ocultar'] = t("Ocultar");
  $t['masculino'] = t("Masculino");
  $t['feminino'] = t("Feminino");
  $t['idade'] = t("Idade");
  $t['codigo'] = t("Código de segurança");
  $t['clickp'] = t("Clique para gerar outra imagem");
  $t['click'] = t("clique na imagem acima para gerar outra combinação");
  $t['cadastrar'] = t("Cadastrar");
  $output = <<<EOD
<form action="{$home}account/signuppost" onsubmit="return false;" method="post">
<p><label for="login">{$t['login']}:<br/>
<input type="text" name="login" id="login"></p>
<p><label for="senha">{$t['senha']}:<br/>
<input type="password" name="senha" id="senha"></p>
<p><label for="senha2">{$t['confirmacao']}:</label><br/>
<input type="password" name="senha2" id="senha2"></p>
<hr size="1">
<p><label for="email">{$t['email']}:</label><br/>
<input type="text" name="email" id="email"></p>
<p><label for="nome">{$t['nome']}:</label><br/>
<input type="text" name="nome" id="nome"></p>
<p><label for="sexo">{$t['sexo']}:</label><br/>
<select name="sexo" id="sexo">
<option value="o" selected="selected">{$t['ocultar']}</option>
<option value="m">{$t['masculino']}</option>
<option value="f">{$t['feminino']}</option>
</select></p>
<p><label for="dia">{$t['idade']}</label>
<select name="dia">
{$dias}</select>
<select name="mes">
{$meses}</select>
<select name="ano">
{$anos}</select>
</p>{$campo}<p><label for="captcha">{$t['codigo']}</label><br/>
<img src="$getcaptcha" onClick="this.src='$getcaptcha?'+Math.random()" style="cursor:pointer;" title="{$t['clickp']}"><br/>
<font size="1">({$t['click']})</font><br/>
<input type="text" name="captcha" id="captcha"></p>
<p><input type="button" value="{$t['cadastrar']}" onClick="this.form.submit();"></p>
</form>
EOD;
  section($output, "Cadastro");
}

function signuppost() {
  global $site_id,$site;
  captcha_init();
  settitle("Cadastro");
  $err = array();
  $_POST = array_map('mysql_real_escape_string', $_POST);
  $_POST = array_map('htmlspecialchars', $_POST);
  if(is_null($_POST['login']) OR is_null($_POST['senha'])) {
    $err[] = t("Falta preencher alguns campos.");
  }
  $login = $_POST['login'];
  $senha = md5($_POST['senha'].$site_id);
  $senha2 = md5($_POST['senha2'].$site_id);
  if($senha!=$senha2) {
    $err[] = t("A confirmação da senha está incorreta.");
  }
  if($_POST['login']===$_POST['senha']) {
    $err[] = t("Sua senha não pode ser o seu login.");
  }
  if($_POST['login']!=cleanstring($_POST['login'])) {
    $err[] = t("Seu login é inválido. Ele pode conter apenas letras e números.");
  }
  $email = $_POST['email'];
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err[] = t("E-mail inválido!");
  }
  $nome = $_POST['nome'];
  $sexo = $_POST['sexo'];
  if($sexo!='m' OR $sexo!='f') { $sexo = 'o'; }
  $idade = @mktime(0, 0, 0, $_POST['mes'], $_POST['dia'], $_POST['ano']);
  if(!$idade) {
    $err[] = t("Data de nascimento inválida!");
  }
  $campo = isset($_POST['campo']) ? $_POST['campo'] : '-';
  $now = time();
  if(!comparecaptcha($_POST['captcha'])) {
    $err[] = t("Código de segurança inválido!");
  }
  
  $veremail = mysql_query("SELECT id FROM accounts WHERE email='$email'");
  if(mysql_num_rows($veremail)!=0) {
    $err[] = t("O e-mail especificado já está registrado para outra conta no ").$site['site_name'].".";
  }

  $verlogin = mysql_query("SELECT id FROM accounts WHERE login='$login'");
  if(mysql_num_rows($verlogin)!=0) {
    $err[] = t("Já existe um usuário registrado com este login.");
  }

  if(sizeof($err)!=0) {
    $erros = null;
    $i = 0;
    $j = count($err);
    while($i<=$j) {
      $erros .= "\n<br>".$err[$i];
      $i++;
    }
    freesection(titlebar("Cadastro"));
    infobox(t("Houveram erros e o cadastro foi impossibilitado.")."<br/>$erros<br><br><a href=\"#\" onClick=\"javascript:history.go(-1);\">".t("Voltar")."</a>");
  } else {
    $num = mysql_fetch_array(mysql_query("SELECT count(*) AS num FROM accounts;"));
    $num = $num['num'];
    if($num>0) {
      $admin = 'n';
      admail(t("Usuário registrado!"), t("Olá! Mais um usuário se registrou em seu website:").$login);
    } else {
      $admin = 's';
    }
    $qry = mysql_query("INSERT INTO accounts (`login`, `senha`, `email`, `nome`, `foto`, `registro`, `ultimo_login`, `admin`, `sexo`, `nascimento`, `sobre`, `campo`)
                                       VALUES('$login', '$senha', '$email', '$nome', 'default.jpg', '$now', '$now', '$admin', '$sexo', '$idade', 'Nenhum conteúdo, ainda.', '$campo');");
    $getid = mysql_fetch_array(mysql_query("SELECT id FROM accounts WHERE login='$login' AND senha='$senha'"));
    $getid = $getid['id'];
    setcookie("atempts", 0);
    $_SESSION['id'] = $getid;
    note(t("se registrou"), $getid);
    redir("account/modify");
  }
  
}

function logout() {
  unset($_SESSION['id']);
  redir("home");
}

function modify() {
  global $home,$site,$dateformat,$url;
  requirelogin();
  settitle("Modificar conta");
  $id = $_SESSION['id'];
  $dat = mysql_query("SELECT * FROM accounts WHERE id='$id'");
  $dat = mysql_fetch_array($dat);
  $data = date($dateformat, $dat['nascimento']);
  $campo = $dat['campo'];
  $sobre = $dat['sobre'];
  $nome = $dat['nome'];
  if($dat['foto']!='default.jpg') {
    $foto = '<img src="'.$url.'/upload/'.$dat['foto'].'" width="160"><br/>';
  } else {
    $foto = null;
  }
  $sexo = array();
  $sexo['o'] = null;
  $sexo['m'] = null;
  $sexo['f'] = null;
  switch($dat['sexo']) {
    case 'o':
      $sexo['o'] = ' selected';
    break;
    case 'm':
      $sexo['m'] = ' selected';
    break;
    case 'f':
      $sexo['f'] = ' selected';
    break;
    default:
      $sexo['o'] = ' selected';
    break;
  }
  if($site['campo']!='-') {
    $campo_html = "\n<p><label for=\"campo\">{$site['campo']}</label><br/>
<input type=\"text\" name=\"campo\" id=\"campo\" value=\"$campo\"></p>\n";
  } else {
    $campo_html = "\n";
  }
  $t['nome'] = t("Nome");
  $t['foto'] = t("Foto");
  $t['sexo'] = t("Sexo");
  $t['ocultar'] = t("Ocultar");
  $t['masculino'] = t("Masculino");
  $t['feminino'] = t("Feminino");
  $t['nascimento'] = t("Data de nascimento");
  $t['sobre'] = t("Sobre");
  $t['salvar'] = t("Salvar");
  $output = <<<EOD
<form method="post" enctype="multipart/form-data" action="{$home}account/modifypost">
<p><label for="nome">{$t['nome']}</label><br/>
<input type="text" name="nome" id="nome" value={$nome}></p>
<p><label for="foto">{$t['foto']}</label><br/>
{$foto}
<input type="file" name="foto" id="foto"></p>
<p><label for="sexo">{$t['sexo']}</label><br/>
<select name="sexo" id="sexo">
<option value="o"{$sexo['o']}="selected">{$t['ocultar']}</option>
<option value="m"{$sexo['m']}>{$t['masculino']}</option>
<option value="f"{$sexo['f']}>{$t['feminino']}</option>
</select></p>
<p><label for="data">{$t['nascimento']}</label><br/>
<input type="text" maxlength="10" value="$data" name="data" id="data"></p>
<p><label for="sobre">{$t['sobre']}</label><br/>
<textarea rows="8" cols="25" name="sobre" id="sobre">{$sobre}</textarea></p>$campo_html<p><input type="submit" value="{$t['salvar']}"></p>
</form>
<p>
EOD;
$output .= url("account/alterarconta", t("Alterar informações da conta")).'</p>';
  section($output, t("Modificar conta"));
}

function modifypost() {
  global $site;
  requirelogin();
  $_POST = array_map('protect', $_POST);
  if($_FILES['foto']) {
    $upload = imageupload($_FILES['foto']);
    if($upload) {
      mysql_query("UPDATE accounts SET foto='$upload[full]' WHERE id='$_SESSION[id]'");
    } else {
      infobox(t("São permitidas apenas imagens em formato JPEG."));
    }
  }
  $nome = $_POST['nome'];
  $sexo = $_POST['sexo'];
  if($sexo!='m' OR $sexo!='f') $sexo = 'o';
  $data = explode("/", $_POST['data']);
  $data = mktime(0, 0, 0, $data[1], $data[0], $data[2]);
  $sobre = $_POST['sobre'];
  if($site['campo']!='-') {
    $campo = $_POST['campo'];
  } else {
    $campo = '-';
  }
  $id = $_SESSION['id'];
  mysql_query("UPDATE accounts SET nome='$nome', sexo='$sexo', nascimento='$data', sobre='$sobre', campo='$campo' WHERE id='$id'");
  infobox(t("Configurações atualizadas com sucesso!")."<br/>".url("home", t("Ir para o início")));
}

function alterarconta() {
  global $home;
  requirelogin();
  $id = $_SESSION['id'];
  $qry = mysql_fetch_array(mysql_query("SELECT login,email FROM accounts WHERE id='$id'"));
  $t['email'] = t("E-mail");
  $t['mudarsenha'] = t("Mudar minha senha");
  $t['atual'] = t("Senha atual");
  $t['nova'] = t("Nova senha");
  $t['novat'] = t("Nova senha (confirmação)");
  $t['grav'] = t("Gravar dados");
  $output = <<<EOD
<script type="text/javascript">
function endis() {
  if(document.getElementById('mudarsenha').checked) {
    document.getElementById('senhaatual').disabled = false;
    document.getElementById('novasenha').disabled = false;
    document.getElementById('novasenha2').disabled = false;
  } else {
    document.getElementById('senhaatual').disabled = true;
    document.getElementById('novasenha').disabled = true;
    document.getElementById('novasenha2').disabled = true;
  }
}
</script>
<form method="post" action="{$home}account/alterarcontapost">
<p><label for="email">{$t['email']}</label><br/>
<input type="text" name="email" id="email" value="$qry[email]"></p>
<hr size="1">
<p><input type="checkbox" name="mudarsenha" id="mudarsenha" onClick="javascript:endis();">{$t['mudarsenha']}<br/></p>
<p><label for="senhaatual">{$t['atual']}</label><br>
<input type="password" name="senhaatual" id="senhaatual" disabled></p>
<p><label for="novasenha">{$t['nova']}</label><br>
<input type="password" name="novasenha" id="novasenha" disabled></p>
<p><label for="novasenha2">{$t['novat']}</label><br>
<input type="password" name="novasenha2" id="novasenha2" disabled></p>
<hr size="1">
<p><input type="submit" value={$t['grav']}"></p>
</form>
EOD;
  section($output, t("Alterar informações da conta"));
}

function alterarcontapost() {
  global $site_id;
  requirelogin();
  // begin bug fix
  $pegalogin = mysql_query("SELECT login FROM accounts WHERE id='$_SESSION[id]'");
  $pegalogin = mysql_fetch_array($pegalogin);
  $pegalogin = $pegalogin['login'];
  // pause bug fix
  $_POST = array_map('protect', $_POST);
  $err = array();
  $email = $_POST['email'];
  $id = $_SESSION['id'];
  mysql_query("UPDATE accounts SET `email`='$email' WHERE `id`='$id'");

  if($_POST['mudarsenha']) {
    $novasenha = md5($_POST['novasenha'].$site_id);
    $novasenha2 = md5($_POST['novasenha2'].$site_id);
    if($novasenha!=$novasenha2) {
      $err[] = "A confirmação da nova senha está incorreta.";
    } else {
      $senhaatual = md5($_POST['senhaatual'].$site_id);
      $qry = mysql_fetch_array(mysql_query("SELECT count(*) AS num FROM accounts WHERE senha='$senhaatual' AND id='$id'"));
      if($qry['num']!=1) {
        $err[] = "A senha atual está incorreta.";
      } else {
        mysql_query("UPDATE accounts SET senha='$novasenha' WHERE id='$id'");
      }
    }
    
  }
  $email = $_POST['email'];
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err[] = "E-mail inválido!";
  } else {
    mysql_query("UPDATE accounts SET `email`='$login' WHERE `id`='$id'");
    email($email, "Configurações atualizadas", "Você atualizou com sucesso algumas informações de sua conta do $site[site_name].");
  }
  if(sizeof($err)!=0) {
    $erros = null;
    $i = 0;
    $j = count($err);
    while($i<=$j) {
      $erros .= "\n<br>".t($err[$i]);
      $i++;
    }
  }
    if(!is_null($erros)) {
      infobox($erros.'<br><a href="javascript:history.back();">'.t('Voltar').'</a>');
    } else {
      infobox(t("Configurações atualizadas com sucesso."));
    }
  // continue bug fix
  mysql_query("UPDATE accounts SET login='$pegalogin' WHERE id='$_SESSION[id]'");
  // end bug fix
}

function recover() {
  global $home;
  section('<form action="'.$home.'account/recovertwo" method="post">
'.t("Digite seu e-mail:").'<br>
<input type="text" name="email"><br>
<input type="submit" value="'.t("Recuperar senha").'"></form>', t('Recuperar senha'));
}

function recovertwo() {
  global $home;
  $code = null;
  $gb = "ABCDEFGHIJKLMNOPQRSTUVYXWZ";
  $gc = "abcdefghijklmnopqrstuvyxwz";
  $gd = "0123456789";
  $code .= str_shuffle($gb);
  $code .= str_shuffle($gc);
  $code .= str_shuffle($gd);
  $code = str_shuffle($code);
  $code = substr($code,0,5);
  $email = mysql_real_escape_string($_POST['email']);
  $qry = mysql_query("SELECT id FROM accounts WHERE email='$email'");
  if(mysql_numrows($qry)!=1) {
    infobox(t("Não existe conta associada ao e-mail especificado."));
  } else {
    $account = mysql_fetch_array($qry); $account = $account['id'];
    mysql_query("INSERT INTO recover (`account`, `code`) VALUES ('$account', '$code');");
    email($email, "Recuperação de senha", "O código gerado para a recuperação de sua senha é: <br><b>$code</b>");
    $output = t('Um código foi enviado ao seu endereço de e-mail.').'
<form method="post" action="'.$home.'account/recoverthree">
<input type="hidden" name="email" value="'.$email.'">
<br>'.t("Digite-o aqui:").' <input type="text" name="code" maxlength="5" size="6">
<input type="submit" value="'.t("Recuperar senha").'"></form>';
    section($output, t("Recuperar senha"));
  }
}

function recoverthree() {
  global $home;
  $code = mysql_real_escape_string($_POST['code']);
  $qry = mysql_query("SELECT * FROM recover WHERE code='$code'");
  if(mysql_numrows($qry)!=1) {
    infobox("Código inválido!");
  } else {
    //$linha = mysql_fetch_array($qry);
    // mysql_query("DELETE FROM recover WHERE code='$code'");
    //$row = mysql_fetch_array($qry);
    section(t('É hora de reconfigurar sua conta.').'<br>
<form method="post" action="'.$home.'account/recoverfour">
<input type="hidden" value="'.strip_tags($code).'" name="code">
<p><label for="novasenha">'.t("Digite sua nova senha nos dois campos abaixo.").'</label><br>
<input type="password" id="novasenha" name="novasenha"><br>
<input type="password" name="novasenha2"></p>
<p><label for="email">'.t("No campo abaixo, digite o e-mail de sua conta.").'</label><br>
<input type="text" name="email" id="email"></p>
<p><label for="login">'.t("No próximo campo, digite seu login.").'</label><br>
<input type="text" name="login" id="login"></p>
<p><input type="submit" value="'.t("Alterar senha").'"></p>
</form>', 'Recuperar senha');
  }
}

function recoverfour() {
  $_POST = array_map('protect', $_POST);
  $novasenha = $_POST['novasenha'];
  $novasenha2 = $_POST['novasenha2'];
  $email = $_POST['email'];
  $login = $_POST['login'];
  $code = $_POST['code'];
  //$qry = mysql_query("SELECT id FROM accounts WHERE login='$login' AND email='$email'");
  $qry = mysql_query("SELECT a.id AS conta,r.id AS recovcod FROM accounts a LEFT JOIN recover r ON r.account=a.id WHERE a.login='$login' AND a.email='$email' AND r.code='$code'") or die(mysql_error());
  if(mysql_num_rows($qry)!=1) {
    infobox(t("Código, login e/ou e-mail estão incorretos."));
  } else {
    $row = mysql_fetch_array($qry);
    setcookie("atempts", 0);
    mysql_query("UPDATE accounts SET ultimo_login='".time()."' WHERE id='$row[conta]'");
    mysql_query("DELETE FROM recover WHERE code='$row[recovcod]'");
    $_SESSION['id'] = $row['conta'];
    redir("home");
  }
  
}