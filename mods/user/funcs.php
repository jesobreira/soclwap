<?php
include("libs/accounts.php");
function primeironome($nome) {
  $nome = explode(" ", $nome);
  return $nome[0];
}
