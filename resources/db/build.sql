
CREATE TABLE `city` (
  `ID` int(11) NOT NULL,
  `city` varchar(40) NOT NULL,
  `plz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `invoice` (
  `ID` int(11) NOT NULL,
  `fk_customer` int(11) NOT NULL,
  `fk_invoiceStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `invoiceposition` (
  `ID` int(11) NOT NULL,
  `date` date NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `fk_rent` int(11) NOT NULL,
  `fk_invoice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `invoicestatus` (
  `ID` int(11) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `rent` (
  `ID` int(11) NOT NULL,
  `rentFrom` date NOT NULL,
  `rentTo` date NOT NULL,
  `days` int(11) NOT NULL,
  `registered` date NOT NULL,
  `fk_rentstatus` int(11) NOT NULL,
  `fk_customer` int(11) NOT NULL,
  `fk_room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `rentstatus` (
  `ID` int(11) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `room` (
  `ID` int(11) NOT NULL,
  `roomNumber` varchar(40) NOT NULL,
  `fk_roomStatus` int(11) NOT NULL,
  `fk_roomType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `roomstatus` (
  `ID` int(11) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `roomtype` (
  `ID` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` varchar(120) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `title` (
  `ID` int(11) NOT NULL,
  `title` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `city`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `invoice`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `invoiceposition`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `invoicestatus`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `rent`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `rentstatus`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `room`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `roomstatus`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `title`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `city`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `customer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `invoice`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `invoiceposition`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `invoicestatus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `rent`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `rentstatus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `room`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `roomstatus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `roomtype`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `title`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;