<?php
$app['name'] = "Busca";
$app['desc'] = "Formulário de busca para usuários e grupos.";

function search_install() {
  addmenu("Busca", "search");
}

function search_uninstall() {
  removemenu("search");
}