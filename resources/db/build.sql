
CREATE TABLE `invoicestatus` (
  `ID` int(11) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `rentstatus` (
  `ID` int(11) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `roomstatus` (
  `ID` int(11) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `invoicestatus`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `rentstatus`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `roomstatus`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `invoicestatus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `rentstatus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `roomstatus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
