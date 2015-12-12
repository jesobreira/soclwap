<?php
$qry = mysql_query("SELECT `name` FROM cfg_tpl WHERE selected='s' LIMIT 1");
$qry = mysql_fetch_array($qry);
$tpl_file = "tpl/$qry[name]/page.tpl.php";
if(!file_exists($tpl_file)) {
  if(file_exists("tpl/default/page.tpl.php")) {
    admail("Erro nos temas de seu website", "Você configurou um tema para sua cópia do SoclWAP, mas o diretório deste tema não existe mais.<br>
    O SoclWAP configurou automaticamente o tema do seu site para o tema \"default\".");
    mysql_query("DELETE FROM cfg_tpl");
    mysql_query("INSERT INTO cfg_tpl VALUES ('', 'default', 's');");
    $tpl_file = "tpl/default/page.tpl.php";
    $qry['name'] = "default";
  } else {
    syserr("Não há tema selecionado. <br>Vá até o <a href=\"http://soclwap.sourceforge.net\" target=\"_blank\">website do SoclWAP</a> e baixe o tema \"default\".");
  }
}

//$site = mysql_fetch_array(mysql_query("SELECT * FROM cfg_site LIMIT 1"));

function power() {
  $_SESSION['pw'] = 'y';
  echo base64_decode("UG93ZXJlZCBieSA8YSANCmhyZWY9Imh0dHA6Ly9zb2Nsd2FwLnNvdXJjZWZvcmdlLm5ldC8iIA0KdGFyZ2V0PSJfYmxhbmsiPlNvY2xXQVA8L2E+");
}

/*function section($content, $title = null) {
  if(isset($_SESSION['swout'])) {
    $_SESSION['swout'] .= $content;
  } else {
    $_SESSION['swout'] = $content;
  }
}*/

$test = file_get_contents("tpl/$qry[name]/page.tpl.php");
if(!strpos($test, '<?php tm(\'power\'); ?>') AND !strpos($test, '<?php tm("power"); ?>')) {
  syserr(base64_decode("RXN0ZSBzaXRlIG7jbyBwb2RlIHNlciBhY2Vzc2FkbyBwb3JxdWUgbyANCmFkbWluaXN0cmFkb3IgdGVudG91IHJlbW92ZXIgYSBhdHJpYnVp5+NvIGRlIHVzbyBkbyBzaXN0ZW1hIFNvY2xXQVAu"));
}
unset($test);

function tm($cnt) {
  global $site;
  if($cnt==='site_logo') {
    echo $site['site_logo'];
  }
  elseif($cnt==='site_name') {
    echo $site['site_name'];
  }
  elseif($cnt==='power') {
    power();
  }
  elseif($cnt==='title') {
    if(isset($_SESSION['pagetitle']) AND !is_null($_SESSION['pagetitle'])) {
      echo $_SESSION['pagetitle'];
    } else {
      echo $site['site_name'];
    }
  }
  elseif($cnt==='footer') {
    if(is_logged()) {
      
    } else {
      echo 'Copyright &copy; '.date("Y").' '.$site['name'];
    }
  }
  elseif($cnt==='menu') {
    if(!is_logged()) {
      echo url('account/login', t('Login'))."&nbsp;\n";
      echo url('account/signup', t('Cadastro'));
    } else {
      $qry = mysql_query("SELECT item,url FROM cfg_menu ORDER BY `order`");
      echo url("home", t("Home"))."&nbsp;\n";
      if(mysql_num_rows($qry)!=0) {
        while($row = mysql_fetch_array($qry)) {
          echo url($row['url'], t($row['item']))."&nbsp;\n";
        }
      }
      if(is_admin()) {
        echo url("admin", t("Administração"))."&nbsp;\n";
      }
      echo url("account/modify", t("Minha conta"))."&nbsp;\n";
      echo url("account/logout", t("Sair"))."&nbsp;\n";
    }
  }
  elseif($cnt==='content') {
    echo $_SESSION['swout'];
  }
  elseif($cnt==='head') {
    echo $_SESSION['swhead'];
  }
}
include($tpl_file);
if($_SESSION['pw']!='y') {
  syserr(base64_decode("RXN0ZSBzaXRlIG7jbyBwb2RlIHNlciBhY2Vzc2FkbyBwb3JxdWUgbyANCmFkbWluaXN0cmFkb3IgdGVudG91IHJlbW92ZXIgYSBhdHJpYnVp5+NvIGRlIHVzbyBkbyBzaXN0ZW1hIFNvY2xXQVAu"));
}
?>