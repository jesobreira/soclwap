<?php
function menu($user) {
    $output = "<p class=\"submenu\">".url("user/profile/$user", t("Perfil"))." | ";
  $output .= url("user/notes/$user", t("Notificações"))." | ";
  $output .= url("friends/lista/$user", t("Amigos"))." | ";
  $output .= url("photos/lista/$user", t("Fotos"))." | ";
  $output .= url("videos/lista/$user", t("Vídeos"))." | ";
  $output .= url("blog/lista/$user", t("Blog"))." | ";
  $output .= url("groups/lista/$user", t("Grupos"))." | ";
  $output .= url("message/lista/$user", t("Mensagens"))."</p><br>";
  return $output;
}
