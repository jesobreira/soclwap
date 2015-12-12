<?php
$app['name'] = "Comunidade";
$app['desc'] = "Comunidade SW";

function comu_install() {
  mysql_all_query("DROP TABLE IF EXISTS `comunidade`;
CREATE TABLE `comunidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` char(1) NOT NULL COMMENT 'm ou t',
  `nome` varchar(255) NOT NULL,
  `descricao` text,
  `imagem` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;");
  addmenu("Módulos e temas", "comu");
}