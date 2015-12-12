<?php
include("libs/init.php");
function syserr($str) {
  global $admin_email,$url;
  echo '<!DOCTYPE html>
<html>
<head>
<title>Erro - SoclWAP</title>
<style type="text/css">
.infobox {
border: 1px solid #0D1880;
background-color: #B3CFF5;
padding: 10px;
font-size: 12px;
color: #808080;
text-align: justify;
}
</style>
</head>
<body>
<img src="'.$url.'/img/logo.png" width="160" alt="SoclWAP"><br/>
<font face="Verdana" size="2">
<p>Ocorreu um erro na execução do <a href="http://soclwap.sourceforge.net/" target="_blank">SoclWAP</a>.</p>
<blockquote>'.$str.'</blockquote>
</body>
</html>';
  admail("Erro", "Houve um erro na execução do SoclWAP: \n$str");
  exit;
}

function email($to, $subject, $message) {
  global $admin_email, $url, $home, $site;
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html;
charset=utf-8\r\n";
  $headers .= "From: $site[site_name] <$admin_email>\r\n";
  $headers .= "Reply-To: $admin_email\r\n";
  $body = $site['site_name']."<br>".nl2br($message)."<br>".base64_decode("UG93ZXJlZCBieSA8YSANCmhyZWY9Imh0dHA6Ly9zb2Nsd2FwLnNvdXJjZWZvcmdlLm5ldC8iIA0KdGFyZ2V0PSJfYmxhbmsiPlNvY2xXQVA8L2E+");
  $subject = strip_tags($subject);
  $send = mail($to, $subject, $body, $headers);
  if($send) {
    return true;
  } else {
    return false;
  }
}

function admail($subject, $message) {
  global $admin_email;
  email($admin_email, $subject, $message);
}

function is_logged() {
  if(isset($_SESSION['id'])) {
    return true;
  } else {
    return false;
  }
}

function is_admin() {
  $id = $_SESSION['id'];
  $qry = mysql_fetch_array(mysql_query("SELECT count(*) AS num FROM accounts WHERE id='$id' AND admin='s'"));
  if($qry['num']==1) {
    return true;
  } else {
    return false;
  }
}

function boot() {
  global $home,$site_id,$site;
  $p = $_GET['p'];
  if($p=='') {
    redir('home');
  }

  $p = explode("/", $p);

  $module = $p[0];
  $function = strip_tags($p[1]);
  if($function!='') {
    $var = strip_tags(str_replace('"', '\"', !is_null($p[2]) ? $p[2] : 'none'));
    $var2 = strip_tags(str_replace('"', '\"', !is_null($p[3]) ? $p[3] : 'none'));
  } else {
    $function = 'index';
    $var = strip_tags(str_replace('"', '\"', !is_null($p[1]) ? $p[1] : 'none'));
    $var2 = strip_tags(str_replace('"', '\"', !is_null($p[2]) ? $p[2] : 'none'));
  }
  $args = null;
  if($var!='') {
    $args .= $var;
  }
  if($var2!='') {
    $args .= ', '.$var2;
  }
  if(function_exists($function)) {
    siteerr(t("Página não encontrada!"));
  } else {
    if(file_exists("mods/$module/$module.php")) {
      include("mods/$module/$module.php");
      if(function_exists($function)) {
        $args2 = str_replace(", ", "\", \"", $args);
        // eval("$function($args);");
        eval("$function(\"$args2\");");
        if(is_logged()) {
          $rssview = md5($_SESSION['id'].$site_id);
          swhead('<link rel="alternate" type="application/rss+xml" title="RSS" href="'.$home.'rss/view/'.$rssview.'">');
        }
        swhead('<link rel="shortcut icon" type="image/x-icon" href="'.$site['site_logo'].'">');
      } else {
        siteerr(t("Página não encontrada!"));
      }
    } else {
      siteerr(t("Página não encontrada!"));
    }
    pagemount();
  }
}

function stop_here() {
  pagemount();
  ready();
}

function protect($str) {
  $str = htmlspecialchars($str);
  $str = mysql_real_escape_string($str);
  return $str;
}

