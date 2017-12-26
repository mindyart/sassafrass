CREATE TABLE Users (
	Email varchar(100) NOT NULL,
	FirstName varchar(100),
    LastName varchar(100),
	PRIMARY KEY (Email)
);

CREATE TABLE Events (
	EventID INT NOT NULL AUTO_INCREMENT,
    Title varchar(100),
	Threshold INT NOT NULL,
	Going INT,
    eventDate DATETIME,
	Deadline DATETIME,
    description varchar(300),
	PRIMARY KEY (EventID)
);

CREATE TABLE isGoing (
    EventID INT NOT NULL,
	Attendee varchar(100) NOT NULL,
    FOREIGN KEY (EventID) REFERENCES Events(EventID),
	FOREIGN KEY (Attendee) REFERENCES Users(Email),
    PRIMARY KEY (EventID, Attendee)
);
