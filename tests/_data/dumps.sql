CREATE TABLE Company
(
  Name VARCHAR(35) NOT NULL,
  PhoneNum VARCHAR(12) NOT NULL,
  IrsNum VARCHAR(30) NOT NULL,
  Type VARCHAR(30) NOT NULL,
  Street VARCHAR(35) NOT NULL,
  City VARCHAR(30) NOT NULL,
  Zip VARCHAR(5) NOT NULL,
  State VARCHAR(20) NOT NULL,
  Email VARCHAR(45) NOT NULL,
  PRIMARY KEY (Name)
);

CREATE TABLE InventoryType
(
  Type VARCHAR(25) NOT NULL,
  Name VARCHAR(35) NOT NULL,
  PRIMARY KEY (Type, Name),
  FOREIGN KEY (Name) REFERENCES Company(Name)
);

CREATE TABLE Users
(
  Username VARCHAR(40) NOT NULL,
  Pin VARCHAR(10) NOT NULL,
  IsManager BOOL NOT NULL,
  YearsWorked VARCHAR(2) NOT NULL,
  Name VARCHAR(35) NOT NULL,
  PRIMARY KEY (Pin),
  FOREIGN KEY (Name) REFERENCES Company(Name)
);

CREATE TABLE Items
(
  ItemName VARCHAR(30) NOT NULL,
  Par INT NOT NULL,
  OnHand INT NOT NULL,
  Type VARCHAR(25) NOT NULL,
  Name VARCHAR(35) NOT NULL,
  PRIMARY KEY (ItemName),
  FOREIGN KEY (Type, Name) REFERENCES InventoryType(Type, Name)
);

CREATE TABLE InventorySuggestions
(
  ItemName VARCHAR(30) NOT NULL,
  Type VARCHAR(25) NOT NULL,
  Name VARCHAR(35) NOT NULL,
  Pin VARCHAR(10) NOT NULL,
  PRIMARY KEY (ItemName),
  FOREIGN KEY (Type, Name) REFERENCES InventoryType(Type, Name),
  FOREIGN KEY (Pin) REFERENCES Users(Pin)
);

CREATE TABLE RequestOff
(
  StartDate DATE NOT NULL,
  EndDate DATE NOT NULL,
  Mandatory BOOL NOT NULL,
  Pin VARCHAR(10) NOT NULL,
  FOREIGN KEY (Pin) REFERENCES Users(Pin)
);

CREATE TABLE WriteOffs
(
  ItemName VARCHAR(30) NOT NULL,
  DateExpired DATE NOT NULL,
  Pin VARCHAR(10) NOT NULL,
  PRIMARY KEY(ItemName, DateExpired, Pin),
  FOREIGN KEY (Pin) REFERENCES Users(Pin)
);

CREATE TABLE ShiftTimes
(
  ShiftName VARCHAR(3),
  StartTime VARCHAR(5),
  EndTime VARCHAR(5) ,
  PRIMARY KEY (ShiftName)
);

CREATE TABLE WorkingSchedule
(
  Username VARCHAR(40) NOT NULL,
  Monday VARCHAR(3) NOT NULL,
  Tuesday VARCHAR(3) NOT NULL,
  Wednesday VARCHAR(3) NOT NULL,
  Thursday VARCHAR(3) NOT NULL,
  Friday VARCHAR(3) NOT NULL,
  Saturday VARCHAR(3) NOT NULL,
  Sunday VARCHAR(3) NOT NULL,
  PRIMARY KEY (Username)
);

CREATE TABLE CurrentSchedule
(
  Username VARCHAR(40) NOT NULL,
  Monday VARCHAR(3) NOT NULL,
  Tuesday VARCHAR(3) NOT NULL,
  Wednesday VARCHAR(3) NOT NULL,
  Thursday VARCHAR(3) NOT NULL,
  Friday VARCHAR(3) NOT NULL,
  Saturday VARCHAR(3) NOT NULL,
  Sunday VARCHAR(3) NOT NULL,
  PRIMARY KEY (Username)
);

CREATE TABLE Availability
(
  Day VARCHAR(15) NOT NULL,
  Pin VARCHAR(10) NOT NULL,
  ShiftName VARCHAR(3) NOT NULL,
  PRIMARY KEY (Day, Pin, ShiftName),
  FOREIGN KEY (Pin) REFERENCES Users(Pin),
  FOREIGN KEY (ShiftName) REFERENCES ShiftTimes(ShiftName)
);

CREATE TABLE UpdateAvailability
(
  Day VARCHAR(15) NOT NULL,
  ShiftName VARCHAR(3) NOT NULL,
  Pin VARCHAR(10) NOT NULL,
  PRIMARY KEY (Day, ShiftName, Pin),
  FOREIGN KEY (ShiftName) REFERENCES ShiftTimes(ShiftName),
  FOREIGN KEY (Pin) REFERENCES Users(Pin)
);

INSERT INTO `Company`(`Name`, `PhoneNum`, `IrsNum`, `Type`, `Street`, `City`, `Zip`, `State`, `Email`) VALUES ('Songbird','734-780-7100','12345','LLC','2707 Plymouth Rd.','Ann Arbor','48105','Michigan','thesongbirdcafe@gmail.com');