function url($link, $text) {
  global $home;
  return '<a href="'.$home.$link.'">'.$text.'</a>';
}

function t($str) {
  $str = mysql_real_escape_string($str);
  $qry = mysql_query("SELECT mostrar FROM cfg_translation WHERE original='$str' ORDER BY id DESC LIMIT 1");
  if(mysql_num_rows($qry)!=1) {
    mysql_query("INSERT INTO cfg_translation (`mostrar`, `original`) VALUES ('$str', '$str');");
    return stripslashes($str);
  } else {
    $qry = mysql_fetch_array($qry);
    return $qry['mostrar'];
  }
}

function siteerr($msg) {
  freesection('<p class="infobox">'.$msg.'</p>');
}

function titlebar($title) {
  return '<p class="titlebar"> &nbsp;'.$title.'</p>'."\n";
}

function infobox($msg, $auto=true, $stop=false) {
  if($auto==true) {
    siteerr($msg);
  } else {
    return '<p class="infobox">'.$msg.'</p>';
  }
  if($stop==true) {
    stop_here();
  }
}

function section($content, $title = null) {
  if(isset($_SESSION['swout'])) {
    $_SESSION['swout'] .= titlebar($title).$content;
  } else {
    $_SESSION['swout'] = titlebar($title).$content;
  }
}

function freesection($content) {
  if(isset($_SESSION['swout'])) {
    $_SESSION['swout'] .= $content;
  } else {
    $_SESSION['swout'] = $content;
  }
}

function swhead($content) {
  if(isset($_SESSION['swhead'])) {
    $_SESSION['swhead'] .= $content;
  } else {
    $_SESSION['swhead'] = $content;
  }
}

function redir($url) {
  global $home;
  echo '<script type="text/javascript">
  location.href="'.$home.$url.'";
  </script>';
  exit;
}

function ready() {
  $_SESSION['pagetitle'] = null;
  unset($_SESSION['pagetitle']);
  $_SESSION['swout'] = null;
  unset($_SESSION['swout']);
  $_SESSION['swhead'] = null;
  unset($_SESSION['swhead']);
  if(isset($_SESSION['random_txt']) AND !is_null($_SESSION['random_txt'])) {
    $_SESSION['random_txt'] = null;
    unset($_SESSION['random_txt']);
  }
  mysql_close();
  exit;
}

function pagemount() {
  $hook_esmaga = glob("mods/*");
  foreach($hook_esmaga AS $mod) {
    $modname = basename($mod);
    if(file_exists($mod.'/'.$modname.'.hooking.php')) {
      include($mod.'/'.$modname.'.hooking.php');
      if(function_exists($modname.'_hooking')) {
        eval($modname.'_hooking();');
      }
    }
  }
  include("libs/tpl.php");
}

function requirelogin() {
  if(!is_logged()) {
    redir("home");
  }
}

function onlyadmin() {
  requirelogin();
  if(!is_admin()) {
    redir("home");
    exit;
  }
}

function imageupload($arquivo){
  global $path;
  $ext = explode(".", $arquivo['name']);
  $ext = strtolower(end($ext));
  $permitidos = array("jpg", "jpeg");
  if(!in_array($ext, $permitidos)) {
    return false;
  } else {
    $file = $path."/upload/".uniqid().".".$ext;
    if(@move_uploaded_file($arquivo['tmp_name'], $file)) {
      $img  =imagecreatefromjpeg($file);
      $he = imagesx($img);
      $wi = imagesy($img);
      $x = ($he/100)*20;
      $y = ($wi/100)*20;

      $img_nova = imagecreatetruecolor($x, $y);
      imagecopyresampled($img_nova, $img, 0, 0, 0, 0, $x, $y, $he, $wi);
      $thumb = explode(".", $file);
      $thumb = $thumb[0]."_thumb.".$thumb[1];
      imagejpeg($img_nova, $thumb, 90);
      imagedestroy($img);
      imagedestroy($img_nova);
      $image['full'] = basename($file);
      $image['thumb'] = basename($thumb);
      return $image;
    } else {
      return false;
    }
  }
}

