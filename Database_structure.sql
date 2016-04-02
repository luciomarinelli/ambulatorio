
-- --------------------------------------------------------

-- 
-- Struttura della tabella `anagrafica`
-- 

CREATE TABLE `anagrafica` (
  `idpz` int(11) NOT NULL AUTO_INCREMENT,
  `cognome` varchar(30) NOT NULL DEFAULT '',
  `nome` varchar(30) NOT NULL DEFAULT '',
  `nascita_data` date DEFAULT NULL,
  `nascita_luogo` varchar(50) NOT NULL DEFAULT '',
  `sesso` char(1) NOT NULL DEFAULT '',
  `cf` varchar(16) NOT NULL DEFAULT '',
  `asl` varchar(7) NOT NULL DEFAULT '',
  `telefoni` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `domicilio` varchar(100) NOT NULL DEFAULT '',
  `professione` varchar(100) NOT NULL DEFAULT '',
  `statocivile` varchar(30) NOT NULL DEFAULT '',
  `prima_visita` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `diagnosi` varchar(200) NOT NULL DEFAULT '',
  `note` varchar(200) NOT NULL DEFAULT '',
  `ultima_visita` date NOT NULL DEFAULT '2000-01-01',
  `decesso` tinyint(4) NOT NULL DEFAULT '0',
  UNIQUE KEY `idpz` (`idpz`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `anamnesipd`
-- 

CREATE TABLE `anamnesipd` (
  `idpz` int(11) NOT NULL DEFAULT '0',
  `familia` varchar(100) NOT NULL DEFAULT '',
  `esordio_eta` tinyint(4) NOT NULL DEFAULT '0',
  `esordio_sede` varchar(4) NOT NULL DEFAULT '',
  `esordio_sede_txt` varchar(100) NOT NULL DEFAULT '',
  `esordio_tipo` varchar(20) NOT NULL DEFAULT '',
  `interapia_data` date DEFAULT NULL,
  `interapia_tipo` varchar(10) NOT NULL DEFAULT '',
  `comorbilita` longtext NOT NULL,
  `compli_onoff` tinyint(4) NOT NULL DEFAULT '0',
  `compli_delon` tinyint(4) NOT NULL DEFAULT '0',
  `compli_woff` tinyint(4) NOT NULL DEFAULT '0',
  `compli_dysk` tinyint(4) NOT NULL DEFAULT '0',
  `compli_altro` varchar(100) NOT NULL DEFAULT '',
  `compli_allu` varchar(100) NOT NULL DEFAULT '',
  `compli_sonno` varchar(100) NOT NULL DEFAULT '',
  `compli_cogni` varchar(100) NOT NULL DEFAULT '',
  `compli_vegeta` varchar(100) NOT NULL DEFAULT '',
  `esami` longtext NOT NULL,
  `cadute` int(11) NOT NULL,
  UNIQUE KEY `idpz` (`idpz`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `hy`
-- 

CREATE TABLE `hy` (
  `id_visita` int(11) NOT NULL DEFAULT '0',
  `stage` decimal(2,1) NOT NULL DEFAULT '0.0',
  UNIQUE KEY `id_visita` (`id_visita`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `listanamnesi`
-- 

CREATE TABLE `listanamnesi` (
  `id` tinyint(4) NOT NULL DEFAULT '0',
  `link` varchar(10) NOT NULL DEFAULT '',
  `descrizione` varchar(40) NOT NULL DEFAULT '',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `listascale`
-- 

CREATE TABLE `listascale` (
  `id` tinyint(4) NOT NULL DEFAULT '0',
  `link` varchar(10) NOT NULL DEFAULT '',
  `descrizione` varchar(40) NOT NULL DEFAULT '',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `log`
-- 

CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` int(11) NOT NULL DEFAULT '0',
  `medico` varchar(20) NOT NULL DEFAULT '',
  `azione` varchar(40) NOT NULL DEFAULT '',
  `paziente` varchar(16) NOT NULL DEFAULT '',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `medici`
-- 

CREATE TABLE `medici` (
  `cognome` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(20) NOT NULL DEFAULT '',
  `cod_ts` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `cognome` (`cognome`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `mmse`
-- 

CREATE TABLE `mmse` (
  `id_visita` int(11) NOT NULL DEFAULT '0',
  `anno` tinyint(4) NOT NULL DEFAULT '0',
  `stagione` tinyint(4) NOT NULL DEFAULT '0',
  `mese` tinyint(4) NOT NULL DEFAULT '0',
  `gmese` tinyint(4) NOT NULL DEFAULT '0',
  `gsett` tinyint(4) NOT NULL DEFAULT '0',
  `stato` tinyint(4) NOT NULL DEFAULT '0',
  `regione` tinyint(4) NOT NULL DEFAULT '0',
  `citta` tinyint(4) NOT NULL DEFAULT '0',
  `luogo` tinyint(4) NOT NULL DEFAULT '0',
  `piano` tinyint(4) NOT NULL DEFAULT '0',
  `capaga` tinyint(4) NOT NULL DEFAULT '0',
  `tentativi` tinyint(4) NOT NULL DEFAULT '0',
  `calcolo` tinyint(4) NOT NULL DEFAULT '0',
  `richiamo` tinyint(4) NOT NULL DEFAULT '0',
  `oggetti` tinyint(4) NOT NULL DEFAULT '0',
  `ripeti` tinyint(4) NOT NULL DEFAULT '0',
  `compito` tinyint(4) NOT NULL DEFAULT '0',
  `occhichiusi` tinyint(4) NOT NULL DEFAULT '0',
  `frase` tinyint(4) NOT NULL DEFAULT '0',
  `disegno` tinyint(4) NOT NULL DEFAULT '0',
  UNIQUE KEY `id_visita` (`id_visita`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `phpmysqlautobackup`
-- 

CREATE TABLE `phpmysqlautobackup` (
  `id` int(11) NOT NULL,
  `version` varchar(6) DEFAULT NULL,
  `time_last_run` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `updrs`
-- 

CREATE TABLE `updrs` (
  `id_visita` int(11) NOT NULL DEFAULT '0',
  `onoff` tinyint(4) NOT NULL DEFAULT '0',
  `q1` tinyint(4) NOT NULL DEFAULT '0',
  `q2` tinyint(4) NOT NULL DEFAULT '0',
  `q3` tinyint(4) NOT NULL DEFAULT '0',
  `q4` tinyint(4) NOT NULL DEFAULT '0',
  `q5` tinyint(4) NOT NULL DEFAULT '0',
  `q6` tinyint(4) NOT NULL DEFAULT '0',
  `q7` tinyint(4) NOT NULL DEFAULT '0',
  `q8` tinyint(4) NOT NULL DEFAULT '0',
  `q9` tinyint(4) NOT NULL DEFAULT '0',
  `q10` tinyint(4) NOT NULL DEFAULT '0',
  `q11` tinyint(4) NOT NULL DEFAULT '0',
  `q12` tinyint(4) NOT NULL DEFAULT '0',
  `q13` tinyint(4) NOT NULL DEFAULT '0',
  `q14` tinyint(4) NOT NULL DEFAULT '0',
  `q15` tinyint(4) NOT NULL DEFAULT '0',
  `q16` tinyint(4) NOT NULL DEFAULT '0',
  `q17` tinyint(4) NOT NULL DEFAULT '0',
  `q18` tinyint(4) NOT NULL DEFAULT '0',
  `q19` tinyint(4) NOT NULL DEFAULT '0',
  `q20t` tinyint(4) NOT NULL DEFAULT '0',
  `q20asdx` tinyint(4) NOT NULL DEFAULT '0',
  `q20assn` tinyint(4) NOT NULL DEFAULT '0',
  `q20aidx` tinyint(4) NOT NULL DEFAULT '0',
  `q20aisn` tinyint(4) NOT NULL DEFAULT '0',
  `q21dx` tinyint(4) NOT NULL DEFAULT '0',
  `q21sn` tinyint(4) NOT NULL DEFAULT '0',
  `q22t` tinyint(4) NOT NULL DEFAULT '0',
  `q22asdx` tinyint(4) NOT NULL DEFAULT '0',
  `q22assn` tinyint(4) NOT NULL DEFAULT '0',
  `q22aidx` tinyint(4) NOT NULL DEFAULT '0',
  `q22aisn` tinyint(4) NOT NULL DEFAULT '0',
  `q23dx` tinyint(4) NOT NULL DEFAULT '0',
  `q23sn` tinyint(4) NOT NULL DEFAULT '0',
  `q24dx` tinyint(4) NOT NULL DEFAULT '0',
  `q24sn` tinyint(4) NOT NULL DEFAULT '0',
  `q25dx` tinyint(4) NOT NULL DEFAULT '0',
  `q25sn` tinyint(4) NOT NULL DEFAULT '0',
  `q26dx` tinyint(4) NOT NULL DEFAULT '0',
  `q26sn` tinyint(4) NOT NULL DEFAULT '0',
  `q27` tinyint(4) NOT NULL DEFAULT '0',
  `q28` tinyint(4) NOT NULL DEFAULT '0',
  `q29` tinyint(4) NOT NULL DEFAULT '0',
  `q30` tinyint(4) NOT NULL DEFAULT '0',
  `q31` tinyint(4) NOT NULL DEFAULT '0',
  `q32` tinyint(4) NOT NULL DEFAULT '0',
  `q33` tinyint(4) NOT NULL DEFAULT '0',
  `q34` tinyint(4) NOT NULL DEFAULT '0',
  `q35` tinyint(4) NOT NULL DEFAULT '0',
  `q36` tinyint(4) NOT NULL DEFAULT '0',
  `q37` tinyint(4) NOT NULL DEFAULT '0',
  `q38` tinyint(4) NOT NULL DEFAULT '0',
  `q39` tinyint(4) NOT NULL DEFAULT '0',
  `q40` tinyint(4) NOT NULL DEFAULT '0',
  `q41` tinyint(4) NOT NULL DEFAULT '0',
  `q42` tinyint(4) NOT NULL DEFAULT '0',
  UNIQUE KEY `id_visita` (`id_visita`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `visite`
-- 

CREATE TABLE `visite` (
  `id_visita` int(11) NOT NULL AUTO_INCREMENT,
  `idpz` int(11) NOT NULL,
  `data` int(20) DEFAULT NULL,
  `luogo` varchar(30) NOT NULL DEFAULT '',
  `terapia_atto` longtext NOT NULL,
  `diario` longtext NOT NULL,
  `eon` longtext NOT NULL,
  `terapia_data` longtext NOT NULL,
  `medico` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_visita`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 PACK_KEYS=0;