INSERT INTO `Users`(`Username`, `Pin`, `IsManager`, `YearsWorked`, `Name`) VALUES ("DKilroy",'1117',1,'6','Songbird');
INSERT INTO `Users`(`Username`, `Pin`, `IsManager`, `YearsWorked`, `Name`) VALUES ("JBond",'5555',0,'1','Songbird');

INSERT INTO `InventoryType`(`Type`, `Name`) VALUES ('Kitchen','Songbird');
INSERT INTO `InventoryType`(`Type`, `Name`) VALUES ('FOH','Songbird');
INSERT INTO `InventoryType`(`Type`, `Name`) VALUES ('Coffee','Songbird');

INSERT INTO `Items`(`ItemName`, `Par`, `OnHand`, `Type`, `Name`) VALUES ('Turkey',3,0,'Kitchen','Songbird');
INSERT INTO `Items`(`ItemName`, `Par`, `OnHand`, `Type`, `Name`) VALUES ('Cheddar',2,0,'Kitchen','Songbird');
INSERT INTO `Items`(`ItemName`, `Par`, `OnHand`, `Type`, `Name`) VALUES ('Bacon',4,0,'Kitchen','Songbird');
INSERT INTO `Items`(`ItemName`, `Par`, `OnHand`, `Type`, `Name`) VALUES ('Provolone',10,0,'Kitchen','Songbird');
INSERT INTO `Items`(`ItemName`, `Par`, `OnHand`, `Type`, `Name`) VALUES ('Espresso',3,0,'Coffee','Songbird');
INSERT INTO `Items`(`ItemName`, `Par`, `OnHand`, `Type`, `Name`) VALUES ('Decaf',3,0,'Coffee','Songbird');
INSERT INTO `Items`(`ItemName`, `Par`, `OnHand`, `Type`, `Name`) VALUES ('Hyperion',3,0,'Coffee','Songbird');
INSERT INTO `Items`(`ItemName`, `Par`, `OnHand`, `Type`, `Name`) VALUES ('Milk',3,0,'FOH','Songbird');
INSERT INTO `Items`(`ItemName`, `Par`, `OnHand`, `Type`, `Name`) VALUES ('Cups',3,0,'FOH','Songbird');
INSERT INTO `Items`(`ItemName`, `Par`, `OnHand`, `Type`, `Name`) VALUES ('Napkins',3,0,'FOH','Songbird');
INSERT INTO `Items`(`ItemName`, `Par`, `OnHand`, `Type`, `Name`) VALUES ('Straws',3,0,'FOH','Songbird');

INSERT INTO `ShiftTimes`(`ShiftName`, `StartTime`, `EndTime`) VALUES ('1st','6:30','1:30');
INSERT INTO `ShiftTimes`(`ShiftName`, `StartTime`, `EndTime`) VALUES ('2nd','9:00','3:30');
INSERT INTO `ShiftTimes`(`ShiftName`, `StartTime`, `EndTime`) VALUES ('3rd','11:30','7:00');
INSERT INTO `ShiftTimes`(`ShiftName`) VALUES ('Off');

INSERT INTO `Availability`(`Day`, `Pin`, `ShiftName`) VALUES ('Monday','5555','1st');
INSERT INTO `Availability`(`Day`, `Pin`, `ShiftName`) VALUES ('Monday','5555','2nd');
INSERT INTO `Availability`(`Day`, `Pin`, `ShiftName`) VALUES ('Monday','5555','3rd');
INSERT INTO `Availability`(`Day`, `Pin`, `ShiftName`) VALUES ('Tuesday','5555','1st');
INSERT INTO `Availability`(`Day`, `Pin`, `ShiftName`) VALUES ('Wednesday','5555','3rd');
INSERT INTO `Availability`(`Day`, `Pin`, `ShiftName`) VALUES ('Saturday','5555','1st');
INSERT INTO `Availability`(`Day`, `Pin`, `ShiftName`) VALUES ('Saturday','5555','2nd');
INSERT INTO `Availability`(`Day`, `Pin`, `ShiftName`) VALUES ('Sunday','5555','1st');
INSERT INTO `Availability`(`Day`, `Pin`, `ShiftName`) VALUES ('Sunday','5555','2nd');

INSERT INTO `UpdateAvailability`(`Day`, `ShiftName`, `Pin`) VALUES ('Monday','Off','5555');

INSERT INTO `InventorySuggestions`(`ItemName`, `Type`, `Name`, `Pin`) VALUES ('Ham','Kitchen','Songbird','5555');
INSERT INTO `InventorySuggestions`(`ItemName`, `Type`, `Name`, `Pin`) VALUES ('Half Calf','Coffee','Songbird','1117');

INSERT INTO `WriteOffs`(`ItemName`, `DateExpired`, `Pin`) VALUES ('Turkey','2021-3-5','5555');
INSERT INTO `WriteOffs`(`ItemName`, `DateExpired`, `Pin`) VALUES ('Milk','2021-3-5','5555');

INSERT INTO `RequestOff`(`StartDate`, `EndDate`, `Mandatory`, `Pin`) VALUES ('2021-7-1','2021-7-6',1,'5555');

INSERT INTO `CurrentSchedule`(`Username`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`, `Sunday`) VALUES ('JBond','Off','1st','Off','Off','2nd','Off','Off');

INSERT INTO `WorkingSchedule`(`Username`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`, `Sunday`) VALUES ('JBond','3rd','1st','Off','Off','2nd','Off','Off');