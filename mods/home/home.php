<?php
function index() {
  if(is_logged()) {
    redir("dashboard");
  } else {
    redir("account/login");
  }
}
?>