<?php
session_start();
ignore_user_abort(true);
include("inc/config.php");
ini_set("default_charset", $page_charset);
header("Content-type: text/html; charset=$page_charset");

include("libs/common.php");

boot(); // load
ready(); // finish
?>