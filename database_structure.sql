-- REMEMBER TO ADD USERS in TABLE 'medici' !

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Struttura della tabella `anagrafica`
--

CREATE TABLE `anagrafica` (
  `idpz` int(11) NOT NULL,
  `cognome` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nascita_data` date DEFAULT NULL,
  `nascita_luogo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sesso` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `cf` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `asl` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `telefoni` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `domicilio` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `professione` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `statocivile` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prima_visita` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `diagnosi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ultima_visita` date NOT NULL DEFAULT '2000-01-01',
  `decesso` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Struttura della tabella `anamnesipd`
--

CREATE TABLE `anamnesipd` (
  `idpz` int(11) NOT NULL DEFAULT '0',
  `familia` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `esordio_eta` tinyint(4) NOT NULL DEFAULT '0',
  `esordio_sede` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `esordio_sede_txt` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `esordio_tipo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `interapia_data` date DEFAULT NULL,
  `interapia_tipo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `comorbilita` longtext COLLATE utf8_unicode_ci NOT NULL,
  `compli_onoff` tinyint(4) NOT NULL DEFAULT '0',
  `compli_delon` tinyint(4) NOT NULL DEFAULT '0',
  `compli_woff` tinyint(4) NOT NULL DEFAULT '0',
  `compli_dysk` tinyint(4) NOT NULL DEFAULT '0',
  `compli_altro` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `compli_allu` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `compli_sonno` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `compli_cogni` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `compli_vegeta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `esami` longtext COLLATE utf8_unicode_ci NOT NULL,
  `cadute` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Struttura della tabella `hy`
--

CREATE TABLE `hy` (
  `id_visita` int(11) NOT NULL DEFAULT '0',
  `stage` decimal(2,1) NOT NULL DEFAULT '0.0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Struttura della tabella `listanamnesi`
--

CREATE TABLE `listanamnesi` (
  `id` tinyint(4) NOT NULL DEFAULT '0',
  `link` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `descrizione` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `listascale`
--

CREATE TABLE `listascale` (
  `id` tinyint(4) NOT NULL DEFAULT '0',
  `link` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `descrizione` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL DEFAULT '0',
  `medico` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `azione` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `paziente` varchar(16) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Struttura della tabella `medici`
--

CREATE TABLE `medici` (
  `cognome` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cod_ts` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `medici`
-- ADD/UPDATE USERNAMES AND PASSWORD HERE!!!   <<<<<----------------

INSERT INTO `medici` (`cognome`, `password`, `cod_ts`) VALUES
('USER1', 'PASSWORD1', 0);

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
  `disegno` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Struttura della tabella `phpmysqlautobackup`
--

CREATE TABLE `phpmysqlautobackup` (
  `id` int(11) NOT NULL,
  `version` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_last_run` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `q42` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Struttura della tabella `visite`
--

CREATE TABLE `visite` (
  `id_visita` int(11) NOT NULL,
  `idpz` int(11) NOT NULL,
  `data` int(20) DEFAULT NULL,
  `luogo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `terapia_atto` longtext COLLATE utf8_unicode_ci NOT NULL,
  `diario` longtext COLLATE utf8_unicode_ci NOT NULL,
  `eon` longtext COLLATE utf8_unicode_ci NOT NULL,
  `terapia_data` longtext COLLATE utf8_unicode_ci NOT NULL,
  `medico` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0;


--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `anagrafica`
--
ALTER TABLE `anagrafica`
  ADD UNIQUE KEY `idpz` (`idpz`);

--
-- Indici per le tabelle `anamnesipd`
--
ALTER TABLE `anamnesipd`
  ADD UNIQUE KEY `idpz` (`idpz`);

--
-- Indici per le tabelle `hy`
--
ALTER TABLE `hy`
  ADD UNIQUE KEY `id_visita` (`id_visita`);

--
-- Indici per le tabelle `listanamnesi`
--
ALTER TABLE `listanamnesi`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indici per le tabelle `listascale`
--
ALTER TABLE `listascale`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indici per le tabelle `log`
--
ALTER TABLE `log`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indici per le tabelle `medici`
--
ALTER TABLE `medici`
  ADD UNIQUE KEY `cognome` (`cognome`);

--
-- Indici per le tabelle `mmse`
--
ALTER TABLE `mmse`
  ADD UNIQUE KEY `id_visita` (`id_visita`);

--
-- Indici per le tabelle `phpmysqlautobackup`
--
ALTER TABLE `phpmysqlautobackup`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `updrs`
--
ALTER TABLE `updrs`
  ADD UNIQUE KEY `id_visita` (`id_visita`);

--
-- Indici per le tabelle `visite`
--
ALTER TABLE `visite`
  ADD PRIMARY KEY (`id_visita`);

