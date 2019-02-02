drop table Pro_users;
drop table Sub_users;
drop table Offers;
drop table Packages;
drop table Products;


CREATE TABLE IF NOT EXISTS Sub_users ( 
userSerialNo int(11) NOT NULL AUTO_INCREMENT,
userName varchar(50) NOT NULL,
userEmail varchar(100) NOT NULL,  
userPassword varchar(15) NOT NULL, 
userPhone varchar(20) NOT NULL, 
userAddress varchar(150) NOT NULL, 
userCreated datetime NOT NULL, 
PRIMARY KEY (userSerialNo) ,
UNIQUE (userEmail, userPhone) );


CREATE TABLE IF NOT EXISTS Products ( 
proSerialNo int(11) NOT NULL AUTO_INCREMENT,
proName varchar(50) NOT NULL,
proDescription varchar(100) NOT NULL,   
PRIMARY KEY (proSerialNo) ,
UNIQUE (proName) );

CREATE TABLE IF NOT EXISTS Packages ( 
proSerialNo int(11) NOT NULL,
pacSerialNo int(11) NOT NULL,
pacName varchar(50) NOT NULL,
pacPrice int(7) NOT NULL, 
pacLimit int(8) NOT NULL,  
PRIMARY KEY (proSerialNo, pacSerialNo),
CONSTRAINT FK_Products_Packages FOREIGN KEY (proSerialNo) REFERENCES Products(proSerialNo));

CREATE TABLE IF NOT EXISTS Offers ( 
OfferserialNo int(11) NOT NULL AUTO_INCREMENT,
offerPrice int(7) NOT NULL,
offerLimit int(8) NOT NULL,
offerDescription varchar(100) NOT NULL,
PRIMARY KEY (offerSerialNo));

CREATE TABLE IF NOT EXISTS Pro_users ( 
userSerialNo int(11) NOT NULL,
proSerialNo int(11) NOT NULL,
pacSerialNo int(11) NOT NULL,
useAge int(8) NOT NULL,
subExpaired datetime NOT NULL,
offerSerialNo int(11) NOT NULL,
PRIMARY KEY (userSerialNo, proSerialNo),
CONSTRAINT FK_Sub_Pro_users FOREIGN KEY (userSerialNo) REFERENCES Sub_users(userSerialNo),
CONSTRAINT FK_Products_Pro_users FOREIGN KEY (proSerialNo) REFERENCES Products(proSerialNo),
CONSTRAINT FK_Offers_Pro_users FOREIGN KEY (offerSerialNo) REFERENCES Offers(offerSerialNo)  
);


INSERT INTO Products (proName, proDescription) VALUES ("Linkedin List Fetcher 2.10", "Linkedin List Fetcher 2.10 compailed in January 2019");
INSERT INTO Products (proName, proDescription) VALUES ("Linkedin Public list Fetcher 2.00", "Linkedin Public list Fetcher 2.00 compailed in January 2019");

INSERT INTO Packages (proSerialNo, pacSerialNo, pacName, pacPrice, pacLimit) VALUES (1, 0, "Student", 1000, 1000);
INSERT INTO Packages (proSerialNo, pacSerialNo, pacName, pacPrice, pacLimit) VALUES (1, 1, "Professional", 1500, 20000);
INSERT INTO Packages (proSerialNo, pacSerialNo, pacName, pacPrice, pacLimit) VALUES (1, 2, "Enterprise", 2500, 100000);
INSERT INTO Packages (proSerialNo, pacSerialNo, pacName, pacPrice, pacLimit) VALUES (2, 0, "Student", 1000, 1000);
INSERT INTO Packages (proSerialNo, pacSerialNo, pacName, pacPrice, pacLimit) VALUES (2, 1, "Professional", 1500, 20000);
INSERT INTO Packages (proSerialNo, pacSerialNo, pacName, pacPrice, pacLimit) VALUES (2, 2, "Enterprise", 2500, 100000);

INSERT INTO Offers (offerPrice, offerLimit, offerDescription) VALUES (0, 0, "Standerd");
INSERT INTO Offers (offerPrice, offerLimit, offerDescription) VALUES (5, 0, "5% Discount");
INSERT INTO Offers (offerPrice, offerLimit, offerDescription) VALUES (10, 0, "10% Discount");
INSERT INTO Offers (offerPrice, offerLimit, offerDescription) VALUES (15, 0, "15% Discount");
INSERT INTO Offers (offerPrice, offerLimit, offerDescription) VALUES (20, 0, "20% Discount");
INSERT INTO Offers (offerPrice, offerLimit, offerDescription) VALUES (25, 0, "25% Discount");
INSERT INTO Offers (offerPrice, offerLimit, offerDescription) VALUES (30, 0, "30% Discount");
INSERT INTO Offers (offerPrice, offerLimit, offerDescription) VALUES (35, 0, "35% Discount");
INSERT INTO Offers (offerPrice, offerLimit, offerDescription) VALUES (40, 0, "40% Discount");
INSERT INTO Offers (offerPrice, offerLimit, offerDescription) VALUES (45, 0, "45% Discount");
INSERT INTO Offers (offerPrice, offerLimit, offerDescription) VALUES (50, 0, "50% Discount");

INSERT INTO Sub_users (userName, userEmail, userPassword, userPhone, userAddress, userCreated) VALUES ("Iron Man", "iran.man@mail.com", "123Iron", "01517107806", "House #7, Road #7, Iron street, DK, BD", "2019-02-02 00:00:00");
INSERT INTO Sub_users (userName, userEmail, userPassword, userPhone, userAddress, userCreated) VALUES ("Test User", "test.user@mail.com", "123Test", "01517107806", "House #t, Road #t, test street, TT, TT", "2019-02-02 00:00:00");
INSERT INTO Sub_users (userName, userEmail, userPassword, userPhone, userAddress, userCreated) VALUES ("Ali Reza", "ali.reza@mail.com", "123Ali", "01919414295", "House #1A, Road #10, West street, Dhaka Cantonment, Dhaka", "2019-02-02 00:00:00");


INSERT INTO Pro_users (userSerialNo, proSerialNo, pacSerialNo, useAge, subExpaired, offerSerialNo) VALUES (1, 1, 1, 0, "2019-03-01 00:00:00", 1);
INSERT INTO Pro_users (userSerialNo, proSerialNo, pacSerialNo, useAge, subExpaired, offerSerialNo) VALUES (2, 1, 1, 0, "2019-03-01 00:00:00", 1);



