/*******************************************************************************
   Drop database if it exists
********************************************************************************/
DROP DATABASE IF EXISTS `iesmusica`;


/*******************************************************************************
   Create database
********************************************************************************/
CREATE DATABASE `iesmusica`;


USE `iesmusica`;


CREATE TABLE `Customer`
(
    `CustomerId` INT NOT NULL,
    `FirstName` NVARCHAR(40) NOT NULL,
    `LastName` NVARCHAR(20) NOT NULL,
    `Company` NVARCHAR(80),
    `Address` NVARCHAR(70),
    `City` NVARCHAR(40),
    `State` NVARCHAR(40),
    `Country` NVARCHAR(40),
    `PostalCode` NVARCHAR(10),
    `Phone` NVARCHAR(24),
    `Fax` NVARCHAR(24),
    `Email` NVARCHAR(60) NOT NULL,
    CONSTRAINT `PK_Customer` PRIMARY KEY  (`CustomerId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Invoice`
(
    `InvoiceId` INT NOT NULL,
    `CustomerId` INT NOT NULL,
    `InvoiceDate` DATE NOT NULL,
    `Total` NUMERIC(10,2) NOT NULL,
    CONSTRAINT `PK_Invoice` PRIMARY KEY  (`InvoiceId`),
	CONSTRAINT `FK_InvoiceCustomerId` FOREIGN KEY (`CustomerId`) REFERENCES `Customer` (`CustomerId`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `Track`
(
    `TrackId` INT NOT NULL,
    `Name` NVARCHAR(200) NOT NULL,
    `Composer` NVARCHAR(220),
    `Milliseconds` INT NOT NULL,
    `Bytes` INT,
    `UnitPrice` NUMERIC(10,2) NOT NULL,
    CONSTRAINT `PK_Track` PRIMARY KEY  (`TrackId`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `InvoiceLine`
(
    `InvoiceLineId` INT NOT NULL,
    `InvoiceId` INT NOT NULL,
    `TrackId` INT NOT NULL,
    `UnitPrice` NUMERIC(10,2) NOT NULL,
    `Quantity` INT NOT NULL,
    CONSTRAINT `PK_InvoiceLine` PRIMARY KEY  (`InvoiceLineId`,`InvoiceId`),
	CONSTRAINT `FK_InvoiceLineInvoiceId` FOREIGN KEY (`InvoiceId`) REFERENCES `Invoice` (`InvoiceId`),
	CONSTRAINT `FK_InvoiceLineTrackId` FOREIGN KEY (`TrackId`) REFERENCES `Track` (`TrackId`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;



/*******************************************************************************
   Populate Tables
********************************************************************************/


INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (1, N'For Those About To Rock (We Salute You)', N'Angus Young', 343719, 11170334, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (3, N'Fast As a Shark', N'F. Baltes', 230619, 3990994, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (4, N'Restleb and Wild', N'F. Baltes', 252051, 4331779, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (5, N'Princeb of the Dawn', N'Deaffy', 375418, 6290521, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (6, N'Put The Finger On You',  N'Angus Young', 205662, 6713451, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (7, N'Let''s Get It Up', N'Angus Young', 233926, 7636561, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (8, N'Inject The Venom', N'Angus Young', 210834, 6852860, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (9, N'Snowballed',   N'Angus Young', 203102, 6599424, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (10, N'Evil Walks',  N'Angus Young', 263497, 8611245, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (11, N'C.O.D.', N'Angus Young', 199836, 6566314, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (12, N'Breaking The Rules',  N'Angus Young', 263288, 8596840, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (13, N'Night Of The Long Knives', N'Angus Young', 205688, 6706347, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (14, N'Spellbound', N'Angus Young', 270863, 8817038, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (15, N'Go Down',  N'AC/DC', 331180, 10847611, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (16, N'Dog Eat Dog', N'AC/DC', 215196, 7032162, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (17, N'Let There Be Rock', N'AC/DC', 366654, 12021261, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (18, N'Bad Boy Boogie', N'AC/DC', 267728, 8776140, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (19, N'Problem Child', N'AC/DC', 325041, 10617116, 0.99);
INSERT INTO `Track` (`TrackId`, `Name`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES (20, N'Overdose', N'AC/DC', 369319, 12066294, 0.99);

INSERT INTO `Customer` (`CustomerId`, `FirstName`, `LastName`, `Company`, `Address`, `City`, `State`, `Country`, `PostalCode`, `Phone`, `Fax`, `Email`) VALUES (1, N'Luis', N'Gonzalves', N'Embraer - Empresa Brasileira de Aeronautica S.A.', N'Av. Brigadeiro Faria Lima, 2170', N'Sao Jose dos Campos', N'SP', N'Brazil', N'12227-000', N'+55 (12) 3923-5555', N'+55 (12) 3923-5566', N'luisg@embraer.com.br');
INSERT INTO `Customer` (`CustomerId`, `FirstName`, `LastName`, `Address`, `City`, `Country`, `PostalCode`, `Phone`, `Email`) VALUES (2, N'Leonie', N'Kohler', N'Theodor-Heub-Strase 34', N'Stuttgart', N'Germany', N'70174', N'+49 0711 2842222', N'leonekohler@surfeu.de');
INSERT INTO `Customer` (`CustomerId`, `FirstName`, `LastName`, `Address`, `City`, `State`, `Country`, `PostalCode`, `Phone`, `Email`) VALUES (3, N'Francois', N'Tremblay', N'1498 rue Belanger', N'Montreal', N'QC', N'Canada', N'H2G 1A7', N'+1 (514) 721-4711', N'ftremblay@gmail.com');
INSERT INTO `Customer` (`CustomerId`, `FirstName`, `LastName`, `Address`, `City`, `Country`, `PostalCode`, `Phone`, `Email`) VALUES (4, N'Bjorn', N'Hansen', N'Ullevalsveien 14', N'Oslo', N'Norway', N'0171', N'+47 22 44 22 22', N'bjorn.hansen@yahoo.no');
INSERT INTO `Customer` (`CustomerId`, `FirstName`, `LastName`, `Company`, `Address`, `City`, `Country`, `PostalCode`, `Phone`, `Fax`, `Email`) VALUES (5, N'Frantisek', N'Wichterlova', N'JetBrains s.r.o.', N'Klanova 9/506', N'Prague', N'Czech Republic', N'14700', N'+420 2 4172 5555', N'+420 2 4172 5555', N'frantisekw@jetbrains.com');
INSERT INTO `Customer` (`CustomerId`, `FirstName`, `LastName`, `Address`, `City`, `Country`, `PostalCode`, `Phone`, `Email`) VALUES (6, N'Helena', N'Holy', N'Rilska 3174/6', N'Prague', N'Czech Republic', N'14300', N'+420 2 4177 0449', N'hholy@gmail.com');
INSERT INTO `Customer` (`CustomerId`, `FirstName`, `LastName`, `Address`, `City`, `Country`, `PostalCode`, `Phone`, `Email`) VALUES (7, N'Astrid', N'Gruber', N'Rotenturmstrabe 4, 1010 Innere Stadt', N'Vienne', N'Austria', N'1010', N'+43 01 5134505', N'astrid.gruber@apple.at');
INSERT INTO `Customer` (`CustomerId`, `FirstName`, `LastName`, `Address`, `City`, `Country`, `PostalCode`, `Phone`, `Email`) VALUES (8, N'Daan', N'Peeters', N'Gretrystraat 63', N'Brubels', N'Belgium', N'1000', N'+32 02 219 03 03', N'daan_peeters@apple.be');
INSERT INTO `Customer` (`CustomerId`, `FirstName`, `LastName`, `Address`, `City`, `Country`, `PostalCode`, `Phone`, `Email`) VALUES (9, N'Kara', N'Nielsen', N'Sonder Boulevard 51', N'Copenhagen', N'Denmark', N'1720', N'+453 3331 9991', N'kara.nielsen@jubii.dk');
INSERT INTO `Customer` (`CustomerId`, `FirstName`, `LastName`, `Company`, `Address`, `City`, `State`, `Country`, `PostalCode`, `Phone`, `Fax`, `Email`) VALUES (10, N'Eduardo', N'Martins', N'Woodstock Discos', N'Rua Dr. Falcao Filho, 155', N'Sao Paulo', N'SP', N'Brazil', N'01007-010', N'+55 (11) 3033-5446', N'+55 (11) 3033-4564', N'eduardo@woodstock.com.br');

INSERT INTO `Invoice` (`InvoiceId`, `CustomerId`, `InvoiceDate`, `Total`) VALUES (1, 2, '2009/1/1', 1.98);
INSERT INTO `Invoice` (`InvoiceId`, `CustomerId`, `InvoiceDate`, `Total`) VALUES (2, 4, '2009/1/2', 3.96);
INSERT INTO `Invoice` (`InvoiceId`, `CustomerId`, `InvoiceDate`, `Total`) VALUES (3, 8, '2009/1/3', 0.99);
INSERT INTO `Invoice` (`InvoiceId`, `CustomerId`, `InvoiceDate`, `Total`) VALUES (4, 2, '2009/2/11', 0.99);


INSERT INTO `InvoiceLine` (`InvoiceLineId`, `InvoiceId`, `TrackId`, `UnitPrice`, `Quantity`) VALUES (1, 1, 1, 0.99, 1);
INSERT INTO `InvoiceLine` (`InvoiceLineId`, `InvoiceId`, `TrackId`, `UnitPrice`, `Quantity`) VALUES (2, 1, 4, 0.99, 1);
INSERT INTO `InvoiceLine` (`InvoiceLineId`, `InvoiceId`, `TrackId`, `UnitPrice`, `Quantity`) VALUES (1, 2, 6, 0.99, 1);
INSERT INTO `InvoiceLine` (`InvoiceLineId`, `InvoiceId`, `TrackId`, `UnitPrice`, `Quantity`) VALUES (2, 2, 5, 0.99, 1);
INSERT INTO `InvoiceLine` (`InvoiceLineId`, `InvoiceId`, `TrackId`, `UnitPrice`, `Quantity`) VALUES (3, 2, 7, 0.99, 1);
INSERT INTO `InvoiceLine` (`InvoiceLineId`, `InvoiceId`, `TrackId`, `UnitPrice`, `Quantity`) VALUES (4, 2, 8, 0.99, 1);
INSERT INTO `InvoiceLine` (`InvoiceLineId`, `InvoiceId`, `TrackId`, `UnitPrice`, `Quantity`) VALUES (1, 3, 17, 0.99, 1);
INSERT INTO `InvoiceLine` (`InvoiceLineId`, `InvoiceId`, `TrackId`, `UnitPrice`, `Quantity`) VALUES (1, 4, 20, 0.99, 1);



