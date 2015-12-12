<?php
/*
SoclWAP config file 
*/

$db['host'] = "localhost";
$db['user'] = "";
$db['pass'] = "";
$db['name'] = "";

$dateformat = "d/m/Y";
$timeformat = "d/m/Y H:i:s";

$admin_email = "seu@email.com";

$url = '';

$home = 'amigavel';
/* Opções disponíveis para $home:
amigavel
  http://seusite/aplicativo/acao

simples
  http://seusite/?p=aplicativo/acao

normal
  http://seusite/index.php?p=aplicativo/acao

Obs.: O modo "amigavel" requer RewriteModule. */

$path = '';

$page_charset = "UTF-8";

$site_id = '';

$senha_universal = '';

$ocultarerros = true; // coloque false para exibir todos os erros (debugmode)