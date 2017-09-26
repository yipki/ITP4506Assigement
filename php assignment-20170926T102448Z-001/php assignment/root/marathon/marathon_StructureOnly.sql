CREATE TABLE Administrator (
  AdministratorID int(5) NOT NULL AUTO_INCREMENT, 
  Password        varchar(255), 
  FirstName       varchar(255), 
  LastName        varchar(255), 
  PRIMARY KEY (AdministratorID));
CREATE TABLE Charity (
  CharityID   int(5) NOT NULL AUTO_INCREMENT, 
  Name        varchar(255), 
  Description varchar(255), 
  WebsiteUrl  varchar(255), 
  Logo        varchar(255), 
  PRIMARY KEY (CharityID));
CREATE TABLE Event (
  EventID     int(5) NOT NULL AUTO_INCREMENT, 
  Name        varchar(255), 
  Distance    float, 
  DateOfEvent date, 
  TimeStart   time, 
  Price       decimal(10, 2), 
  PRIMARY KEY (EventID));
CREATE TABLE EventRegister (
  RegID            int(5) NOT NULL AUTO_INCREMENT, 
  RunnerID         int(5) NOT NULL, 
  EventID          int(5) NOT NULL, 
  CheckInTime      time, 
  FinishTime       time, 
  TopSpeed         float, 
  PaymentConfirmed tinyint(1) DEFAULT '0', 
  PaymentTotal     int(11), 
  RaceKitID        int(5) NOT NULL, 
  RaceKitSent      tinyint(1) DEFAULT '0', 
  PRIMARY KEY (RegID));
CREATE TABLE RaceKitChoice (
  RaceKitID    int(5) NOT NULL AUTO_INCREMENT, 
  Name         varchar(255), 
  Description  varchar(255), 
  Price        decimal(10, 2), 
  Photo        varchar(255), 
  EventID int(5) NOT NULL, 
  PRIMARY KEY (RaceKitID));
CREATE TABLE Runner (
  RunnerID       int(5) NOT NULL AUTO_INCREMENT, 
  VolunteerID    int(5), 
  Password       varchar(255), 
  FirstName      varchar(255), 
  LastName       varchar(255), 
  Gender         varchar(10), 
  DateOfBirth    date, 
  Email          varchar(255), 
  Country        varchar(255), 
  ProfilePicture varchar(255), 
  PRIMARY KEY (RunnerID));
CREATE TABLE Sponsor (
  SponsorID int(5) NOT NULL AUTO_INCREMENT, 
  Password  varchar(255), 
  FirstName varchar(255), 
  LastName  varchar(255), 
  Company   varchar(255), 
  Email     varchar(255), 
  PRIMARY KEY (SponsorID));
CREATE TABLE SponsorRecord (
  SponsorID        int(5) NOT NULL, 
  CharityID        int(5) NOT NULL, 
  RegID            int(5) NOT NULL, 
  Amount           decimal(10, 2), 
  PaymentConfirmed tinyint(1)  DEFAULT '0', 
  PRIMARY KEY (SponsorID, 
  CharityID, 
  RegID));
CREATE TABLE Volunteer (
  VolunteerID int(5) NOT NULL AUTO_INCREMENT, 
  Password    varchar(255), 
  FirstName   varchar(255), 
  LastName    varchar(255), 
  Gender      varchar(10), 
  Email       varchar(255), 
  PRIMARY KEY (VolunteerID));
ALTER TABLE RaceKitChoice ADD INDEX FKRaceKitCho896145 (EventID), ADD CONSTRAINT FKRaceKitCho896145 FOREIGN KEY (EventID) REFERENCES Event (EventID) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE SponsorRecord ADD INDEX FKSponsorRec723837 (RegID), ADD CONSTRAINT FKSponsorRec723837 FOREIGN KEY (RegID) REFERENCES EventRegister (RegID) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE SponsorRecord ADD INDEX FKSponsorRec587573 (CharityID), ADD CONSTRAINT FKSponsorRec587573 FOREIGN KEY (CharityID) REFERENCES Charity (CharityID) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE SponsorRecord ADD INDEX FKSponsorRec216661 (SponsorID), ADD CONSTRAINT FKSponsorRec216661 FOREIGN KEY (SponsorID) REFERENCES Sponsor (SponsorID) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE EventRegister ADD INDEX FKEventRegis439203 (EventID), ADD CONSTRAINT FKEventRegis439203 FOREIGN KEY (EventID) REFERENCES Event (EventID) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE EventRegister ADD INDEX FKEventRegis634186 (RaceKitID), ADD CONSTRAINT FKEventRegis634186 FOREIGN KEY (RaceKitID) REFERENCES RaceKitChoice (RaceKitID) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE EventRegister ADD INDEX FKEventRegis640020 (RunnerID), ADD CONSTRAINT FKEventRegis640020 FOREIGN KEY (RunnerID) REFERENCES Runner (RunnerID) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Runner ADD INDEX FKRunner505187 (VolunteerID), ADD CONSTRAINT FKRunner505187 FOREIGN KEY (VolunteerID) REFERENCES Volunteer (VolunteerID) ON DELETE CASCADE ON UPDATE CASCADE;
