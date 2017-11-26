#
# TABLE STRUCTURE FOR: account
#

DROP TABLE IF EXISTS `account`;

CREATE TABLE `account` (
  `id` int(20) unsigned NOT NULL auto_increment,
  `Muser` varchar(45) NOT NULL,
  `Mpassword` varchar(250) NOT NULL,
  `Mpattern` varchar(250) NOT NULL,
  `salt` varchar(80) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO `account` (`id`, `Muser`, `Mpassword`, `Mpattern`, `salt`) VALUES ('1', 'drigox90rih@gmail.com', '1805c7c0378e17f857a3d3f1d616aa4e38928750', '12345', '2PR3JU4TRZ');
INSERT INTO `account` (`id`, `Muser`, `Mpassword`, `Mpattern`, `salt`) VALUES ('3', 'rifacodemakers2015@gmail.com', 'ac1ab23d6288711be64a25bf13432baf1e60b2bd', '12345', '1NTKPO6NGW');
INSERT INTO `account` (`id`, `Muser`, `Mpassword`, `Mpattern`, `salt`) VALUES ('5', 'rodrigo.ediaz.f@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '67890', 'XQU2TYWX0W');
INSERT INTO `account` (`id`, `Muser`, `Mpassword`, `Mpattern`, `salt`) VALUES ('6', 'test321@gmail.com', '96f7453cfb71dee8d6d48c823af58dc3a1d7f952', '12344321', 'J22J');
INSERT INTO `account` (`id`, `Muser`, `Mpassword`, `Mpattern`, `salt`) VALUES ('10', 'rodiaz@openmailbox.org', '7c222fb2927d828af22f592134e8932480637c0d', '12344321', 'VUYNDNSC7K');


#
# TABLE STRUCTURE FOR: registry
#

DROP TABLE IF EXISTS `registry`;

CREATE TABLE `registry` (
  `id` int(20) unsigned NOT NULL auto_increment,
  `idServ` int(20) unsigned NOT NULL,
  `fieldname` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_id_serv` (`idServ`),
  CONSTRAINT `registry_ibfk_1` FOREIGN KEY (`idServ`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: service
#

DROP TABLE IF EXISTS `service`;

CREATE TABLE `service` (
  `id` int(20) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `topic` varchar(25) NOT NULL,
  `desc` varchar(200) default NULL,
  `approved` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('1', 'Twitter', 'https://twitter.com/', 'Red Social', 'Red social para socializar por textos', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('2', 'Facebook', 'https://www.facebook.com/', 'Red Social', 'Otra red social mas adictiva', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('3', 'Linkedin', 'https://www.linkedin.com/', 'Red Social', 'Otra red para pegas', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('4', 'Tibia', 'https://secure.tibia.com/account/?subtopic=account', 'Juego', 'Juego MMORPG con graficos 2D y otras cosas más', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('9', 'Empleos UACh', 'http://empleos.uach.cl/verofertas.cfm?ofertas=excl', 'Plataforma', 'Plataforma CV y Empleos UACh', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('10', 'Gmail', 'https://www.gmail.com', 'Servicio Correo', 'Servicio de correos de google', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('11', 'IContem', 'https://accounts.icontem.com/login', 'Programming', 'Cuenta para ingresar a PHPClasses y JSClasses', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('12', 'LastPass', 'https://lastpass.com/?ac=1&lpnorefresh=1', 'Gestor Contrasena', 'Gestor de contrasena, la competencia.', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('13', 'Generico', 'www.generico.com', 'Generico', 'Servicio Generico', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('14', 'BancoEstado', 'https://www.bancoestado.cl/imagenes/comun2008/nuev', 'Bancario', 'Cuenta bancaria, use con precaución', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('15', 'MasterCard', 'http://www.mastercard.com/cl/consumidores/index.ht', 'Tarjeta de Credito', 'Tarjeta de crédito MasterCard', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('16', 'Hotmail', 'http://www.hotmail.com', 'Servicio Correo', 'Servicio de correo Outlook de Windows', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('17', 'Openmailbox', 'https://www.openmailbox.org/webmail/?_task=mail', 'Servicio Correo', 'Servicio de Correo OpenSource', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('18', 'Oracle', 'https://login.oracle.com/mysso/signon.jsp', 'Programming', 'Suite de aplicaciones de desarrollo de software', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('19', 'Uach Siveduc', 'https://secure02.uach.cl/infoalumnos/CheqLogin.asp', 'Educacional', 'Plataforma de recursos educacionales de UACh', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('20', 'Telefonica del Sur', 'http://telefonicadelsur.cl/', 'Telefonía', 'Servicio de Telefonía en Chile', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('21', 'Movistar', 'http://www.movistar.cl', 'Telefonía', 'Servicio de Telefonía en Chile', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('22', 'Entel', 'http://www.entel.cl/', 'Telefonía', 'Servicio de Telefonía en Chile', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('23', 'Spotify', 'https://accounts.spotify.com/es/login?continue=htt', 'Streaming', 'Servicio streaming de música', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('24', '9gag', 'http://9gag.com/', 'Mensajería Instantánea', 'Chat para pagina de Humor gringo 9gag', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('25', 'USS', 'http://miportal.uss.cl/prehome/', 'Educacional', 'Plataforma de recursos educacionales de USS', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('26', 'Inacap', 'https://www.inacap.cl/tportalvp/alumnos', 'Educacional', 'Plataforma de recursos educacionales de Inacap', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('27', 'Chw', 'http://www.chw.net/foro/', 'Foro', 'Plataforma de comunidad de temas  varios', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('28', 'Portalnet', 'http://www.portalnet.cl/', 'Foro', 'Plataforma de comunidad de temas  varios', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('29', 'Fmat', 'http://www.fmat.cl/index.php?act=Login&CODE=00', 'Educacional', 'Portal y comunidad relacionado a las matemáticas', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('30', 'Dalealbo', 'http://www.dalealbo.cl/foro/', 'Foro', 'Portal y comunidad de la hinchada alba', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('31', 'Taringa', 'https://www.taringa.net/login?redirect=/', 'Foro', 'Plataforma con recursos a descargar de temas varios ché', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('32', 'Skype', 'https://login.skype.com/login', 'Mensajería Instantánea', 'Servicio de mensajería y videollamadas del sr Windows', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('33', 'Caoh Project', 'http://www.caoh.cl/foro/ucp.php?mode=login', 'Juego', 'Plataforma para el acceso al juego de cartas pokemon', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('34', 'Yapo', 'http://www.yapo.cl/', 'Plataforma Web', 'Plataforma de compra y venta de productos en linea', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('35', 'UST', 'https://millave.santotomas.cl/idp/Authn/UserPasswo', 'Educacional', 'Plataforma de recursos educacionales de Santo Tomas', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('36', 'Microsoft Windows', 'https://www.microsoft.com/', 'Sistema Operativo', 'Cuenta de Microsoft y sus productos.', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('37', 'GitHub', 'https://github.com/login', 'Repositorio', 'Repositorio de proyectos', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('38', 'Wordpress', 'https://en.wordpress.com/wp-login.php', 'Framework', 'Framework gestor de contenidos web', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('39', 'Dropbox', 'https://www.dropbox.com/login', 'Almacenamiento en Nube', 'Dropbox carpeta de almacenamiento compartido en la nube.', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('40', 'Bitbucket', 'https://bitbucket.org/account/signin/', 'Repositorio', 'Repositorio control de versiones', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('41', 'JSFiddle', 'http://jsfiddle.net/user/login/', 'Programming', 'Online coding of web applications', '1');
INSERT INTO `service` (`id`, `name`, `url`, `topic`, `desc`, `approved`) VALUES ('42', 'AFP Capital', 'https://www.afpcapital.cl/Paginas/default.aspx', 'AFP', 'Cuenta AFP Capital', '1');


#
# TABLE STRUCTURE FOR: test
#

DROP TABLE IF EXISTS `test`;

CREATE TABLE `test` (
  `id` int(10) NOT NULL auto_increment,
  `valor` enum('0','1','2','3','4','5','6','7','8','9','10') collate utf8_spanish_ci default '2',
  `nombre` varchar(100) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `test` (`id`, `valor`, `nombre`) VALUES ('1', '2', 'qwe');
INSERT INTO `test` (`id`, `valor`, `nombre`) VALUES ('2', '2', 'wuytr2');
INSERT INTO `test` (`id`, `valor`, `nombre`) VALUES ('3', '5', '2rte');
INSERT INTO `test` (`id`, `valor`, `nombre`) VALUES ('4', '4', 'sdcd');
INSERT INTO `test` (`id`, `valor`, `nombre`) VALUES ('13', '', '¥ô7ÿQ..Ã¿²ÌçÓßÈ<Üç6i£Ý¸');
INSERT INTO `test` (`id`, `valor`, `nombre`) VALUES ('14', '', '¥ô7ÿQ..Ã¿²ÌçÓßÈ<Üç6i£Ý¸ü½¤ƒþwa\ZAEŒƒ*’ªM²×fí');
INSERT INTO `test` (`id`, `valor`, `nombre`) VALUES ('15', '', '¥ô7ÿQ..Ã¿²ÌçÓßÈ<Üç6i£Ý¸ü½¤ƒþwa\ZAEŒƒ*’ªM²×fí');
INSERT INTO `test` (`id`, `valor`, `nombre`) VALUES ('16', '', '¥ô7ÿQ..Ã¿²ÌçÓßÈ<Üç6i£Ý¸ü½¤ƒþwa\ZAEŒƒ*’ªM²×fí');


#
# TABLE STRUCTURE FOR: vinculation_accountservice
#

DROP TABLE IF EXISTS `vinculation_accountservice`;

CREATE TABLE `vinculation_accountservice` (
  `id` int(20) unsigned NOT NULL auto_increment,
  `idAcc` int(20) unsigned NOT NULL,
  `idServ` int(20) unsigned NOT NULL,
  `status` enum('000','001','010','011','100','101','110','111') NOT NULL default '100',
  `valuation` enum('1','2','3','4','5','6','7','8','9','10') NOT NULL default '10',
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `oldpassword` varchar(200) NOT NULL,
  `notes` varchar(200) NOT NULL COMMENT 'info adicional del servicio',
  `created` datetime NOT NULL,
  `lastVisited` datetime NOT NULL,
  `times` int(20) NOT NULL default '0',
  `lastChangedPwd` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_idacc` (`idAcc`),
  KEY `fk_idserv` (`idServ`),
  CONSTRAINT `vinculation_accountservice_ibfk_1` FOREIGN KEY (`idAcc`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vinculation_accountservice_ibfk_2` FOREIGN KEY (`idServ`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('1', '5', '3', '001', '10', 'userlkin', '2XO-V#0E2]Ve[]S', '2XO-V#0E2]Ve[]S', '', '2015-07-26 13:07:38', '2015-08-20 18:57:04', '5', '2015-08-11 22:41:46');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('2', '5', '2', '000', '9', 'fbuser', '}-lAo+z2#cF{9-x', '7a:B3Z2c$BAv9', '', '2015-07-26 13:12:17', '2015-08-05 17:43:58', '2', '2015-08-20 20:44:49');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('3', '5', '9', '001', '10', 'rodrigoedf', 'redf1990', 'redf1990', '', '2015-08-04 22:04:47', '2015-08-06 20:35:58', '2', '2015-08-04 22:04:47');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('7', '5', '4', '001', '8', 'sdfghj', 'Vhw4$,5,J$v,gs]', 'Vhw4$,5,J$v,gs]', '', '2015-08-06 20:05:37', '2015-08-06 20:05:37', '0', '2015-08-07 04:01:47');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('8', '5', '11', '001', '5', 'rodrihgo', 'purack321', 'purack321', '', '2015-08-11 22:02:41', '2015-08-11 22:02:41', '0', '2015-08-11 22:02:41');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('9', '5', '16', '001', '5', 'rodrigo_1990_vald@hotmail.com', 'Rih90asdfzxz', 'Rih90asdfzxz', '', '2015-08-20 19:20:57', '2015-08-20 19:20:57', '0', '2015-08-20 19:20:57');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('13', '10', '1', '101', '5', 'RodrigoxRih', 'purack321', 'purack321', '', '2015-08-20 21:32:03', '2015-08-20 21:32:03', '0', '2015-08-20 21:32:03');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('14', '10', '16', '001', '5', 'rodrigo_1990_vald@hotmail.com', 'Rih90asdfzxz', 'Rih90asdfzxz', '', '2015-08-20 21:32:34', '2015-08-25 01:18:39', '1', '2015-08-20 21:32:34');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('15', '10', '2', '001', '7', 'rodrigo_1990_vald@hotmail.com', 'Purack112233', 'Purack112233', 'mi fb de verdad D;', '2015-08-20 21:33:04', '2015-08-20 21:33:04', '0', '2015-08-20 21:33:04');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('16', '10', '3', '101', '5', 'drigox90rih@gmail.com', 'purack321', 'purack321', '', '2015-08-20 21:34:34', '2015-08-20 21:34:34', '0', '2015-08-20 21:34:34');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('17', '10', '4', '101', '8', 'nahuelmax17', 'iciuach90rk', 'iciuach90rk', '', '2015-08-20 21:35:50', '2015-08-20 21:35:50', '0', '2015-08-20 21:35:50');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('18', '10', '9', '101', '8', 'rodrigoedf', 'redf1990', 'redf1990', '', '2015-08-20 21:38:47', '2015-08-27 22:36:32', '2', '2015-08-20 21:38:47');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('19', '10', '10', '001', '10', 'drigox90rih@gmail.com', 'zaidogir1478653z', 'zaidogir1478653z', '', '2015-08-20 21:39:58', '2015-08-25 01:18:42', '1', '2015-08-20 21:39:58');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('20', '10', '11', '101', '5', 'rodrihgo', 'purack321', 'purack321', '', '2015-08-20 22:52:57', '2015-08-20 22:52:57', '0', '2015-08-20 22:52:57');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('21', '10', '12', '101', '5', 'drigox90rih@gmail.com', 'lastpass2015', 'lastpass2015', '', '2015-08-20 22:57:45', '2015-08-20 22:57:45', '0', '2015-08-20 22:57:45');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('22', '10', '17', '101', '6', 'rodiaz@openmailbox.org', 'purack321', 'purack321', '', '2015-08-20 22:59:27', '2015-08-20 22:59:27', '0', '2015-08-20 22:59:27');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('23', '10', '18', '101', '4', 'drigox90rih@gmail.com', 'Oraclepurack321', 'Oraclepurack321', '', '2015-08-20 23:05:27', '2015-08-20 23:05:27', '0', '2015-08-20 23:05:27');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('24', '10', '19', '101', '8', '17693225-2', 'redf1890', 'redf1890', '', '2015-08-20 23:07:35', '2015-08-20 23:07:35', '0', '2015-08-20 23:07:35');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('25', '10', '24', '101', '5', 'drigox90rih@gmail.com', '9gagpurack321', '9gagpurack321', '', '2015-08-20 23:15:29', '2015-08-20 23:15:29', '0', '2015-08-20 23:15:29');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('26', '10', '29', '101', '7', 'rih', '6252ee636291538', '6252ee636291538', '', '2015-08-20 23:18:22', '2015-08-20 23:18:22', '0', '2015-08-20 23:18:22');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('27', '10', '31', '101', '4', 'Rih90', 'Taringapurack321', 'Taringapurack321', '', '2015-08-20 23:21:48', '2015-08-20 23:21:48', '0', '2015-08-20 23:21:48');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('28', '10', '37', '001', '5', 'Rih', 'Githubpurack321', 'Githubpurack321', '', '2015-08-21 00:50:07', '2015-08-21 00:50:07', '0', '2015-08-21 00:50:07');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('29', '10', '38', '001', '6', 'rihdark', 'uWwP2cMpH9!3@Xd7pzmRrR4jX3', 'uWwP2cMpH9!3@Xd7pzmRrR4jX3', '', '2015-08-21 01:01:00', '2015-08-21 01:01:00', '0', '2015-08-21 01:01:00');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('30', '10', '39', '001', '7', 'rodrigo.ediaz.f@gmail.com', 'purack321', 'purack321', '', '2015-08-21 01:22:19', '2015-08-21 01:22:19', '0', '2015-08-21 01:22:19');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('31', '10', '39', '001', '7', 'drigox90rih@gmail.com', 'purack321', 'purack321', '', '2015-08-21 01:22:44', '2015-08-21 01:22:44', '0', '2015-08-21 01:22:44');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('32', '10', '40', '001', '7', 'rodrihgo', 'bitbucketpurack321', 'bitbucketpurack321', '', '2015-08-23 16:38:35', '2015-08-23 16:38:35', '0', '2015-08-23 16:38:35');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('33', '10', '41', '001', '5', 'rodrihgo', 'jsfiddlepurack321', 'jsfiddlepurack321', 'notes de ejemplo asdf', '2015-08-23 17:19:18', '2015-08-23 17:19:18', '0', '2015-08-23 17:19:18');
INSERT INTO `vinculation_accountservice` (`id`, `idAcc`, `idServ`, `status`, `valuation`, `username`, `password`, `oldpassword`, `notes`, `created`, `lastVisited`, `times`, `lastChangedPwd`) VALUES ('34', '10', '42', '101', '7', '17693225-2', '6766', '6766', 'Cuenta AFP ! asociada a mi correo hotmail, clave seguridad: afpcara90', '2015-08-25 01:36:36', '2015-08-25 01:36:36', '0', '2015-08-25 01:36:36');