function ativaapp($name) {
  $qry = mysql_query("SELECT id FROM cfg_apps WHERE nome='$name'");
  if(mysql_num_rows($qry)!=0) {
    $query = mysql_query("UPDATE cfg_apps SET ativo='s' WHERE nome='$name'");
  } else {
    $query = mysql_query("INSERT INTO cfg_apps (`nome`, `ativo`) VALUES ('$name', 's');");
  }
  if($query) {
    return true;
  } else {
    return false;
  }
}

function addmenu($item, $url) {
  $qry = mysql_query("INSERT INTO cfg_menu (`item`, `url`) VALUES ('$item', '$url');");
  if($qry) {
    return true;
  } else {
    return false;
  }
}

function removemenu($url) {
  $qry = mysql_query("SELECT id FROM cfg_menu WHERE `url`='$url'");
  if(mysql_num_rows($qry)!=0) {
    $query = mysql_query("DELETE FROM cfg_menu WHERE `url`='$url'");
    if($query) {
      return true;
    } else {
      return false;
    }
  } else {
    return true;
  }
}

function mysql_table_exists($tablename) {
  $qry = mysql_query("SELECT * FROM $tablename");
  if(mysql_error()) {
    return false;
  } else {
    return true;
  }
}

function settitle($title) {
  $_SESSION['pagetitle'] = $title;
}

function captcha_init() {
  include("libs/captcha.php");
}

function bbcode($string) {
  require_once("libs/bbcode.php");
  return bbdecode($string);
}

function timestamp($data) {
  $partes = explode('/', $data);
  return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
}

function diasentre($data_inicial, $data_final="hoje") {
  if($data_final==="hoje")
  $data_final = date("d/m/Y");
  $time_inicial = timestamp($data_inicial);
  $time_final = timestamp($data_final);

  $diferenca = $time_final - $time_inicial;

  $dias = (int)floor( $diferenca / (60 * 60 * 24));

  return $dias;
}

function thumb($image) {
  $image = explode(".", $image);
  $ext = end($image);
  return $image[0].'_thumb.'.$ext;
}

