# ************************************************************
# Comunidades Autónomas.
#
# Albert Lombarte
# Twitter: @alombarte
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `states` (
                               `id` tinyint(4) NOT NULL,
                               `name` varchar(100) NOT NULL,
                               `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `states` (`id`, `name`, `slug`)
VALUES
    (1,'Andalucía', 'andalucia'),
    (2,'Aragón', 'aragon'),
    (3,'Asturias, Principado de', 'asturias'),
    (4,'Balears, Illes', 'balears'),
    (5,'Canarias', 'canarias'),
    (6,'Cantabria', 'cantabria'),
    (7,'Castilla y León', 'castilla-leon'),
    (8,'Castilla - La Mancha', 'castilla-la-mancha'),
    (9,'Catalunya', 'catalunya'),
    (10,'Comunitat Valenciana', 'comunitat-valenciana'),
    (11,'Extremadura', 'extremadura'),
    (12,'Galicia', 'galicia'),
    (13,'Madrid, Comunidad de', 'madrid'),
    (14,'Murcia, Región de', 'murcia'),
    (15,'Navarra, Comunidad Foral de', 'navarra'),
    (16,'País Vasco', 'pais-vasco'),
    (17,'Rioja, La', 'rioja'),
    (18,'Ceuta', 'ceuta'),
    (19,'Melilla', 'melilla');
