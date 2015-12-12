<?php
$app['name'] = "Mini Jogos";
$app['desc'] = "Jogos clássicos para seu site.";

function minijogos_install() {
  addmenu("Jogos", "minijogos");
}

function minijogos_uninstall() {
  removemenu("minijogos");
}
?>