function extenso($p_valor, $genero='m') {
        $p_len1 = strlen($p_valor)*2*$p_valor;
        $p_len1 = strlen($p_valor)*2*$p_valor;
        $f_trio = '000';
        if($genero=='f') {
          $f_num_19n[1] = 'Uma';
          $f_num_19n[2] = 'Duas';
        } else {
          $f_num_19n[1] = 'Um';
          $f_num_19n[2] = 'Dois';
        }
        // $f_num_19n[1] = 'Um';
        $f_num_19s[1] = '!!';
        // $f_num_19n[2] = 'Dois';
        $f_num_19s[2] = '!!!!';
        $f_num_19n[3] = 'Três';
        $f_num_19s[3] = '!!!!';
        $f_num_19n[4] = 'Quatro';
        $f_num_19s[4] = '!!.!!!';
        $f_num_19n[5] = 'Cinco';
        $f_num_19s[5] = '!!.!!';
        $f_num_19n[6] = 'Seis';
        $f_num_19s[6] = '!!!!';
        $f_num_19n[7] = 'Sete';
        $f_num_19s[7] = '!.!!'; 
        $f_num_19n[8] = 'Oito';
        $f_num_19s[8] = '!.!!';
        $f_num_19n[9] = 'Nove'; 
        $f_num_19s[9] = '!.!!'; 
        $f_num_19n[10] = 'Dez';
        $f_num_19s[10] = '!!!';
        $f_num_19n[11] = 'Onze';
        $f_num_19s[11] = '!.!!';
        $f_num_19n[12] = 'Doze';
        $f_num_19s[12] = '!.!!';
        $f_num_19n[13] = 'Treze';
        $f_num_19s[13] = '!!.!!';
        $f_num_19n[14] = 'Quatorze';
        $f_num_19s[14] = '!!.!!.!!';
        $f_num_19n[15] = 'Quinze';
        $f_num_19s[15] = '!!!.!!';
        $f_num_19n[16] = 'Dezesseis';
        $f_num_19s[16] = '!.!!.!!!!';
        $f_num_19n[17] = 'Dezessete';
        $f_num_19s[17] = '!.!!.!.!!';
        $f_num_19n[18] = 'Dezoito';
        $f_num_19s[18] = '!.!!.!!';
        $f_num_19n[19] = 'Dezenove';
        $f_num_19s[19] = '!.!.!.!!';

        $f_num_dzn[2] = 'Vinte';
        $f_num_dzs[2] = '!!.!!';
        $f_num_dzn[3] = 'Trinta';
        $f_num_dzs[3] = '!!!.!!';
        $f_num_dzn[4] = 'Quarenta';
        $f_num_dzs[4] = '!!.!!.!!';
        $f_num_dzn[5] = 'Cinquenta';
        $f_num_dzs[5] = '!!.!!!.!!';
        $f_num_dzn[6] = 'Sessenta';
        $f_num_dzs[6] = '!!.!!.!!';
        $f_num_dzn[7] = 'Setenta';
        $f_num_dzs[7] = '!.!!.!!';
        $f_num_dzn[8] = 'Oitenta';
        $f_num_dzs[8] = '!.!!.!!';
        $f_num_dzn[9] = 'Noventa';
        $f_num_dzs[9] = '!.!!.!!';

        $f_valor   = number_format($p_valor,2,'.','');
        $f_string1 = '';
        $f_string2 = '';
//  <<<<<   CENTAVOS   >>>>>
        if (substr($f_valor,-2,2)!='00') {                                                                                              // existe centavos
                $f_cent = substr($f_valor,-2,2);                                                                                        // quantos centavos
                if (substr($f_cent,-2,2)=='01') {                                                                                       // um centavo
                        $f_centav1 = 'Um Centavo';                                                                                              // preenche STRING do centavo
                        $f_centav2 = '!! !!.!.!!';                                                                                              // mascara de separacao silabica
                } else {                                                                                                                                        // mais de um centavo
                        $f_centav1 = ' Centavos';                                                                                               // final do STRING de centavos
                        $f_centav2 = ' !!.!.!!!';                                                                                               // mascara de separacao silabica
                        if ($f_cent>'01' and $f_cent<'20') {                                                                    // entre 2 e 19 cent. inclusive
                                $f_centav1=$f_num_19n[intval($f_cent)].$f_centav1;                                      // monta STRING de centavos
                                $f_centav2=$f_num_19s[intval($f_cent)].$f_centav2;                                      // mascara de separacao silabica
                        } else {                                                                                                                                // entre 20 e 99 cent. inclusive
                                if (substr($f_cent,-1,1)!='0') {                                                                        // tem unidade nos centavos
                                        $f_centav1=$f_num_19n[intval(substr($f_cent,-1,1))].$f_centav1; // monta STRING de unidade centavos
                                        $f_centav2=$f_num_19s[intval(substr($f_cent,-1,1))].$f_centav2; // mascara de separacao silabica de unidade centavos
                                }
                                if (substr($f_cent,-2,1)!='0') {                                                                        // tem dezena nos centavos
                                        if (substr($f_cent,-1,1)!='0') { $f_centav1=' e '.$f_centav1; } // inclui separa��o 'e'
                                        if (substr($f_cent,-1,1)!='0') { $f_centav2=' ! '.$f_centav2; } // separacao silabica
                                        $f_centav1=$f_num_dzn[intval(substr($f_cent,-2,1))].$f_centav1; // dezena de centavos
                                        $f_centav2=$f_num_dzs[intval(substr($f_cent,-2,1))].$f_centav2; // separacao silabica
                                }
                        }
                }
        } else {                                                                                                                                                // valor igual a zero
                $f_cent='00';                                                                                                                           // zera os centavos anteriores
        }

// <<<<<   REAIS   >>>>>

        $f_valor=str_repeat('0',12-strlen(substr($f_valor,0,-3))).substr($f_valor,0,-3); // somente a parte inteira
        if (intval($f_valor)>0) {                                                                                                                               // existem reais
                if ($f_cent>'00') {                                                                                                                     // possui centavos
                        $f_string1=' e '.$f_centav1;                                                                                    // monta string
                        $f_string2=' ! '.$f_centav2;                                                                                    // mascara separacao silabica
                }

                $f_trio=substr($f_valor,9,3);                                                                                           // 1� grupo (centena)
                if ($f_trio=='001') {                                                                                                           // um real
                        $f_string1='Um'.$f_string1;                                                                                // final do string de reais
                        $f_string2='!! !.!!'.$f_string2;                                                                                // mascara de separacao silabica
                        $f_cem='1';                                                                                                                             // houve centena
                } else {
                        $f_string1=''.$f_string1;                                                                                 // final do string de reais
                        $f_string2=' !.!!!'.$f_string2;                                                                                 // mascara de separacao silabica
                        $f_cem=f_centena($f_trio,$f_string1,$f_string2);                                                // trata centena de reais e retorna se houve centena
                }

                $f_trio=substr($f_valor,6,3);                                                                                           // 2� grupo (milhar)
                if ($f_trio>'000') {                                                                                                            // existe milhar
                        if ($f_cem=='1') {                                                                                                              // possui centena
                                $f_string1=', '.$f_string1;                                                                                     // monta string
                                $f_string2='! '.$f_string2;                                                                                     // mascara separacao silabica
                        }
                        if($f_trio=='001') {                                                                                                            // um mil reais
                                $f_string1='Um Mil'.$f_string1;                                                                         // final do string de reais
                                $f_string2='!! !!!'.$f_string2;                                                                         // mascara de separacao silabica
                                $f_mil='1';                                                                                                                     // houve milhar
                        } else {                                                                                                                                // milhar maior que 1
                                $f_string1=' Mil'.$f_string1;                                                                           // final do string de reais
                                $f_string2=' !!!'.$f_string2;                                                                           // mascara de separacao silabica
                                $f_mil=f_centena($f_trio,$f_string1,$f_string2);                                        // trata centena de reais e retorna se houve centena
                        }
                } else {                                                                                                                                        // trio igual a zero
                        $f_mil='0';                                                                                                                             // nao houve milhar
                }

                $f_trio=substr($f_valor,3,3);                                                                                           // 3� grupo (milhao)
                if ($f_trio>'000') {                                                                                                            // existe milhao
                        if ($f_cem=='1' or $f_mil=='1') {                                                                               // possui centena ou milhar
                                $f_string1=', '.$f_string1;                                                                                     // monta string
                                $f_string2='! '.$f_string2;                                                                                     // mascara separacao silabica
                        } else {                                                                                                                                // numero redondo (nnn.000.000)
                                $f_string1=' de'.$f_string1;                                                                            // monta string
                                $f_string2=' !!'.$f_string2;                                                                            // mascara separacao silabica
                        }
                        if ($f_trio=='001') {                                                                                                   // um real
                                $f_string1='Um Milhão'.$f_string1;                                                                      // final do string de reais
                                $f_string2='!! !.!!!!'.$f_string2;                                                                      // mascara de separacao silabica
                        } else {                                                                                                                                // milhar maior que 1
                                $f_string1=' Milhões'.$f_string1;                                                                       // final do string de reais
                                $f_string2=' !.!!!!!'.$f_string2;                                                                       // mascara de separacao silabica
                                $f_milh=f_centena($f_trio,$f_string1,$f_string2);                                       // trata centena de reais e retorna se houve centena
                        }
                } else {                                                                                                                                        // trio igual a zero
                        $f_milh='0';                                                                                                                    // nao houve milh�o
                }

                $f_trio = substr($f_valor,0,3);                                                                                         // 4� grupo (bilhao)
                if ($f_trio>'000') {                                                                                                            // existe bilhao
                        if ($f_cem=='1' or $f_mil=='1' or $f_milh=='1') {                                               // possui centena ou milhar ou milhao
                                $f_string1 = ', '.$f_string1;                                                                           // monta string
                                $f_string2 = '! '.$f_string2;                                                                           // mascara separacao silabica
                        } else {                                                                                                                                // numero redondo (nnn.000.000)
                                $f_string1 = ' de'.$f_string1;                                                                          // monta string
                                $f_string2 = ' !!'.$f_string2;                                                                          // mascara separacao silabica
                        }
                        if ($f_trio=='001') {                                                                                                   // um real
                                $f_string1 = 'Um Bilhão'.$f_string1;                                                            // final do string de reais
                                $f_string2 = '!! !.!!!!'.$f_string2;                                                            // mascara de separacao silabica
                        } else {                                                                                                                                // milhar maior que 1
                                $f_string1 = ' Bilhões'.$f_string1;                                                                     // final do string de reais
                                $f_string2 = ' !.!!!!!'.$f_string2;                                                                     // mascara de separacao silabica
                                $f_bilh=f_centena($f_trio,$f_string1,$f_string2);                                       // trata centena de reais e retorna se houve centena
                        }
                }

        } else if ($f_cent>'00') {                                                                                                              // existem centavos ?
                $f_string1 = $f_centav1;                                                                                                        // monta string
                $f_string2 = $f_centav2;                                                                                                        // mascara separacao silabica
        }
        $f_string1 = $f_string1;                                                // coloca valor entre paranteses
        //$f_string2 = '.'.$f_string2.'.';                                                // coloca valor entre paranteses
        if (strlen($f_string1)>$p_len1) {                                                                                               // estourou 1a. linha

// <<<<<   Separacao silabica   >>>>>
                if (substr($f_string2,$p_len1-1,1)=='.') {                                                                      // tamanho coincide c/ silaba
                        $f_num=$p_len1-1;                                                                                                               // tamanho da 1� linha (s/ '-')
                                                                                                                                                                        // coloca hifem na string               
                        $f_string1=substr($f_string1,1,$f_num).'-'.substr($f_string1,$f_num+1,strlen($f_string1)-$f_num);
                } else if (substr($f_string2,$p_len1,1)==' ') {                                                         // coincide com fim de palavra
                        $f_num=$p_len1;                                                                                                         // quebra igual ao tamanho
                } else {                                                                                                                                        // procura posicao da silaba
                        $f_num=$p_len1-1;                                                                                                               // inicia busca pelo default
                        $f_fim=0;                                                                                                                               // variavel de controle do loop
                        while ($f_fim==0) {                                                                                                             // ate achar silaba
                                if (substr($f_string2,$f_num-1,1)=='.') {                                                       // achou quebra de silaba
                                                                                                                                                                        // coloca hifem na string
                                        $f_string1=substr($f_string1,1,$f_num-1).'-'.str_repeat(' ',$p_len1-$f_num).substr($f_string1,$f_num,strlen($f_string1)-$f_num+1);
                                        $f_fim=1;                                                                                                               // string pronta
                                } else if (substr($f_string2,$f_num,1)==' ') {                                          // achou final de palavra
                                                                                                                                                                        //  ! preenche final da 1� linha
                                        $f_string1=substr($f_string1,1,$f_num).str_repeat(' ',$p_len1-$f_num).substr($f_string1,$f_num+1,strlen($f_string1)-$f_num);
                                        $f_fim=1;                                                                                                               // string pronta
                                } else {                                                                                                                        // continua a diminuir
                                        $f_num-=1;                                                                                                              // atualiza tamanho da linha
                                }
                        }
                }
        }
//        $f_string1=$f_string1.str_repeat('*',$p_len1+$p_len2-strlen($f_string1));               // preenche com asteristicos
        if($genero=="f") {
          $f_string1 = str_replace("Um", "Uma", $f_string1);
          $f_string1 = str_replace("Dois", "Duas", $f_string1);
        }
        return strtolower($f_string1);                                                                                                                    // retorna string formatada
}

