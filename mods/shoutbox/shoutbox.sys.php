<?php
$app['name'] = "Shoutbox";
$app['desc'] = "Permite que seus usuários compartilhem mensagens públicas.";

function shoutbox_install() {
  mysql_all_query("DROP TABLE IF EXISTS `shoutbox`;
CREATE TABLE IF NOT EXISTS `shoutbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `text` text NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;");
  addmenu("Shoutbox", "shoutbox");
}

function shoutbox_uninstall() {
  removemenu("shoutbox");
}
?>