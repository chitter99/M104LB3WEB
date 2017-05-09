--
-- Tabellenstruktur für Tabelle `city`
--

CREATE TABLE `city` (
  `ID` int(11) NOT NULL,
  `city` varchar(40) NOT NULL,
  `plz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONEN DER TABELLE `city`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `customer`
--

CREATE TABLE `customer` (
  `ID` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(40) NOT NULL,
  `fk_title` int(11) NOT NULL,
  `fk_city` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONEN DER TABELLE `customer`:
--   `fk_city`
--       `city` -> `ID`
--   `fk_title`
--       `title` -> `ID`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `invoice`
--

CREATE TABLE `invoice` (
  `ID` int(11) NOT NULL,
  `fk_customer` int(11) NOT NULL,
  `fk_invoiceStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONEN DER TABELLE `invoice`:
--   `fk_customer`
--       `customer` -> `ID`
--   `fk_invoiceStatus`
--       `invoicestatus` -> `ID`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `invoiceposition`
--

CREATE TABLE `invoiceposition` (
  `ID` int(11) NOT NULL,
  `date` date NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `fk_rent` int(11) NOT NULL,
  `fk_invoice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONEN DER TABELLE `invoiceposition`:
--   `fk_invoice`
--       `invoice` -> `ID`
--   `fk_rent`
--       `rent` -> `ID`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `invoicestatus`
--

CREATE TABLE `invoicestatus` (
  `ID` int(11) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONEN DER TABELLE `invoicestatus`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rent`
--

CREATE TABLE `rent` (
  `ID` int(11) NOT NULL,
  `rentFrom` date NOT NULL,
  `rentTo` date NOT NULL,
  `days` int(11) NOT NULL,
  `registered` date NOT NULL,
  `fk_rentstatus` int(11) NOT NULL,
  `fk_customer` int(11) NOT NULL,
  `fk_room` int(11) NOT NULL,
  `adult` int(64) NOT NULL,
  `child` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONEN DER TABELLE `rent`:
--   `fk_customer`
--       `customer` -> `ID`
--   `fk_rentstatus`
--       `rentstatus` -> `ID`
--   `fk_room`
--       `room` -> `ID`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rentstatus`
--

CREATE TABLE `rentstatus` (
  `ID` int(11) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONEN DER TABELLE `rentstatus`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `room`
--

CREATE TABLE `room` (
  `ID` int(11) NOT NULL,
  `roomNumber` varchar(40) NOT NULL,
  `fk_roomStatus` int(11) NOT NULL,
  `fk_roomType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONEN DER TABELLE `room`:
--   `fk_roomStatus`
--       `roomstatus` -> `ID`
--   `fk_roomType`
--       `roomtype` -> `ID`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `roomstatus`
--

CREATE TABLE `roomstatus` (
  `ID` int(11) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONEN DER TABELLE `roomstatus`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `roomtype`
--

CREATE TABLE `roomtype` (
  `ID` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` TEXT,
  `image` TEXT,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONEN DER TABELLE `roomtype`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `title`
--

CREATE TABLE `title` (
  `ID` int(11) NOT NULL,
  `title` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONEN DER TABELLE `title`:
--

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `invoiceposition`
--
ALTER TABLE `invoiceposition`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `invoicestatus`
--
ALTER TABLE `invoicestatus`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `rent`
--
ALTER TABLE `rent`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `rentstatus`
--
ALTER TABLE `rentstatus`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `roomstatus`
--
ALTER TABLE `roomstatus`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `roomtype`
--
ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `city`
--
ALTER TABLE `city`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `invoice`
--
ALTER TABLE `invoice`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `invoiceposition`
--
ALTER TABLE `invoiceposition`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `invoicestatus`
--
ALTER TABLE `invoicestatus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `rent`
--
ALTER TABLE `rent`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `rentstatus`
--
ALTER TABLE `rentstatus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `room`
--
ALTER TABLE `room`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `roomstatus`
--
ALTER TABLE `roomstatus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `roomtype`
--
ALTER TABLE `roomtype`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `title`
--
ALTER TABLE `title`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;SET FOREIGN_KEY_CHECKS=1;