function f_centena ( $p_trio, &$p_string1, &$p_string2) {                                                       // Tratamento das Centenas
        $f_num_19n[1] = 'Um';
        $f_num_19s[1] = '!!';
        $f_num_19n[2] = 'Dois';
        $f_num_19s[2] = '!!!!';
        $f_num_19n[3] = 'Três';
        $f_num_19s[3] = '!!!!';
        $f_num_19n[4] = 'Quatro';
        $f_num_19s[4] = '!!.!!!';
        $f_num_19n[5] = 'Cinco';
        $f_num_19s[5] = '!!.!!';
        $f_num_19n[6] = 'Seis';
        $f_num_19s[6] = '!!!!';
        $f_num_19n[7] = 'Sete';
        $f_num_19s[7] = '!.!!'; 
        $f_num_19n[8] = 'Oito';
        $f_num_19s[8] = '!.!!';
        $f_num_19n[9] = 'Nove'; 
        $f_num_19s[9] = '!.!!'; 
        $f_num_19n[10] = 'Dez';
        $f_num_19s[10] = '!!!';
        $f_num_19n[11] = 'Onze';
        $f_num_19s[11] = '!.!!';
        $f_num_19n[12] = 'Doze';
        $f_num_19s[12] = '!.!!';
        $f_num_19n[13] = 'Treze';
        $f_num_19s[13] = '!!.!!';
        $f_num_19n[14] = 'Quatorze';
        $f_num_19s[14] = '!!.!!.!!';
        $f_num_19n[15] = 'Quinze';
        $f_num_19s[15] = '!!!.!!';
        $f_num_19n[16] = 'Dezesseis';
        $f_num_19s[16] = '!.!!.!!!!';
        $f_num_19n[17] = 'Dezessete';
        $f_num_19s[17] = '!.!!.!.!!';
        $f_num_19n[18] = 'Dezoito';
        $f_num_19s[18] = '!.!!.!!';
        $f_num_19n[19] = 'Dezenove';
        $f_num_19s[19] = '!.!.!.!!';

        $f_num_dzn[2] = 'Vinte';
        $f_num_dzs[2] = '!!.!!';
        $f_num_dzn[3] = 'Trinta';
        $f_num_dzs[3] = '!!!.!!';
        $f_num_dzn[4] = 'Quarenta';
        $f_num_dzs[4] = '!!.!!.!!';
        $f_num_dzn[5] = 'Cinquenta';
        $f_num_dzs[5] = '!!.!!!.!!';
        $f_num_dzn[6] = 'Sessenta';
        $f_num_dzs[6] = '!!.!!.!!';
        $f_num_dzn[7] = 'Setenta';
        $f_num_dzs[7] = '!.!!.!!';
        $f_num_dzn[8] = 'Oitenta';
        $f_num_dzs[8] = '!.!!.!!';
        $f_num_dzn[9] = 'Noventa';
        $f_num_dzs[9] = '!.!!.!!';

        $f_num_ctn[1] = 'Cento';
        $f_num_cts[1] = '!!.!!';
        $f_num_ctn[2] = 'Duzentos';
        $f_num_cts[2] = '!.!!.!!!';
        $f_num_ctn[3] = 'Trezentos' ;
        $f_num_cts[3] = '!!.!!.!!!' ;
        $f_num_ctn[4] = 'Quatrocentos';
        $f_num_cts[4] = '!!.!!.!!.!!!';
        $f_num_ctn[5] = 'Quinhentos';
        $f_num_cts[5] = '!!.!!!.!!!';
        $f_num_ctn[6] = 'Seiscentos';
        $f_num_cts[6] = '!.!.!!.!!!';
        $f_num_ctn[7] = 'Setecentos';
        $f_num_cts[7] = '!.!.!!.!!!';
        $f_num_ctn[8] = 'Oitocentos';
        $f_num_cts[8] = '!.!.!!.!!!';
        $f_num_ctn[9] = 'Novecentos';
        $f_num_cts[9] = '!.!.!!.!!!';
        if ($p_trio=='100') {                                                                                                                           // trio = 100
                $f_prov1='Cem';                                                                                                                                 // monta string
                $f_prov2='!!!';                                                                                                                                 // monta mascara
        } else {                                                                                                                                                        // possui centena
                if ($p_trio>'100') {                                                                                                                    // valor acima de 100
                        $f_prov1=$f_num_ctn[intval(substr($p_trio,0,1))];                                                       // monta STRING provisoria
                        $f_prov2=$f_num_cts[intval(substr($p_trio,0,1))];                                                       // mascara provisoria
                        $f_e=1;                                                                                                                                         // existiu centena no trio
                } else {                                                                                                                                                // valor abaixo de 100
                        $f_prov1='';                                                                                                                            // monta STRING provisoria
                        $f_prov2='';                                                                                                                            // mascara provisoria
                        $f_e=0;                                                                                                                                         // nao existiu centena no trio
                }
        }
        if (substr($p_trio,1,2)>'00') {                                                                                                         // possui dezena
                if ($f_e>0) {                                                                                                                                   // checa se precisa do ' e '
                        $f_prov1=$f_prov1.' e';                                                                                                         // monta string provisoria
                        $f_prov2=$f_prov2.' !';                                                                                                         // mascara provisoria
                }
                if (substr($p_trio,1,2)>'19') {                                                                                                 // possui dezena entre 20 e 99
                        $f_prov1=$f_prov1.' '.$f_num_dzn[intval(substr($p_trio,1,1))];                          // dezena
                        $f_prov2=$f_prov2.' '.$f_num_dzs[intval(substr($p_trio,1,1))];                          // mascara
                        if (substr($p_trio,2,1)!='0') {                                                                                         // existe unidade
                                $f_prov1=$f_prov1.' e '.$f_num_19n[intval(substr($p_trio,2,1))];                // unidade
                                $f_prov2=$f_prov2.' ! '.$f_num_19s[intval(substr($p_trio,2,1))];                // mascara
                        }
                } else {                                                                                                                                                // possui dezena entre 01 e 19
                        $f_prov1=$f_prov1.' '.$f_num_19n[intval(substr($p_trio,1,2))];                          // dezena
                        $f_prov2=$f_prov2.' '.$f_num_19s[intval(substr($p_trio,1,2))];                          // mascara
                }
        }
        if ($f_prov1=='') {                                                                                                                                     // string esta em branco
                $f_sim='0';                                                                                                                                             // nao houve esta centena
        } else {                                                                                                                                                        // existe texto
                $f_sim='1';                                                                                                                                             // houve esta centena
        }
        $p_string1=$f_prov1.$p_string1;                                                                                                         // string final
        $p_string2=$f_prov2.$p_string2;   # olha o número dessa linha
        return strtolower($f_sim);
}

