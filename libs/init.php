<?php

$version = '2.2';

if($ocultarerros) {
  error_reporting(0);
}

if(file_exists("install.php")) {
  die('<script> location.href="install.php"; </script>');
}

@mysql_connect($db['host'], $db['user'], $db['pass']) or syserr('Não foi possível efetuar a conexão ao banco de dados. Verifique disponibilidade e credenciais do servidor.');
@mysql_set_charset('utf8');
@mysql_select_db($db['name']) or syserr('Não foi possível selecionar a base de dados '.$db['name'].'. No entanto, a conexão foi bem sucedida.');
mysql_query("SET NAMES utf8");

$site = mysql_fetch_array(mysql_query("SELECT * FROM cfg_site LIMIT 1"));

if($home==='normal') {
  $home = $url.'/index.php?p=';
}
elseif($home==='simples') {
  $home = $url.'/?p=';
}
elseif($home==='amigavel') {
  $home = $url.'/';
} else {
  syserr("Modo desconhecido para \$home (no arquivo de configurações. Leia a documentação (seção Configurações) para mais detalhes.");
}