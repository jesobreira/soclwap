<?php
function resolvegroup($group) {
  $group = protect($group);
  $qry = mysql_query("SELECT * FROM groups WHERE `url`='$group'");
  if(mysql_numrows($qry)!=0) {
    return mysql_fetch_array($qry);
  } else {
    infobox(t("Grupo inexistente."), true, true);
  }
}

function estounogrupo($group) {
  $qry = mysql_query("SELECT `id` FROM groups_join WHERE `account`='$_SESSION[id]' AND `group`='$group'");
  if(mysql_numrows($qry)!=0) {
    return true;
  } else {
    return false;
  }
}
?>