function note($content, $id) {
  $content = mysql_real_escape_string($content);
  $id = is_numeric($id) ? $id : $_SESSION['id'];
  $qry = mysql_query("INSERT INTO notes (`account`, `content`)
               VALUES ('$id', '$content');");
  if($qry) {
    return true;
  } else {
    return false;
  }
}

function delnote($id) {
  $qry = mysql_query("DELETE FROM notes WHERE id='$id'");
  if($qry) {
    return true;
  } else {
    return false;
  }
}

function resolveuser($user) {
  $user = mysql_real_escape_string($user).
  $qry = mysql_query("SELECT id FROM accounts WHERE login='$user'");
  if(mysql_numrows($qry)==1) {
    $qry = mysql_fetch_array($qry);
    return $qry['id'];
  } else {
    return false;
  }
}

function validuser($user, $type='id') { // type: id or login 
  if($type==='login') {
    if(resolveuser($user)) {
      return true;
    } else {
      return false;
    }
  } else {
    $user = mysql_real_escape_string($user);
    $qry = mysql_query("SELECT * FROM accounts WHERE id='$user'");
    if(mysql_numrows($qry)==1) {
      return true;
    } else {
      return false;
    }
  }
}

function friends($id1, $id2) {
  $qry = mysql_query("SELECT * FROM friends WHERE (`id1`='$id1' AND `id2`='$id2') OR (`id1`='$id2' AND `id2`='$id1')");
  if(mysql_numrows($qry)==1) {
    return true;
  } else {
    return false;
  }
}

function cleanstring($string) {
  $permite = 'a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,0,1,2,3,4,5,6,7,8,9';
  $permite = explode(",", $permite);
  $strlength = strlen($string);
  $newstr = null;
  $i = 0;
  while($i<=$strlength) {
    if(in_array(strtolower($string[$i]), $permite)) {
      $newstr .= $string[$i];
    }
    $i++;
  }
  return $newstr;
}

function mysql_all_query($qry) {
  $qry = explode(";", $qry);
  $i = 0;
  $j = count($qry);
  while($i<=$j) {
    mysql_query($qry[$i]);
    $i++;
  }
}

function syntax($code) {
  return str_replace('?&gt;', null, (str_replace('&lt;?&nbsp;', null, highlight_string('<? '.$code.' ?>', true))));
}